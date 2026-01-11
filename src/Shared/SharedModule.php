<?php

declare(strict_types=1);

namespace App\Shared;

use App\Kernel\AbstractModule;

/**
 * Shared module - provides cross-cutting concerns for all modules.
 *
 * Responsibilities:
 *   - Exception handling (DomainExceptionListener)
 *   - DTO serialization (DTODenormalizer)
 *   - HTTP utilities (OpenAPI responses)
 *   - Base configuration (_defaults, auto-registration)
 */
final class SharedModule extends AbstractModule
{
    /**
     * Shared module has no routes.
     */
    public function getRouteFiles(): array
    {
        return [];
    }

    public function getConfigFiles():array
    {
        return [
            'doctrine.yaml',
            'services.yaml',
        ];
    }
}
