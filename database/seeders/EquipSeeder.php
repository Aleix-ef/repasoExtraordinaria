<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Equip;

class EquipSeeder extends Seeder
{
    public function run(): void
    {
        Equip::factory()->count(18)->create();
    }
}
