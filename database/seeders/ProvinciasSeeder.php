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
        DB::table('provincias')->insert(['prov_desc' => 'PINAR DEL RIO']);
        DB::table('provincias')->insert(['prov_desc' => 'ARTEMISA']);
        DB::table('provincias')->insert(['prov_desc' => 'LA HABANA']);
        DB::table('provincias')->insert(['prov_desc' => 'MAYABEQUE']);
        DB::table('provincias')->insert(['prov_desc' => 'MATANZAS']);
        DB::table('provincias')->insert(['prov_desc' => 'VILLA CLARA']);
        DB::table('provincias')->insert(['prov_desc' => 'CIENFUEGOS']);
        DB::table('provincias')->insert(['prov_desc' => 'SANCTI SPIRITUS']);
        DB::table('provincias')->insert(['prov_desc' => 'CIEGO DE AVILA']);
        DB::table('provincias')->insert(['prov_desc' => 'CAMAGUEY']);
        DB::table('provincias')->insert(['prov_desc' => 'LAS TUNAS']);
        DB::table('provincias')->insert(['prov_desc' => 'HOLGUIN']);
        DB::table('provincias')->insert(['prov_desc' => 'GRANMA']);
        DB::table('provincias')->insert(['prov_desc' => 'SANTIAGO DE CUBA']);
        DB::table('provincias')->insert(['prov_desc' => 'GUANTANAMO']);
    }
}
