<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Type;

class TypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data =  [
            ['name' => "Concert"],
            ['name' => "Charity"],
            ['name' => "Product"]
        ];
        Type::insert(
           $data
        );   
    }
}
