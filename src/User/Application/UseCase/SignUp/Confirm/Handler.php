<?php

declare(strict_types=1);

namespace App\User\Application\UseCase\SignUp\Confirm;

use App\Model\Shared\Domain\Contracts\FlasherInterface;
use App\User\Domain\Contract\UserRepositoryInterface;
use DomainException;

readonly class Handler
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private FlasherInterface        $flasher
    )
    {
    }

    public function handle(Command $command): void
    {

        if (!$user = $this->userRepository->findByConfirmToken($command->token)) {
            throw new DomainException('Incorrect confirmed token');
        }

        $user->confirmSignUp();
        $this->flasher->flush();
    }

}
