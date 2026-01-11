<?php

declare(strict_types=1);

namespace App\User;

use App\Kernel\AbstractModule;

/**
 * User Module - manages user accounts and authentication.
 *
 * Responsibilities:
 *   - User registration (email + password)
 *   - Email confirmation
 *   - Password reset
 *   - Social network authentication (OAuth)
 */
final class UserModule extends AbstractModule
{
    /**
     * Load config files for User module.
     */
    public function getConfigFiles(): array
    {
        return [
            'services.yaml',
            'doctrine.yaml',  // Doctrine ORM mapping
        ];
    }

    /**
     * Load routes from routes.yaml.
     *
     * Routes are loaded from controller attributes in Infrastructure/Http/
     */
    public function getRouteFiles(): array
    {
        return ['routes.yaml'];
    }

    public function boot(): void
    {
        
    }
}
