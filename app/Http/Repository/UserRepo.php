<?php
    namespace App\Http\Repository;
    use App\Models\User;

    class UserRepo implements IUserRepo{
        public function create_user(array $user){
            return User::create($user);
        }

        public function get_user($email)
        {
            return User::where('email', $email)->first();
        }
    }
