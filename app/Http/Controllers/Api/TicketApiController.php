<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Ticket;
use App\DTOs\TicketDTO;
use App\Services\TicketService;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Requests\Ticket\StoreRequest;
use App\Http\Requests\Ticket\UpdateRequest;
use App\Exceptions\TicketInvalidStatusException;
use App\Exceptions\TicketMissingCategoryException;
use Illuminate\Http\JsonResponse;

class TicketApiController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        protected TicketService $service
    ) {}
    
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        try {
            sleep(1);
            $data = $this->service->list();

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }

        return $this->successResponse($data, 'Listagem gerada com sucesso!');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        try {

            $dataDTO = TicketDTO::fromArray($request->validated());
            $this->service->create($dataDTO);

        } catch (TicketInvalidStatusException | TicketMissingCategoryException $e){
            return $this->errorResponse($e->getMessage(), 500);

        } catch (Exception $e) {
            return $this->errorResponse('Um erro inesperado: '.$e->getMessage(), 500);
        }

        return $this->successResponse([], 'Chamado criado com sucesso!', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Ticket $ticket): JsonResponse
    {
        try {

            $ticket = $this->service->show($ticket);

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }

        return $this->successResponse($ticket->toArray(), 'Operação realizada com sucesso!');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Ticket $ticket): JsonResponse
    {
        try {

            $data = TicketDTO::fromArray($request->validated());
            $this->service->update($data, $ticket);

        } catch (TicketInvalidStatusException | TicketMissingCategoryException $e){
            return $this->errorResponse($e->getMessage(), 500);

        } catch (Exception $e) {
            return $this->errorResponse('Um erro inesperado: '.$e->getMessage(), 500);
        }

        return $this->successResponse([], 'Registro atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket): JsonResponse
    {
        try {

            $this->service->delete($ticket);

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }

        return $this->successResponse([], 'Ticket excluído com sucesso!', 200);
    }
}
