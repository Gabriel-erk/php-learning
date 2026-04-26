<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FilmeTa;

class FilmeSeederTa extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for($i = 0; $i < 5; $i++){
            FilmeTa::create([
                'nome' => "Filme $i",
                'genero' => "Genêro $i",
                'duracaoEmMinutos' => $i * 60
            ]);
        }
    }
}
