<?php

use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert(array(
            array('name' => 'Administrador',
            'shortname' => 'admin',
            'descripcion' => 'Administrador General del Sistema',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")),
            array('name' => 'Coordinador Academico',
                'shortname' => 'CA',
                'descripcion' => 'Empleado...',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")),
            array('name' => 'Asesor(a) de Ventas',
                'shortname' => 'AV',
                'descripcion' => 'Empleado...',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")),
            array('name' => 'Asesor(a) de Academico',
                'shortname' => 'AA',
                'descripcion' => 'Empleado...',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")),
            array('name' => 'Gerencia',
                'shortname' => 'G',
                'descripcion' => 'Empleado...',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s")),
            array('name' => 'Diseñador Grafico',
                'shortname' => 'DG',
                'descripcion' => 'Empleado...',
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"))
    ));
    }
}
