<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\Category;
use Carbon\Carbon;

class ItemSeeder extends Seeder
{
    public function run(): void
    {
        $sayur = Category::where('code', 'SAYUR')->firstOrFail();
        $buah  = Category::where('code', 'BUAH')->firstOrFail();
        $pokok = Category::where('code', 'BAHAN_POKOK')->firstOrFail();

        $items = [
            [
                'category_id' => $sayur->id,
                'code'        => 'SAYUR-BAYAM',
                'name'        => 'Bayam Hijau',
                'unit'        => 'ikat',
                'unit_price'  => 2000,
                'quantity'    => 30,
                'expired_at'  => Carbon::now()->addDays(2),
            ],
            [
                'category_id' => $sayur->id,
                'code'        => 'SAYUR-WORTEL',
                'name'        => 'Wortel',
                'unit'        => 'kg',
                'unit_price'  => 12000,
                'quantity'    => 15,
                'expired_at'  => Carbon::now()->addDays(7),
            ],
            [
                'category_id' => $buah->id,
                'code'        => 'BUAH-PISANG',
                'name'        => 'Pisang',
                'unit'        => 'sisir',
                'unit_price'  => 18000,
                'quantity'    => 10,
                'expired_at'  => Carbon::now()->addDays(5),
            ],
            [
                'category_id' => $pokok->id,
                'code'        => 'BAHANPOKOK-BERAS',
                'name'        => 'Beras Medium',
                'unit'        => 'kg',
                'unit_price'  => 11000,
                'quantity'    => 100,
                'expired_at'  => null,
            ],
        ];

        foreach ($items as $item) {
            Item::create($item);
        }
    }
}
