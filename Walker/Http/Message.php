<?php

namespace Walker\Http;

use Psr\Http\Message\MessageInterface;

class Message implements MessageInterface
{
    protected $headers;

    protected $body;

    protected $protocolVersion;


    public function getProtocolVersion() {
        // TODO: Implement getProtocolVersion() method.
    }

    public function withProtocolVersion($version) {
        // TODO: Implement withProtocolVersion() method.
    }

    public function getHeaders() {
        // TODO: Implement getHeaders() method.
    }

    public function hasHeader($name) {
        // TODO: Implement hasHeader() method.
    }

    public function getHeader($name) {
        // TODO: Implement getHeader() method.
    }

    public function getHeaderLine($name) {
        // TODO: Implement getHeaderLine() method.
    }

    public function withHeader($name, $value) {
        // TODO: Implement withHeader() method.
    }

    public function withAddedHeader($name, $value) {
        // TODO: Implement withAddedHeader() method.
    }

    public function withoutHeader($name) {
        // TODO: Implement withoutHeader() method.
    }

    public function getBody() {
        // TODO: Implement getBody() method.
    }

    public function withBody(\Psr\Http\Message\StreamInterface $body) {
        // TODO: Implement withBody() method.
    }
}