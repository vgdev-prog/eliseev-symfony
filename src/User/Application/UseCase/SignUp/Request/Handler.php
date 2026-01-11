<?php

declare(strict_types=1);

namespace App\User\Application\UseCase\SignUp\Request;

use App\Model\Shared\Domain\Contracts\FlasherInterface;
use App\Shared\Domain\Contract\TokenGeneratorInterface;
use App\Shared\Domain\ValueObject\Id;
use App\User\Domain\Contract\PasswordHasherInterface;
use App\User\Domain\Contract\SignUpConfirmEmailSenderInterface;
use App\User\Domain\Contract\UserRepositoryInterface;
use App\User\Domain\Entity\User;
use App\User\Domain\ValueObject\Email;
use DateTimeImmutable;
use DomainException;

readonly class Handler
{
    public function __construct(
        private UserRepositoryInterface           $userRepository,
        private PasswordHasherInterface           $hasher,
        private TokenGeneratorInterface           $tokenGenerator,
        private SignUpConfirmEmailSenderInterface $sender,
        private FlasherInterface $flasher
    )
    {
    }

    public function handle(Command $command): void
    {
        $mail = Email::fromString($command->email);

        if ($this->userRepository->findOneBy(['email' => $mail])) {
            throw new DomainException('Email already exists');
        }

        $token = $this->tokenGenerator->generate();

       $user = new User(
           Id::next(),
           new DateTimeImmutable()
       );
       $user->signUpByEmail(
           $mail,
           $this->hasher->hash($command->password),
           $token
       );

        $this->userRepository->add($user);
        $this->flasher->flush();
        $this->sender->send($user->getEmail(), $token);

    }

}
