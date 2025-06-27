<?php

namespace App\Services;

use App\Models\User;

class UserService {

    public function getListAll($request) {

        return User::filter($request)->paginate(10);
    }
}