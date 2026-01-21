<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObject;

class FrontendUrl
{
    public function __construct(
        private string $baseUrl,
    )
    {
    }

    public function confirmEmail(string $token)
    {
        return $this->buildUrl('/auth/login',['token' => $token]);
    }

    private function buildUrl(string $path, array $params = []): string
    {
        $url = rtrim($this->baseUrl, '/') . $path;

        if (!empty($params)) {
            $url .= '?' . http_build_query($params);
        }
        return $url;
    }


}
