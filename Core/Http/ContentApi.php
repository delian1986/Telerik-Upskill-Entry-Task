<?php
namespace Core\Http;


class ContentApi
{
    private Curl $curl;

    private array $headers;

    private string $baseUrl;

    public function __construct(Curl $curl)
    {
        $this->curl = $curl;
    }

    /**
     * Get the value of apiAddr
     */
    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }

    /**
     * Set the value of apiAddr
     *
     * @param string $baseUrl
     * @return self
     */
    public function setBaseUrl(string $baseUrl): self
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    public function setContentType(string $type = 'json') : void
    {
        $this->headers[] = 'Content-Type: '.$type;
    }

    /**
     * @param string $method Define http method 'GET', 'POST'...
     * @param array $query
     * @param string $contentType
     * @return Response
     * @throws \JsonException
     */
    public function request(string $method = 'GET', array $query = [], string $contentType = 'application/json') : Response
    {
        $this->curl->addMethod($method);

        $this->setContentType($contentType);

        $this->curl->addHTTPHeader($this->headers);

        $queryString = null;
        if (!empty($query)) {
            $queryString = $this->dispatchQueryParams($query);
        }

        $body = $this->curl->exec($this->getBaseUrl().$queryString);

        return new Response($this->curl->getCode(), $body);
    }

    private function dispatchQueryParams(array $query = []): string
    {
        $queryString = '?';

        foreach ($query as $key => $value){
            $queryString .= $key .'=' . $value . '&';
        }

        return rtrim($queryString, '&');
    }
}
