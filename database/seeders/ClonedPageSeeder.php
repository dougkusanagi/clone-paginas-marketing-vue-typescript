<?php

namespace Database\Seeders;

use App\Models\ClonedPage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClonedPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClonedPage::factory(10)->create();
    }
}
