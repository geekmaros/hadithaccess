<?php

namespace Geekmaros\HadithAccess\AppService;

use GuzzleHttp\Client;

class AppService
{
    public Client $client;
    private string $apiKey;

    public function __construct(
        private readonly string $apiUrl = 'https://hadithapi.com/api',
    )
    {
        $apiKey = getenv('HADITH_API_KEY') ?: ($_ENV['HADITH_API_KEY'] ?? '');

        if ($apiKey === '') {
            throw new \RuntimeException('HADITH_API_KEY environment variable is not set.');
        }

        $this->apiKey = $apiKey;
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

    public function getHadithChapter (string $bookSlug, string $chapter, int $page = 1): array {

        $response = $this->client->request('GET', $this->apiUrl.'/hadiths', [
            'query' => [
                'apiKey' => $this->apiKey,
                'book' => $bookSlug,
                'chapter' => $chapter,
                'page' => max(1, $page),

            ]
        ]);

        $hadith=  json_decode($response->getBody()->getContents(), true);
        return $hadith;

    }



}
