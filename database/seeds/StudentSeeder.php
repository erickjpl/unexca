<?php

use App\Models\Config\Image;
use App\Models\Profile\User;
use App\Models\Profile\RelativeStudent;
use App\Models\Profile\Student;
use Illuminate\Database\Seeder;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$students = array();

        factory(User::class, 64)->create()->each(function ($user) use ($students) {
        	$student = $user->student()->save(factory(Student::class)->make() );
        	array_push($students, $student->id);
        	$user->image()->save( factory(Image::class)->make() );
            $user->userDetail()->save( factory( \App\Models\Profile\UserDetail::class )->make() );
        });

        foreach ($students as $student) {
        	factory(User::class)->create()->each(function ($user) use ($student) {
    			$user->image()->save( factory(Image::class)->make() );
                $user->userDetail()->save( factory( \App\Models\Profile\UserDetail::class )->make() );
        		$user->parent()->save( factory(RelativeStudent::class)->make(['student_id' => $student]) );
        	});        	
        }
    }
}
