<?php

declare(strict_types=1);

namespace App\User\Application\UseCase\SignUp\Confirm;

use App\Model\Shared\Domain\Contracts\FlasherInterface;
use App\Shared\Domain\Contract\FlusherInterface;
use App\User\Domain\Contract\UserRepositoryInterface;
use App\User\Domain\Exceptions\IncorrectTokenException;
use DomainException;

readonly class Handler
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private FlusherInterface $flusher
    )
    {
    }

    public function handle(Command $command): void
    {

        if (!$user = $this->userRepository->findByConfirmToken($command->token)) {
            throw new IncorrectTokenException();
        }

        $user->confirmSignUp();
        $this->flusher->flush();
    }

}
