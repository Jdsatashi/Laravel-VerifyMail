<?php

namespace App\Http\Controllers\Auth;

use App\Events\GetVerifyEven;
use App\Http\Controllers\Controller;
use App\Http\Repository\IUserRepo;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Response\ResponseJson;
use App\Jobs\SendResetPassMail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    use ResponseJson;
    protected IUserRepo $userRepo;
    public function __construct(IUserRepo $userRepo){
        $this->userRepo = $userRepo;
    }

    public function Register(RegisterRequest $request) {
        $data = $request->all();
        $data['password'] = bcrypt($data['password']); // bcrypt password
        $user = $this->userRepo->create_user($data);
        event(new GetVerifyEven($user));

        return $this->response_json([
            'user' => $user,
            'token' => $user->createToken('Api of: '. $user->firstname)->plainTextToken,
        ], 200, "Register successful!");
    }
    public function Login(LoginRequest $request){
        $email = $request['email'];
        $user = $this->userRepo->get_user($email);
        if(!$user){
            return $this->response_json([
                'error' => 'User not found'
            ], 400);
        }
        elseif (!$user->is_active){
            event(new GetVerifyEven($user));
            return "Check email '{$user->email}' to activate your account";
        }
        return $this->response_json([
            "user" => $user,
            'token' => $user->createToken('Api of: '. $user->firstname)->plainTextToken,
        ], 200);
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return $this->response_json(null, 200, "Logout Success!");
    }

    public function ResetPassword(Request $request){
        $email = $request['email'];
        $user = $this->userRepo->get_user($email);
        if(!$user){
            return $this->response_json(null, 400, "User not found");
        }
        // handle reset password
        $newPassword = Str::random(12);
        $user->password = bcrypt($newPassword);
        $user->save();
        $data_user = [
            'email' => $user->email,
            'password' => $newPassword,
        ];
        SendResetPassMail::dispatch($data_user)->delay(now()->addSeconds(5));
        return $this->response_json($data_user['email'], 200,
            "New password has sent to your email!");
    }
}
