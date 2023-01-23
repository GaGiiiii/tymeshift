<?php

namespace Tymeshift\PhpTest\Components;

class HttpClient implements HttpClientInterface
{
    /**
     * Returns json decoded response body
     * @param string $method
     * @param string $uri
     * @return array
     */
    public function request(string $method, string $uri): array
    {
        return [];
    }
}
