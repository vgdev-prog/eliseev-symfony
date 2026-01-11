<?php

declare(strict_types=1);

namespace App\User\Application\UseCase\Reset\Request;

use App\Model\Shared\Domain\Contracts\FlasherInterface;
use App\User\Domain\Contract\ResetTokenSenderInterface;
use App\User\Domain\Contract\UserRepositoryInterface;
use App\User\Domain\ValueObject\Email;
use App\User\Infrastructure\Services\ResetTokenizer;

class Handler
{
    public function __construct(
        private UserRepositoryInterface $users,
        private ResetTokenizer $tokenGenerator,
        private FlasherInterface $flasher,
        private ResetTokenSenderInterface $resetTokenSender,
    )
    {
    }

    public function handle(Command $command): void
    {
        $user = $this->users->getByEmail(Email::fromString($command->email));

        if (!$user) {
            throw new \DomainException('User not found');
        }

        $user->requestPasswordReset(
           $this->tokenGenerator->generate(),
            new \DateTimeImmutable()
        );

        $this->flasher->flush();
        $this->resetTokenSender->send();
    }

}
