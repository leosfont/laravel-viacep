<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Services\ViaCepService;
use Mockery;
use Mockery\MockInterface;

class SearchTest extends TestCase
{

    public function testSearchReturnsExpectedJsonForMultipleCepsWithViaCepIntegration()
    {
        $response = $this->get('api/search/local/01001000,17560246');

        $response->assertStatus(200);

        $response->assertJson([
            [
                'cep' => '01001-000',
                'label' => 'Praça da Sé, São Paulo',
                'logradouro' => 'Praça da Sé',
                'complemento' => 'lado ímpar',
                'bairro' => 'Sé',
                'localidade' => 'São Paulo',
                'uf' => 'SP',
                'ibge' => '3550308',
                'gia' => '1004',
                'ddd' => '11',
                'siafi' => '7107',
            ],
            [
                'cep' => '17560-246',
                'label' => 'Avenida Paulista, Vera Cruz',
                'logradouro' => 'Avenida Paulista',
                'complemento' => 'de 1600/1601 a 1698/1699',
                'bairro' => 'CECAP',
                'localidade' => 'Vera Cruz',
                'uf' => 'SP',
                'ibge' => '3556602',
                'gia' => '7134',
                'ddd' => '14',
                'siafi' => '7235',
            ]
        ]);
    }


    public function testSearchReturnsExpectedJsonForMultipleCepsWithViaCepMock()
    {
        $this->mock(ViaCepService::class, function (MockInterface $mock) {
            $mock->shouldReceive('getAddressByCep')
                ->with('01001000')
                ->once()
                ->andReturn([
                    'cep' => '01001000',
                    'logradouro' => 'Praça da Sé',
                    'complemento' => 'lado ímpar',
                    'bairro' => 'Sé',
                    'localidade' => 'São Paulo',
                    'uf' => 'SP',
                    'ibge' => '3550308',
                    'gia' => '1004',
                    'ddd' => '11',
                    'siafi' => '7107',
                ]);

            $mock->shouldReceive('getAddressByCep')
                ->with('17560246')
                ->once()
                ->andReturn([
                    'cep' => '17560246',
                    'logradouro' => 'Avenida Paulista',
                    'complemento' => 'de 1600/1601 a 1698/1699',
                    'bairro' => 'CECAP',
                    'localidade' => 'Vera Cruz',
                    'uf' => 'SP',
                    'ibge' => '3556602',
                    'gia' => '7134',
                    'ddd' => '14',
                    'siafi' => '7235',
                ]);
        });

        $response = $this->get('api/search/local/01001000,17560246');

        $response->assertStatus(200);

        $response->assertJson([
            [
                'cep' => '01001000',
                'label' => 'Praça da Sé, São Paulo',
                'logradouro' => 'Praça da Sé',
                'complemento' => 'lado ímpar',
                'bairro' => 'Sé',
                'localidade' => 'São Paulo',
                'uf' => 'SP',
                'ibge' => '3550308',
                'gia' => '1004',
                'ddd' => '11',
                'siafi' => '7107',
            ],
            [
                'cep' => '17560246',
                'label' => 'Avenida Paulista, Vera Cruz',
                'logradouro' => 'Avenida Paulista',
                'complemento' => 'de 1600/1601 a 1698/1699',
                'bairro' => 'CECAP',
                'localidade' => 'Vera Cruz',
                'uf' => 'SP',
                'ibge' => '3556602',
                'gia' => '7134',
                'ddd' => '14',
                'siafi' => '7235',
            ]
        ]);
    }
}
