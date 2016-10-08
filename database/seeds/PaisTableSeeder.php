<?php

use Illuminate\Database\Seeder;

class PaisTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
            DB::table('paises')->insert([
                'nombre' => 'Perú'
            ]);


    }
}