<?php

namespace Database\Seeders;

use App\Models\JabatanModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JabatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            ['nama' => 'spv'],
            ['nama' => 'sales payroll'],
            ['nama' => 'sales digmar'],
            ['nama' => 'partner'],
        ];


        foreach ($datas as $data) {
            JabatanModel::create(['nama' => $data['nama']]);
        }
    }
}
