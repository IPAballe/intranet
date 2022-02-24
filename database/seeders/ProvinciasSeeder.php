<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinciasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('Provincias')->insert(['prov_desc' => 'PINAR DEL RIO']);
        DB::table('Provincias')->insert(['prov_desc' => 'ARTEMISA']);
        DB::table('Provincias')->insert(['prov_desc' => 'LA HABANA']);
        DB::table('Provincias')->insert(['prov_desc' => 'MAYABEQUE']);
        DB::table('Provincias')->insert(['prov_desc' => 'MATANZAS']);
        DB::table('Provincias')->insert(['prov_desc' => 'VILLA CLARA']);
        DB::table('Provincias')->insert(['prov_desc' => 'CIENFUEGOS']);
        DB::table('Provincias')->insert(['prov_desc' => 'SANCTI SPIRITUS']);
        DB::table('Provincias')->insert(['prov_desc' => 'CIEGO DE AVILA']);
        DB::table('Provincias')->insert(['prov_desc' => 'CAMAGUEY']);
        DB::table('Provincias')->insert(['prov_desc' => 'LAS TUNAS']);
        DB::table('Provincias')->insert(['prov_desc' => 'HOLGUIN']);
        DB::table('Provincias')->insert(['prov_desc' => 'GRANMA']);
        DB::table('Provincias')->insert(['prov_desc' => 'SANTIAGO DE CUBA']);
        DB::table('Provincias')->insert(['prov_desc' => 'GUANTANAMO']);
    }
}
