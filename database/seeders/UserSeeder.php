<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Usuario 1
        User::firstOrCreate(
            ['email' => 'admin@empresa.com'],
            [
                'name' => 'Gabriela Pinzon',
                'password' => Hash::make('1234'),
            ]
        );

        // Usuario 2
        User::firstOrCreate(
            ['email' => 'izzy@empresa.com'],
            [
                'name' => 'Isabella Pinzon',
                'password' => Hash::make('123456789'),
            ]
        );

        //usuario 3
        User::firstOrCreate(
            ['email' => 'juanp@empresa.com'],
            [
                'name' => 'Juan Pablo Urbano',
                'password' => Hash::make('596000'),
            ]
        );

        
        User::firstOrCreate(
            ['email' => 'arias@empresa.com'],
            [
                'name' => 'Sebastian Arias',
                'password' => Hash::make('Arias5025'),
            ]
        );

         User::firstOrCreate(
            ['email' => 'ronnygu@empresa.com'],
            [
                'name' => 'Ronny Gutierrez',
                'password' => Hash::make('Ronny505'),
            ]
        );
    }
}
