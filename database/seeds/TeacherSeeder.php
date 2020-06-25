<?php

use App\Models\Config\Image;
use App\Models\Profile\User;
use App\Models\Profile\Teacher;
use Illuminate\Database\Seeder;

class TeacherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->times(8)->create()->each(function ($user) {
        	$teacher = $user->teacher()->save( factory(Teacher::class)->make() );
        	$user->image()->save( factory(Image::class)->make() );
            $user->userDetail()->save( factory( \App\Models\Profile\UserDetail::class )->make() );
        });
    }
}
