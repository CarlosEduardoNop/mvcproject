<?php

namespace App\Http;

class Response
{
    private int $httpCode = 200;

    private array $headers = [];

    private string $contentType = 'text/html';

    private mixed $content;

    public function __construct($httpCode, $content, $contentType = 'text/html')
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);
    }

    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        $this->addHeaders([
            'Content-Type' => $contentType
        ]);
    }

    public function addHeaders($headers)
    {
        foreach ($headers as $key => $value) {
            $this->headers[$key] = $value;
        }
    }

    public function sendResponse()
    {
        $this->sendHeaders();

        switch ($this->contentType) {
            case 'text/html':
                echo $this->content;
                exit;
            case 'application/json':
                echo json_encode($this->content);
                exit;
        }
    }

    private function sendHeaders()
    {
        http_response_code($this->httpCode);

        foreach($this->headers as $key => $value) {
            header("{$key}:{$value}");
        }
    }
}