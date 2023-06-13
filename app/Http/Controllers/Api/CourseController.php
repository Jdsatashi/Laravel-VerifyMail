<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Response\ResponseJson;

class CourseController extends Controller
{
    use ResponseJson;
    public function index(){
        $course = Course::all();
        if(count($course) == 0){
            return $this->response_json(null, 404, "Not has any courses.");
        }
        return $this->response_json([ 'Course' => $course], (int)null, "Here all courses.");
    }

    public function store(Request $request){
        $request->validate([
            'name' => "required | unique:courses",
            ]);
        $course = Course::create([
            'name' => $request->name,
        ]);
        return $this->response_json($course, 200, "Created course: {$course->name}.");
    }
}
