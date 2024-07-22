<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ViaCepService
{
    protected $baseUrl;

    public function __construct(string $baseUrl = 'https://viacep.com.br')
    {
        $this->baseUrl = $baseUrl;
    }

    public function getAddressByCep(string $cep): array
    {
        $response = Http::get("{$this->baseUrl}/ws/{$cep}/json/");
        return $response->json();
    }

    public function getAddressesByCeps(array $ceps): array
    {
        $results = [];
        foreach ($ceps as $cep) {
            $results[] = $this->getAddressByCep($cep);
        }
        return $results;
    }
}
