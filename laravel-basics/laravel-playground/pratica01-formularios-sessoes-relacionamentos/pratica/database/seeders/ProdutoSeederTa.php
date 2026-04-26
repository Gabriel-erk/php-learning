<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProdutoTa;

class ProdutoSeederTa extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i=0; $i < 10; $i++) { 
            ProdutoTa::create([
                'nome' => "Produto $i",
                'preco' => 5.50 * $i + 5.50,
                'descricao' => "Produto $i com foco em carne e outras coisitas."    
            ]);
        }
    }
}
