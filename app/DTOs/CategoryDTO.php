<?php

namespace App\DTOs;

use App\Models\Category;
use Illuminate\Support\Facades\Request;

class CategoryDTO {

    public function __construct(
        public readonly string $name
    ) {}


    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->input('name')
        );
    }

    public static function fromModel(Category $category): self
    {
        return new self(
            name: $category->name
        );
    }
    
    public static function fromArray(array $data): self
    {
        return new self(
            name: $data['name']
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}