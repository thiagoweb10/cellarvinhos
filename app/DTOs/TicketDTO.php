<?php

namespace App\DTOs;

use App\Models\Category;
use App\Models\Ticket;
use Illuminate\Support\Facades\Request;

class TicketDTO {

    public function __construct(
        public readonly ?int    $id,
        public readonly string  $title,
        public readonly string  $description,
        public readonly string  $status,
        public readonly int     $category_id,
        public readonly ?string $category_name = null,
        public readonly ?string $created_at = null,
        public readonly ?int    $user_id = null,
    ) {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            id: $request->input('id'),
            title: $request->input('title'),
            description: $request->input('description'),
            status: $request->input('status'),
            category_id: $request->input('category_id')
        );
    }

    public static function fromModel(Ticket $ticket): self
    {
        return new self(
            id: $ticket->id,
            title: $ticket->title,
            description: $ticket->description,
            status: $ticket->status,
            category_id: $ticket->category_id,
            category_name: $ticket->category->name ?? null,
            user_id: $ticket->user_id ?? null,
            created_at: $ticket->created_at?->format('d/m/Y H:i')
        );
    }

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            title: $data['title'],
            description: $data['description'],
            status: $data['status'],
            category_id: $data['category_id'],
            user_id: $data['user_id'] ?? null,
        );
    }

    public function toArray(): array
    {
        $data = [
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'category_id' => $this->category_id,
            'user_id' => $this->user_id,
        ];

        if (!is_null($this->id)) {
            $data['id'] = $this->id;
        }

        return $data;
    }
}
