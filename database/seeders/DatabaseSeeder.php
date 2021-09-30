<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use App\Models\House;
// use App\Models\Imge;
// use App\Models\Comment;



class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // House::factory(10)->create();
        // Imge::factory(10)->create();
        // Comment::factory(10)->create();

        \App\Models\User::factory(10)->create();
        $this->call([
            AdminSeeder::class,
            HouseSeeder::class,
            CommentSeeder::class,
            LikesAndDislikesSeeder::class,
            ImgeSeeder::class,
            ChatGroupsSeeder::class,
            // ChatSeeder::class,
        ]);

    }
}
