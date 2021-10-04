<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ChatGroups;

class ChatGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       ChatGroups::factory(1)->create();
    }
}
