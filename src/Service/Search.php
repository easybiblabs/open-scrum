<?php
namespace ImagineEasy\OpenScrum\Service;

use Guzzle\Http;

class Search
{
    private $milestone;

    private $repository;

    private $state;

    private $token;

    private $endpoint = 'https://api.github.com';
    private $url = '/search/issues';

    public function __construct($repository, $milestone, $state, $token)
    {
        $this->repository = $repository;
        $this->milestone = $milestone;
        $this->state = $state;
        $this->token = $token;
    }

    public function getIssues()
    {
        $filter  = '';
        $filter .= $this->getFilter('milestone', $this->milestone);
        $filter .= ' ';
        $filter .= $this->getFilter('is', $this->getState(), false);
        $filter .= ' ';
        $filter .= $this->getFilter('repo', $this->repository, false);

        $http = new Http\Client($this->endpoint);
        $request = $http->get(
            $this->url,
            [],
            [
                'headers' => [
                    'Accept' => 'application/vnd.github.v3+json',
                ],
                'query' => [
                    'q' => $filter,
                    'access_token' => $this->token,
                ],
            ]
        );

        $response = $request->send();
        if (true === $response->isError()) {
            throw new \RuntimeException($response->getBody(true));
        }

        return json_decode($response->getBody(true), true);
    }

    private function getFilter($field, $value, $escape = true)
    {
        if (true === $escape) {
            return sprintf('%s:"%s"', $field, $value);
        }

        return sprintf('%s:%s', $field, $value);
    }

    private function getState()
    {
        if ('all' == $this->state) {
            throw new \BadMethodCallException("'all' is not implemented yet.");
        }

        return $this->state;
    }
}