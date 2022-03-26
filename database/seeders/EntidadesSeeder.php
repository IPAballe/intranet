<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntidadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('entidades')->insert([
            'entidad_desc' => 'Empresa de Prueba TURISMO',
            'telefono'     => '+5324848484',
            'correo'       => 'correo@de.la.empresa.com',
            'munic_id'     => 122,
            'activo'       => 1,
        ]);
    }
}
