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
            'chat_groups_id'=>'1',
            'user_id'=>1,
            'message'=>'sup bro',
       ]);       
       Chat::create([
            'chat_groups_id'=>'1',
            'user_id'=>2,
            'message'=>'hey man im fine whats up with u',
       ]);
       Chat::create([
            'chat_groups_id'=>'1',
            'user_id'=>1,
            'message'=>'im fine',
       ]); 
    }
}
