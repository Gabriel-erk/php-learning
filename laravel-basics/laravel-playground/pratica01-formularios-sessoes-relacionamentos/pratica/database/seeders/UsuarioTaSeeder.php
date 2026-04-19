<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UsuarioTa;
use Illuminate\Support\Facades\Hash;

class UsuarioTaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 10; $i++) { 
            UsuarioTa::create([
                'nome' => 'Usuário $i',
                'sobrenome' => 'Sobrenome Usuário $i',
                'senha' => Hash::make('123456'),
                'email' => 'user$1@gmail.com',
                'celular' => '+55 (xx) XXXXX-XXXX'
            ]);
        }
    }
}
