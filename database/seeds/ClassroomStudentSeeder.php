<?php

use Illuminate\Database\Seeder;
use App\Models\Profile\Student;
use App\Models\School\Classroom;
use App\Models\School\ClassroomStudent;

class ClassroomStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$classrooms = Classroom::all('id');
        $students = Student::all('id');

        foreach ($students->chunk(8) as $key => $chunk) {
            foreach ($chunk as $value) {
                ClassroomStudent::create([
                    'classroom_id' => $classrooms[$key]->id,
                    'student_id' => $value->id
                ]);
            }
        }
    }
}
