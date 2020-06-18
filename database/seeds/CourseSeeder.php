<?php

use App\Models\School\Course;
use App\Models\School\Period;
use App\Models\Profile\Teacher;
use Illuminate\Database\Seeder;
use App\Models\School\Classroom;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$teachers = Teacher::all('id');
    	$index = 0;

        factory(Course::class, 8)->create()->each(function ($course) use ($teachers, &$index) {
        	$course->period()->save(factory(Period::class)->make());
        	$course->classroom()->save(factory(Classroom::class)->make([
        		'status' => 'active',
        		'teacher_id' => $teachers[$index]->id
        	]));

        	++$index;
        });
    }
}
