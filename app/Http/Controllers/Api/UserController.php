<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Repository\IUserRepo;
use App\Http\Requests\UserProfileRequest;
use App\Http\Response\ResponseJson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use ResponseJson;
    protected IUserRepo $userRepo;
    public function __construct(IUserRepo $userRepo){
        $this->userRepo = $userRepo;
    }

    public function ShowProfile($id){
        $user = $this->userRepo->show_profile($id);
        return response()->json($user);
    }

    public function UpdateProfileUser(UserProfileRequest $request, $id){
        if(Auth::User()->id != $id){
            return $this->response_json(null, 403, "You are not allowed to do this action");
        }
        $profile = $request->all();
        $user = $this->userRepo->update_profile($id, $profile);
        return $this->response_json($user, 200, "Successive update profile.");
    }
}
