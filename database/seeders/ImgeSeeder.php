<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Imge;


class ImgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Imge::factory(10)->create();
    }
}
