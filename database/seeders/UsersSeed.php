<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Traits\HasRoles;
class UsersSeed extends Seeder
{
	use HasRoles;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            ['name' => 'Dueño Directo', 'email' => 'dueñodirecto@gmail.com', 'password' => bcrypt('12345678'), 'cuit' => '2040783378', 'telefono' => '3815860461', 'province_id' => 90, 'city_id' => 48, 'codigo_postal' => '4000', 'direccion' => 'Agustin Maza 266', 'matricula_pas' => null],
            ['name' => 'Inmobiliaria', 'email' => 'inmobiliaria@gmail.com', 'password' => bcrypt('12345678'), 'cuit' => '2040783379', 'telefono' => '3815860461', 'province_id' => 90, 'city_id' => 48, 'codigo_postal' => '4000', 'direccion' => 'Agustin Maza 266', 'matricula_pas' => null],
            ['name' => 'Cliente', 'email' => 'cliente@gmail.com', 'password' => bcrypt('12345678'), 'cuit' => '2040783348', 'telefono' => '3815860461', 'province_id' => 90, 'city_id' => 58, 'codigo_postal' => '4000', 'direccion' => 'Agustin Maza 266', 'matricula_pas' => null],
            ['name' => 'Operario', 'email' => 'operario@gmail.com', 'password' => bcrypt('12345678'), 'cuit' => '2040783448', 'telefono' => '3815861461', 'province_id' => 90, 'city_id' => 48, 'codigo_postal' => '4000', 'direccion' => 'Agustin Maza 266', 'matricula_pas' => null],
            ['name' => 'Productor', 'email' => 'productor@gmail.com', 'password' => bcrypt('12345678'), 'cuit' => '20407833512', 'telefono' => '3815861461', 'province_id' => 90, 'city_id' => 48, 'codigo_postal' => '4000', 'direccion' => 'Agustin Maza 266', 'matricula_pas' => '50000'],            
            ['name' => 'Admin', 'email' => 'admin@gmail.com', 'password' => bcrypt('12345678'), 'cuit' => '20407833545', 'telefono' => '3815861467', 'province_id' => 90, 'city_id' => 48, 'codigo_postal' => '4000', 'direccion' => 'Agustin Maza 266'],   
            ['name' => 'CallCenter', 'email' => 'callcenter@gmail.com', 'password' => bcrypt('12345678'), 'cuit' => '99999999999', 'telefono' => '99999999999', 'province_id' => 90, 'city_id' => 48, 'codigo_postal' => '4000', 'direccion' => 'Agustin Maza 266'],                                 
        ];
        foreach($users as $user) {
            User::create($user);
        }
        User::where('id', 1)->first()->assignRole('inmobiliaria');
        User::where('id', 2)->first()->assignRole('inmobiliaria');
        User::where('id', 3)->first()->assignRole('cliente');
        User::where('id', 4)->first()->assignRole('operario');
        User::where('id', 5)->first()->assignRole('productor');
        User::where('id', 6)->first()->assignRole('admin');
        User::where('id',7)->first()->assignRole('callcenter');
    }
}
