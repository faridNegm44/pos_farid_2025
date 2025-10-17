<?php

namespace App\Imports;

ini_set('max_execution_time', '0');

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\RemembersRowNumber;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use App\Models\Back\Product;
use App\Models\Back\StoreDets;

class ProductsImport implements ToModel, WithBatchInserts, WithChunkReading
{
    use RemembersRowNumber;

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        if ($row[0] !== 'الكود المختصر'){             
            return DB::transaction(function () use ($row) {
    
                $productId = Product::insertGetId([
                    'shortCode'          => $row[0] ?? null,
                    'natCode'            => $row[1] ?? null,
                    'nameAr'             => $row[2],
                    'nameEn'             => $row[3] ?? null,
                    'store'              => 1,
                    'stockAlert'         => $row[4] ?? 0,
                    'firstPeriodCount'   => $row[5] ?? 0,
                    'smallUnit'          => 1,
                    'small_unit_numbers' => $row[6] ?? 1,
                    'prod_discount'      => $row[7] ?? 0,
                    'prod_tax'           => $row[8] ?? 0,
                    'max_sale_quantity'  => $row[9] ?? 0,
                    'created_at'         => now(),
                    'updated_at'         => now(),
                ]);
    
                $lastNumId = StoreDets::where('type', 'رصيد اول مدة للسلعة/خدمة')
                    ->max('num_order') ?? 0;
    
                $currentFinancialYear = DB::table('financial_years')
                    ->where('status', 1)
                    ->first();
    
                StoreDets::insert([
                    'num_order'                  => $lastNumId + 1,
                    'type'                       => 'رصيد اول مدة للسلعة/خدمة',
                    'year_id'                    => $currentFinancialYear->id ?? null,
                    'bill_id'                    => 0,
                    'product_id'                 => $productId,
                    'sell_price_small_unit'      => $row[10] ?? 0,
                    'last_cost_price_small_unit' => $row[11] ?? 0,
                    'avg_cost_price_small_unit'  => $row[11] ?? 0,
                    'quantity_small_unit'        => $row[5] ?? 0,
                    'discount'                   => $row[7] ?? 0,
                    'tax'                        => $row[8] ?? 0,
                    'date'                       => now()->toDateString(),
                    'user_id'                    => auth()->id(),
                    'notes'                      => 'تم إدراجه بواسطة ملف الإكسل',
                    'created_at'                 => now(),
                ]);
            });
        }

    }

    public function batchSize(): int
    {
        return 100;
    }

    public function chunkSize(): int
    {
        return 100;
    }
}
