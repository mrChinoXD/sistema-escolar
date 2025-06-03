<?php

namespace Database\Seeders;

use App\Models\Sede;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SedeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void{

        Sede::create([
            "name" =>  "Rectoria",
        ]);
        Sede::create([
            "name" =>  "Zapopan",
        ]);
        Sede::create([
            "name" =>  "Orizaba",
        ]);
    }
}
