<?php

namespace App\Imports;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Contracts\Queue\ShouldQueue;


class ProductsImport implements ToCollection, WithChunkReading, WithHeadingRow, ShouldQueue
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

            $satuan = DB::table('tbl_mst_satuan')
                ->where('code', $row['satuan'] ?? '')
                ->value('id');

            $kategori = DB::table('tbl_mst_kategori')
                ->where('code', $row['kategori_id'] ?? '')
                ->value('id');

            DB::table('tbl_mst_product')->updateOrInsert(
                ['kode_barang' => $row['kode_barang']], // cek berdasarkan kode_barang
                [
                    'nama_barang'   => $row['nama_barang'] ?? '',
                    'type_barang'   => $row['type_barang'] ?? null,
                    'jenis_asset'   => $row['jenis_asset'] ?? null,
                    'stock_type'    => $row['stock_type'] ?? null,
                    'special_order' => $row['special_order'] ?? null,
                    'kategori_id'   => $kategori,
                    'merek'         => $row['merek'] ?? null,
                    'warna'         => $row['warna'] ?? null,
                    'satuan_id'        => $satuan ?? null,
                    'ukuran'        => $row['ukuran'] ?? null,
                    'model'         => $row['model'] ?? null,
                    'harga'         => $row['harga'] ?? null,
                    'deskripsi'     => $row['deskripsi'] ?? null,
                    'images'        => $row['images'] ?? null, // isi nama file/path jika ada
                    'is_actived'    => isset($row['is_actived']) ? (int)$row['is_actived'] : 1,
                    'created_by'    => 'import-excel',
                    'updated_by'    => 'import-excel',
                    'updated_at'    => now(),
                    'created_at'    => now(),
                ]
            );
            $lastInsertId = DB::getPdo()->lastInsertId();
            $cekStock = DB::table('tbl_trn_stock')
                ->where('kode_barang', $row['kode_barang'])
                ->first();
            if (!$cekStock) {
                DB::table('tbl_trn_stock')
                    ->insert([
                        'product_id' => $lastInsertId,
                        'kode_barang' => $row['kode_barang'],
                        'stock' =>  0,
                        'updated_at' => now(),
                        'updated_by' => 'import-excel',
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

    public function chunkSize(): int
    {
        return 1000;
    }
}
