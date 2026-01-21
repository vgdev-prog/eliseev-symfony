<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Http;

use App\User\Application\Command\SignUpByEmailHandler;
use App\User\Infrastructure\Http\SignUp\Request\SignUpRequest;
use App\User\Infrastructure\Http\SignUp\Response\SignUpResource;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

#[Route(name: 'auth.')]
class SignUpController
{
    #[Route('/sign-up', name: 'sign-up', methods: ['POST'])]
    public function registerByMail(
        #[MapRequestPayload] SignUpRequest $request,
        SignUpByEmailHandler               $handler
    ): JsonResponse
    {
        $context = $request->toCommand();
        $userId = $handler->handle($context);
        return new JsonResponse(
            data: SignUpResource::make($userId),
        );
    }

    #[Route("/sign-up/confirm/{token}", name: 'sign-up.confirm', methods: ['GET'])]
    public function registerConfirm()
    {

    }
}
