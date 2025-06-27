<?php

namespace App\DTOs;

class LoginUserDTO {

    public function __construct(
        public readonly string $email,
        public readonly string $password
    ) {}

    public static function fromArray($request): self
    {


        return new self (
            email: $request["email"],
            password: $request["password"]
        );
    }

}