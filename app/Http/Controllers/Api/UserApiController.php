<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
use App\DTOs\UserDTO;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;

class UserApiController extends Controller
{
    use ApiResponseTrait;
    
    public function __construct(
       protected UserService  $service
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        try {

            $data = $this->service->list($request->only(["name","document","status"]));
            
            return $this->successResponse($data, 'Listagem gerada com sucesso!');

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        try {

            $dataDTO = UserDTO::fromArray($request->validated());
            $this->service->create($dataDTO);

            return $this->successResponse([], 'Usuario criado com sucesso!', 201);
            
        } catch (Exception $e) {
            return $this->errorResponse('Um erro inesperado: '.$e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user): JsonResponse
    {
        try {

            $user = $this->service->show($user);
            
            return $this->successResponse($user->toArray(), 'Operação realizada com sucesso!');

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, User $user): JsonResponse
    {
        try {
            $data = UserDTO::fromArray(
                array_merge($request->validated(), ['id' => $user->id])
            );
            
            $this->service->update($data, $user);

            return $this->successResponse([], 'Registro atualizado com sucesso!');

        } catch (Exception $e) {
            return $this->errorResponse('Um erro inesperado: '.$e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user): JsonResponse
    {
        try {

            $this->service->delete($user);

            return $this->successResponse([], 'Registro excluído com sucesso!', 200);

        } catch (Exception $e) {
            return $this->errorResponse($e->getMessage(), 500);
        }
    }
}