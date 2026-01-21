<?php

declare(strict_types=1);

namespace App\User\Infrastructure\Listeners;

use App\Shared\Domain\ValueObject\Email;
use App\User\Domain\Contract\UserMailerInterface;
use App\User\Domain\Contract\UserRepositoryInterface;
use App\User\Domain\Event\UserSignedUpByEmail;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;

#[AsEventListener(
    event: UserSignedUpByEmail::class,
)]
class SignedByEmailListener
{
    public function __construct(
        private UserRepositoryInterface $userRepository,
        private UserMailerInterface $mailer,
    )
    {
    }

    public function __invoke(UserSignedUpByEmail $event): void
    {
        $user = $this->userRepository->getByEmail(Email::fromString($event->getEmail()));

        if (!$user) {
            return;
        }

        $this->mailer->sendConfirmation($user->getEmail(), $user->getConfirmToken());
    }


}
