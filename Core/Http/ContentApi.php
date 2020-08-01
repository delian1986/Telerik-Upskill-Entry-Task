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
     * @param string $path Define api endpoint
     * @return Response
     * @throws \JsonException
     */
    public function request(string $method, string $path) : Response
    {
        $this->curl->addMethod($method);

        $this->setContentType('application/json');

        $this->curl->addHTTPHeader($this->headers);

        $body = $this->curl->exec($path);

        return new Response($this->curl->getCode(), $body);
    }
}
