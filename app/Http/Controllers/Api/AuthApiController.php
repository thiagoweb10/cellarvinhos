<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\DTOs\LoginUserDTO;
use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Actions\Auth\LoginUserAction;
use App\Actions\Auth\LogoutUserAction;
use App\Http\Requests\Auth\LoginRequest;
use App\Exceptions\Auth\InvalidCredentialsException;

class AuthApiController extends Controller
{
    use ApiResponseTrait;

    public function __construct(
        protected LoginUserAction $loginUserAction,
        protected LogoutUserAction $logoutUserAction
    ) {}
    
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            
            $dto = LoginUserDTO::fromArray($request->validated());
            $token = $this->loginUserAction->execute($dto);

            return $this->successResponse($token, 'Login realizado com sucesso!');

        }  catch (InvalidCredentialsException $e) {
            throw $e;
        }catch (\Exception $e) {
            return $this->errorResponse($e->getMessage());
        }
    }

    public function me(Request $request): JsonResponse
    {
        return $this->successResponse($request->user(), '');
    }

    public function logout($user): JsonResponse
    {
        $this->logoutUserAction->execute($user);

        return $this->successResponse('Logout realizado com sucesso!');
    }
    
}