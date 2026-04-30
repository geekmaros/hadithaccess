<?php

namespace Geekmaros\HadithAccess\AppService;

use GuzzleHttp\Client;

class AppService
{
    public Client $client;
    public function __construct(
        private readonly string $apiKey = '$2y$10$1uovWialwIWEJ9BFjB2V9Cuji2O3C775IEgVQAZBPpJkx2lq',
        private readonly string $apiUrl = 'https://hadithapi.com/api',
    )
    {
        $this->client = new Client([]);
    }

    public function getHadithBooks (): array {
        $response = $this->client->request('GET', $this->apiUrl.'/books', [
            'query' => [
                'apiKey' => $this->apiKey,
            ]
        ]);

        $hadithBooks =  json_decode($response->getBody()->getContents(), true);

        return $hadithBooks;
    }

    public function getHadithBook (string $bookSlug): array {

        $response = $this->client->request('GET', $this->apiUrl.'/'.$bookSlug.'/chapters', [
            'query' => [
                'apiKey' => $this->apiKey,
            ]
        ]);

        $hadithBook =  json_decode($response->getBody()->getContents(), true);
        return $hadithBook;

    }

    public function getHadithChapter (string $bookSlug, string $chapter): array {

        $response = $this->client->request('GET', $this->apiUrl.'/hadiths', [
            'query' => [
                'apiKey' => $this->apiKey,
                'book' => $bookSlug,
                'chapter' => $chapter,

            ]
        ]);

        $hadith=  json_decode($response->getBody()->getContents(), true);
        return $hadith;

    }



}
