<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();

        foreach ($categories as $categorie) {
           Ticket::factory()->count(10)->create([
                'category_id' => $categorie->id
            ]);
        }
    }
}
