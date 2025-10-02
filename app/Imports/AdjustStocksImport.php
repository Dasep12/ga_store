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
use Illuminate\Support\Facades\Auth;

class AdjustStocksImport implements ToCollection, WithChunkReading, WithHeadingRow, ShouldQueue
{
    protected $importId;

    public function __construct($importId)
    {
        $this->importId = $importId;
    }

    public function collection(Collection $rows)
    {
        $processedNow = 0;
        $errors = [];

        foreach ($rows as $row) {
            // skip kalau kode_barang kosong
            if (empty($row['kode_barang'])) {
                // $errors[] = "Baris tanpa kode_barang dilewati.";
                // continue;
                throw new \Exception("Kode barang kosong pada baris import.");
            }

            // cek product_id berdasarkan kode_barang
            $id = DB::table('tbl_mst_product')
                ->where('kode_barang', $row['kode_barang'] ?? '')
                ->value('id');

            if (empty($id)) {
                // catat error, tapi jangan stop semua proses
                // $errors[] = "Kode barang '{$row['kode_barang']}' tidak ditemukan.";
                throw new \Exception("Kode barang '{$row['kode_barang']}' tidak ditemukan di master product.");
                // continue;
            }

            // insert ke tbl_trn_adjust
            DB::table('tbl_trn_adjust')->insert([
                'tanggal' => is_numeric($row['tanggal'])
                    ? Carbon::instance(ExcelDate::excelToDateTimeObject($row['tanggal']))->format('Y-m-d')
                    : Carbon::parse($row['tanggal'])->format('Y-m-d'),
                'product_id' => $id,
                'kode_barang' => $row['kode_barang'],
                'qty' => $row['qty'],
                'type' => $row['type'] == "plus" ? '+' : '-',
                'remark' => $row['remark'],
                'created_by' => Auth::user()->user_id ?? 'system',
                'tanggal' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            // update stok
            $existing = DB::table('tbl_trn_stock')->where('product_id', $id)->first();
            $qty = (float)$row['qty'];
            $type = $row['type'] == "plus" ? '+' : '-';

            if ($existing) {
                $stockBaru = $existing->stock + ($type === '+' ? $qty : -$qty);
                DB::table('tbl_trn_stock')
                    ->where('product_id', $id)
                    ->update([
                        'stock' => $stockBaru,
                        'updated_at' => now(),
                    ]);
            } else {
                DB::table('tbl_trn_stock')->insert([
                    'product_id' => $id,
                    'stock' => $row['qty'],
                    'created_by' => Auth::user()->user_id ?? 'system',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            $processedNow++;
        }

        // update progress
        Cache::increment("import:{$this->importId}:processed", $processedNow);

        $total = Cache::get("import:{$this->importId}:total");
        $processed = Cache::get("import:{$this->importId}:processed");

        if ($total !== null && $processed >= $total) {
            Cache::put("import:{$this->importId}:status", 'finished');
            Cache::put("import:{$this->importId}:processed", $total);
        } else {
            Cache::put("import:{$this->importId}:status", 'processing');
        }

        // simpan error kalau ada
        if (!empty($errors)) {
            Cache::put("import:{$this->importId}:errors", $errors);
        }
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
