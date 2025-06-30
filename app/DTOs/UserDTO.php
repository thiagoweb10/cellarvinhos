<?php

namespace App\DTOs;

use App\Models\User;

class UserDTO {

    public function __construct(
        public readonly ?int    $id,
        public readonly string  $name,
        public readonly string  $document,
        public readonly string  $phone,
        public readonly ?string $photo = null,
        public readonly string  $email,
        public readonly string  $role,
        public readonly ?string $created_at,
        public readonly ?string $password
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            name: $data['name'],
            document: $data['document'],
            phone: $data['phone'] ?? null,
            photo: $data['photo'] ?? null,
            email: $data['email'],
            password: $data['password'] ?? null,
            role: $data['role'],
            created_at: $data['created_at'] ?? null,
        );
    }

    public static function fromModel(User $user): self
    {
        return new self(
            id: $user->id,
            name: $user->name,
            document: $user->document,
            phone: $user->phone,
            photo: $user->photo ?? null,
            email: $user->email,
            password: $user->password ?? null,
            role: $user->role,
            created_at: $user->created_at?->format('d/m/Y H:i')
        );
    }

    public function toArray(): array
    {
        $data = [
            'name' => $this->name,
            'document' => $this->document,
            'phone' => $this->phone,
            'photo' => $this->photo ?? null,
            'email' => $this->email,
            'role'  => $this->role,
            'created_at' => $this->created_at?->format('d/m/Y H:i') ?? date('Y/m/d H:i')
        ];

        if (!is_null($this->id)) {
            $data['id'] = $this->id;
        }

        return $data;
    }

    public function toArrayHashed(): array
{
    return [
        'name' => $this->name,
        'email' => $this->email,
        'document' => $this->document,
        'phone' => $this->phone,
        'photo' => $this->photo,
        'role' => $this->role,
        'password' => \Hash::make($this->password),
    ];
}
}