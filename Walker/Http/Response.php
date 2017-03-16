<?php

namespace Walker\Http;

use Psr\Http\Message\ResponseInterface;
use Walker\Http\Message;

class Response extends Message implements ResponseInterface
{
    public function getStatusCode() {
        // TODO: Implement getStatusCode() method.
    }

    public function withStatus($code, $reasonPhrase = '') {
        // TODO: Implement withStatus() method.
    }

    public function getReasonPhrase() {
        // TODO: Implement getReasonPhrase() method.
    }

}