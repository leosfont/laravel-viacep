<?php

namespace App\Http\Controllers;

use App\Http\Resources\SearchLocalCepResource;
use App\Services\ViaCepService;

class SearchController extends Controller
{
    protected $viaCepService;

    public function __construct(ViaCepService $viaCepService)
    {
        $this->viaCepService = $viaCepService;
    }

    public function search($ceps)
    {
        $cepArray = explode(',', $ceps);
        $results = [];

        foreach ($cepArray as $cep) {
            $data = $this->viaCepService->getAddressByCep($cep);

            if (!isset($data['erro'])) {
                $results[] = new SearchLocalCepResource((object) $data);
            }
        }

        return response()->json($results);
    }
}
