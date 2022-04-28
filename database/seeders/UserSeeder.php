<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->count(5)->create();

        User::create([
            'name' => 'Caleb',
            'email' => 'calebcupul@gmail.com',
            'password' => bcrypt('caleb123'),
            'address' => 'Cucosta, Ixtapa',
            'image' => 'demoImagen.jpg',
            'official_identification' => 'demoComprobante.jpg',
            'phone_number' => '32215021322'
        ])->assignRole('Invitado');

        User::create([
            'name' => 'demoCliente',
            'email' => 'demoCliente@gmail.com',
            'password' => bcrypt('caleb123'),
            'address' => 'Cucosta, Ixtapa',
            'image' => 'demoImagen.jpg',
            'official_identification' => 'demoComprobante.jpg',
            'phone_number' => '32215021322'
        ])->assignRole('Cliente');

        User::create([
            'name' => 'demoEmpleado',
            'email' => 'demoEmpleado@gmail.com',
            'password' => bcrypt('caleb123'),
            'address' => 'Cucosta, Ixtapa',
            'image' => 'demoImagen.jpg',
            'official_identification' => 'demoComprobante.jpg',
            'phone_number' => '32215021322'
        ])->assignRole('Empleado');

        User::create([
            'name' => 'DemoAdmin',
            'email' => 'demoAdmin@gmail.com',
            'password' => bcrypt('caleb123'),
            'address' => 'Cucosta, Ixtapa',
            'image' => 'demoImagen.jpg',
            'official_identification' => 'demoComprobante.jpg',
            'phone_number' => '32215021322'
        ])->assignRole('Administrador');

    }
}
