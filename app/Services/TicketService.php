<?php

namespace App\Services;

use App\Models\Ticket;
use App\DTOs\TicketDTO;
use App\Models\Category;
use App\Enums\TicketStatus;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Exceptions\TicketInvalidStatusException;
use App\Exceptions\TicketMissingCategoryException;

class TicketService {

    public function list($request): LengthAwarePaginator
    {
        $tickets = Ticket::Filter($request->only(['status', 'category_id', 'title']))
                    ->with('category')
                    ->orderBy('created_at','desc')
                    ->paginate(9);

        $tickets->getCollection()->transform(function($ticket){
            return TicketDTO::fromModel($ticket);
        });

        return $tickets;
    }

    public function create(TicketDTO $ticketDTO): Ticket
    {
        if (!in_array($ticketDTO->status, TicketStatus::values())) {
            throw new TicketInvalidStatusException($ticketDTO->status);
        }

        if (!Category::find($ticketDTO->category_id)) {
            throw new TicketMissingCategoryException();
        }
        
        return Ticket::create($ticketDTO->toArray());
    }

    public function update(TicketDTO $ticketDTO, Ticket $ticket): bool
    {
        if (!in_array($ticketDTO->status, TicketStatus::values())) {
            throw new TicketInvalidStatusException($ticketDTO->status);
        }

        if (!Category::find($ticketDTO->category_id)) {
            throw new TicketMissingCategoryException();
        }
        
        return $ticket->update($ticketDTO->toArray());
    }

    public function show(Ticket $ticket): TicketDTO
    {
        return TicketDTO::fromModel($ticket);
    }

    public function delete(Ticket $ticket): bool|null
    {
        return $ticket->delete();
    }
}