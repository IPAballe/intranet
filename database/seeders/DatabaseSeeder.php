<?php

namespace Database\Seeders;

use App\Models\Entidades;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call(ProvinciasSeeder::class);
        $this->call(MunicipiosSeeder::class);
        $this->call(TiposSeeder::class);
        $this->call(EntidadesSeeder::class);
    }
}
