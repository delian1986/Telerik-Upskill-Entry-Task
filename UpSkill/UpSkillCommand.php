<?php

namespace UpSkill;

use Core\Command;
use Core\Exception\InvalidInputParamenerException;
use Core\Interfaces\InputInterface;
use Core\Interfaces\OutputInterface;

class UpSkillCommand extends Command
{
    private const BASE_URL = 'https://jsonmock.hackerrank.com/api/movies/search/';

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \JsonException|InvalidInputParamenerException
     */
    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $searchTitle = $input->getParams();

        if (null === $searchTitle) {
            throw new InvalidInputParamenerException('Search title parameter is required');
        }

        $httpClient = $this->getApplication()->getContentApi();
        $httpClient->setBaseUrl(self::BASE_URL);

        $collection = new ArrayCollection();

        $page = 0;
        while (true)
        {
            $response = $httpClient->request('GET', ['Title' => $searchTitle, 'page' => ++$page]);
            $totalPages = $response->getBody()['total_pages'];
            $responseData = $response->getBody()['data'];
            $collection->add($responseData);

            if ($page >= $totalPages) {
                break;
            }
        }

        $collection->sort();

        $output->write($collection->get());

        return 0;
    }
}