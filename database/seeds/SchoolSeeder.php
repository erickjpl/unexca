<?php

use Illuminate\Database\Seeder;

use App\Models\School\School;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(School::class)->create();
    }
}
