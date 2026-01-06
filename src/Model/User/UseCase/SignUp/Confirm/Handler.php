<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\SignUp\Request;

use App\Model\User\Contracts\PasswordHasherInterface;
use App\Model\User\Contracts\SignUpConfirmEmailSenderInterface;
use App\Model\User\Contracts\TokenGeneratorInterface;
use App\Model\User\Contracts\UserRepositoryInterface;
use App\Model\User\Entity\User\User;
use App\Model\User\Enum\UserStatus;
use App\Model\User\ValueObject\Email;
use App\Model\User\ValueObject\Id;
use DateTimeImmutable;
use DomainException;

readonly class Handler
{
    public function __construct(
        private UserRepositoryInterface           $userRepository,
    )
    {
    }

    public function handle(Command $command): void
    {

        if (!$user = $this->userRepository->findByConfirmToken(['token' => $command->token])) {
            throw new DomainException('Incorrect confirmed token');
        }

        $this->userRepository->confirmSignUp();
        $this->userRepository->flush();
    }

}
