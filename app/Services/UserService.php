<?php

namespace App\Services;

use App\Models\User;
use App\DTOs\UserDTO;
use App\Exceptions\User\UserHasTicketsException;
use Illuminate\Pagination\LengthAwarePaginator;

class UserService {

    public function list($request): LengthAwarePaginator
    {
        return User::filter($request)
            ->orderBy('created_at','desc')
            ->paginate(10);
    }

    public function create(UserDTO $userDTO): User
    {
        return User::create($userDTO->toArrayHashed());
    }

    public function update(UserDTO $userDTO, User $user): bool
    {
        return $user->update($userDTO->toArray());
    }

    public function show(User $user): UserDTO
    {
        return UserDTO::fromModel($user);
    }

    public function delete(User $user): bool|null
    {
        if ($user->tickets()->exists()) {
            throw new UserHasTicketsException();
        }

        return $user->delete();
    }
}