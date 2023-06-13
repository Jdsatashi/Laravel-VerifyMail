<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Response\ResponseJson;
use App\Models\Assign;
use App\Models\Classe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AssignController extends Controller
{
    use ResponseJson;
    public function assignClass(Classe $classe, Request $request)
    {
        $user = Auth::user();
        if ($user->assign()->where('classe_id', $classe->id)->exists()) {
            return $this->response_json(null, 400, "User has already assigned this class.");
        }
        elseif ($user->assign()->whereHas('classe.course', function ($query) use ($classe) {
            $query->where('course_id', $classe->course->id);
        })->exists()) {
            return $this->response_json(null, 400, "User has assigned to a class of this course.");
        }
        $assign = new Assign([
            'user_id' => $request->user()->id,
        ]);

        $classe->assigns()->save($assign);
        $data = [
            'User id' => $user->id,
            'User email' => $user->email,
            'First name' => $user->firstname,
            'Last name' => $user->lastname,
            'Class name' => $classe->name,
            'Course name' => $classe->course->name,
        ];

        return $this->response_json($data, 201, "Assign class successful.");
    }
    public function assign_list(){
        $user = Auth::user();
        $assign_class = Assign::where('user_id', $user->id)->get();
        return $this->response_json($assign_class, 200, "Your list assigns.");
    }
}
