<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UsuarioTa;

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
                'email' => 'user$1@gmail.com',
                'celular' => '+55 (xx) XXXXX-XXXX'
            ]);
        }
    }
}
