<?php

namespace App\Imports;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Carbon\Carbon;

class StocksImport implements ToCollection, WithChunkReading, WithHeadingRow, ShouldQueue
{
    protected $importId;

    public function __construct($importId)
    {
        $this->importId = $importId;
    }

    public function collection(Collection $rows)
    {
        $processedNow = 0;

        foreach ($rows as $row) {
            // Pastikan kode_barang tidak kosong
            if (empty($row['kode_barang'])) {
                continue;
            }
            $id = DB::table('tbl_mst_product')
                ->where('kode_barang', $row['kode_barang'] ?? '')
                ->value('id');
            DB::table('tbl_trn_beli')->insert([
                'transaction_id' => self::generateBeliId(),
                'no_po' => $row['no_po'],
                'tanggal_beli' => is_numeric($row['tanggal_beli'])
                    ? Carbon::instance(ExcelDate::excelToDateTimeObject($row['tanggal_beli']))->format('Y-m-d')
                    : Carbon::parse($row['tanggal_beli'])->format('Y-m-d'),
                'product_id' => $id,
                'qty' => $row['qty'],
                'harga_satuan' => $row['harga_satuan'],
                'supplier' => $row['supplier'],
                'harga_total' => $row['harga_total'],
                'remark' => $row['remark'],
                'created_by' => 'system',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $existing = DB::table('tbl_trn_stock')
                ->where('product_id', $id)
                ->first();

            if ($existing) {
                DB::table('tbl_trn_stock')
                    ->where('product_id', $id)
                    ->update([
                        'stock' => $existing->stock + $row['qty'],
                        'updated_at' => now(),
                    ]);
            } else {
                DB::table('tbl_trn_stock')->insert([
                    'product_id' => $row['product_id'],
                    'stock' => $row['qty'],
                    'created_by' => 'system',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
            $processedNow++;
        }

        Cache::increment("import:{$this->importId}:processed", $processedNow);

        $total = Cache::get("import:{$this->importId}:total");
        $processed = Cache::get("import:{$this->importId}:processed");

        if ($total !== null && $processed >= $total) {
            Cache::put("import:{$this->importId}:status", 'finished');
            Cache::put("import:{$this->importId}:processed", $total);
        } else {
            Cache::put("import:{$this->importId}:status", 'processing');
        }
    }

    public function generateBeliId()
    {
        $last = DB::table('tbl_trn_beli')
            ->where('transaction_id', 'like', 'BELI_%')
            ->selectRaw('MAX(CAST(SUBSTRING(transaction_id, 7) AS UNSIGNED)) as last_number')
            ->first();

        $nextNumber = $last && $last->last_number ? $last->last_number + 1 : 1;
        return 'BELI_' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
