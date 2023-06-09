<?php
    namespace App\Http\Repository;

    interface IUserRepo{
        public function create_user(array $user);
        public function get_user($email);
    }
