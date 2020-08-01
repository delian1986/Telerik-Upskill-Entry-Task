<?php


namespace UpSkill;


use Core\Http\ContentApi;
use Core\Http\Response;

class UpSkillApiClient extends ContentApi
{
    private const API_BASE_URL = 'https://jsonmock.hackerrank.com/api/movies/search';

    private int $page = 1;

    public function setPage(int $page)
    {
        $this->page = $page;
    }

    public function request(string $searchTitle, string $method = 'GET'): Response
    {
        $path = self::API_BASE_URL.'/?Title='.$searchTitle;

        if ($this->page > 1) {
            $path.= $path.'&page='.$this->page;
        }
        $response = parent::request($method, $path);
         return $response;
    }
}