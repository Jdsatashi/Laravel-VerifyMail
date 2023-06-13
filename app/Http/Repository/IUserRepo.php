<?php
    namespace App\Http\Repository;

    interface IUserRepo{
        public function create_user(array $user);
        public function get_user($email);
        public function show_profile($id);
        public function update_profile($id, array $profile);
    }
