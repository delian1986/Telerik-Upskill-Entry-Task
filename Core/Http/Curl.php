<?php

namespace Core\Http;

class Curl
{
    private $ch;
    private $info;
    private $n;
    private $timeout;
    private $method;

    public function __construct(int $n = 0, int $timeout = 5)
    {
        $this->n = $n;
        $this->info = array();
        $this->ch = curl_init();
        $this->timeout = $timeout;

        $this->setAgent();
    }

    private function setAgent() : void
    {
        $this->info['agent'] = 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1';
    }

    /**
     * @param string $name
     */
    public function addMethod(string $name = 'GET') : void
    {
        $this->method = $name;
    }

    /**
     * @param string $url
     *
     * @return string
     */
    public function exec($url) : string
    {
        curl_setopt($this->ch, CURLOPT_URL, $url);
        curl_setopt($this->ch, CURLOPT_USERAGENT, $this->info['agent']);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, $this->timeout);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->ch, CURLOPT_COOKIEJAR, $this->info['cookie']);
        curl_setopt($this->ch, CURLOPT_COOKIEFILE, $this->info['cookie']);
        curl_setopt($this->ch, CURLINFO_HEADER_OUT, true);
        curl_setopt($this->ch, CURLOPT_HEADER, false);

        if (isset($this->headers)) {
            curl_setopt($this->ch, CURLOPT_HTTPHEADER, $this->headers);
        }

        if ($this->method !== false) {
            curl_setopt($this->ch, CURLOPT_CUSTOMREQUEST, $this->method);
        }

        $t = '';
        while ($t == '') {
            $t = curl_exec($this->ch);
        }
        $this->r_text = $t;
        $this->r_info = curl_getinfo($this->ch, CURLINFO_HTTP_CODE);

        return $this->r_text;
    }

    public function getCode() : int
    {
        return $this->r_info;
    }
}
