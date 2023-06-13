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

        public function show_profile($id)
        {
            // TODO: Implement show_profile() method.
            return User::findOrFail($id);
        }

        public function update_profile($id, array $profile)
        {
            $user = User::findOrFail($id);
            $user->update($profile);
            return $user;
        }
    }
