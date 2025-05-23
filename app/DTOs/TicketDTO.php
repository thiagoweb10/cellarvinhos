<?php

namespace App\DTOs;

use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Support\Facades\Request;

class TicketDTO {

    public function __construct(
        public readonly string $title,
        public readonly string $description,
        public readonly string $status,
        public readonly int    $category_id
    ) {}


    public static function fromRequest(Request $request): self
    {
        return new self(
            title: $request->input('title'),
            description: $request->input('description'),
            status: $request->input('status'),
            category_id: $request->input('category_id')
        );
    }

    public static function fromModel(Ticket $ticket): self
    {
        return new self(
            title: $ticket->title,
            description: $ticket->description,
            status: $ticket->status,
            category_id: $ticket->category_id
        );
    }
    
    public static function fromArray(array $data): self
    {
        return new self(
            title: $data['title'],
            description: $data['description'],
            status: $data['status'],
            category_id: $data['category_id']
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'category_id' => $this->category_id
        ];
    }
}