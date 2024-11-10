<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehicleStatusSeeder extends Seeder
{
    protected $statuses = [
        ['status' => 'Disponível'],
        ['status' => 'Vendido'],
        ['status' => 'Em negociação'],
    ];

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vehicle_status')->insert($this->statuses);
    }
}
