<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LikesAndDislikes;

class LikesAndDislikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LikesAndDislikes::factory(100)->create();
        
    }
}
