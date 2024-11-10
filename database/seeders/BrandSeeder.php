<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{

    protected $brands = [
        ['brand' => 'Toyota'],
        ['brand' => 'Ford'],
        ['brand' => 'Chevrolet'],
        ['brand' => 'Honda'],
        ['brand' => 'Nissan'],
        ['brand' => 'Volkswagen'],
        ['brand' => 'Hyundai'],
        ['brand' => 'Kia'],
        ['brand' => 'Subaru'],
        ['brand' => 'BMW'],
        ['brand' => 'Ferrari'],
        ['brand' => 'Fiat'],
        ['brand' => 'Lamborghini']
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('brands')->insert($this->brands);
    }
}
