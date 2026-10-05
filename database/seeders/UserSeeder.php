<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash as FacadesHash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => FacadesHash::make('123456'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Fikra Delaila',
            'email' => 'fikra@gmail.com',
            'password' => FacadesHash::make('fikra123'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Talitha Naomi',
            'email' => 'naomi@gmail.com',
            'password' => FacadesHash::make('naomi123'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Aisyah Rizqi',
            'email' => 'aisy@gmail.com',
            'password' => FacadesHash::make('ais123'),
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Alya Arilda',
            'email' => 'alya@gmail.com',
            'password' => FacadesHash::make('alya123'),
            'role' => 'admin',
        ]);
    }
}
