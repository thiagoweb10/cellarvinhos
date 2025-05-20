<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = collect([
            'Acesso',
            'Atualização de Sistema',
            'Banco de Dados',
            'Conta de Usuário',
            'Outros',
        ]);

        $categories->each(function($categorie){
            Category::create([
                'name'=> $categorie
            ]);
        });
    }
}