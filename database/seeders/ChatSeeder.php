<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Chat;

class ChatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // Chat::factory(10)->create();
       Chat::create([
            'chat_groups_id'=>'2',
            'user_id'=>11,
            'message'=>'sup bro',
       ]);       
       Chat::create([
            'chat_groups_id'=>'2',
            'user_id'=>9,
            'message'=>'hey man whats up',
       ]);
    }
}
