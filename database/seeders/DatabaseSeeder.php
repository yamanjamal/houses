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


        $this->call([
            UserSeeder::class,
            AdminSeeder::class,
            HouseSeeder::class,
            CommentSeeder::class,
            LikesAndDislikesSeeder::class,
            ImgeSeeder::class,
            ChatGroupsSeeder::class,
            ChatSeeder::class,
        ]);

    }
}
