<?php

namespace Walker\Http;

use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

class Message implements MessageInterface
{
    protected $headers;

    protected $body;

    protected $protocolVersion;


    public function getProtocolVersion()
    {
        return $this->protocolVersion;
    }

    public function withProtocolVersion($version)
    {
        $clone = clone $this;
        $clone->protocolVersion = $version;
        return $clone;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function hasHeader($name)
    {
        foreach ($this->headers as $header_name => $values) {
            if (strtolower($header_name) === strtolower($name)) {
                return true;
            }
        }
        return false;
    }

    public function getHeader($name)
    {
        foreach ($this->headers as $header_name => $values) {
            if (strtolower($header_name) === strtolower($name)) {
                return $this->headers[$header_name];
            }
        }
        return array();
    }

    public function getHeaderLine($name)
    {
        return implode(',', $this->getHeader($name));
    }

    public function withHeader($name, $value)
    {
        $clone = clone $this;
        if ($this->hasHeader($name)) {
            foreach ($clone->headers as $header_name => $values) {
                if (strtolower($header_name) === strtolower($name)) {
                    $clone->headers[$header_name] = $value;
                }
            }
        } else {
            $clone->headers[$name] = $value;
        }
        return $clone;
    }

    public function withAddedHeader($name, $value)
    {
        $clone = clone $this;
        if ($this->hasHeader($name)) {
            foreach ($clone->headers as $header_name => $values) {
                if (strtolower($header_name) === strtolower($name)) {
                    $values[] = $value;
                    $clone->headers[$header_name] = $values;
                }
            }
        } else {
            $clone->headers[$name] = $value;
        }
        return $clone;
    }

    public function withoutHeader($name)
    {
        $clone = clone $this;
        foreach ($clone->headers as $header_name => $values) {
            if (strtolower($header_name) === strtolower($name)) {
                unset($clone->headers[$header_name]);
            }
        }
        return $clone;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function withBody(StreamInterface $body)
    {
        $clone = clone $this;
        $clone->body = $body;
        return $clone;
    }
}