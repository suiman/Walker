<?php

namespace Walker\Http;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;
use Walker\Http\Uri;

class Request extends Message implements ServerRequestInterface
{
    protected $requestTarget;

    protected $method;

    protected $uri;

    protected $serverParams;

    protected $cookieParams;

    protected $queryParams;

    protected $uploadFiles;

    protected $parsedBody;

    protected $attributes;


    public function __construct(Environment $environment) {
        $this->requestTarget = ''; //todo
        $this->method = $environment->get('REQUEST_METHOD');
        $this->uri = new Uri($environment);
        $this->serverParams = $environment->getAll();
        $this->cookieParams = $_COOKIE;
        $this->queryParams = $_GET;
        $this->uploadFiles = $_FILES;
        $this->parsedBody = $_POST;
        $this->attributes = array(); //todo
    }

    public function getRequestTarget() {
        return $this->requestTarget;
    }

    public function withRequestTarget($requestTarget) {
        // TODO: Implement withRequestTarget() method.
    }

    public function getMethod() {
        return $this->method;
    }

    public function withMethod($method) {
        // TODO: Implement withMethod() method.
    }

    public function getUri() {
        return $this->uri;
    }

    public function withUri(UriInterface $uri, $preserveHost = false) {
        // TODO: Implement withUri() method.
    }

    public function getServerParams() {
        return $this->serverParams;
    }

    public function getCookieParams() {
        return $this->cookieParams;
    }

    public function withCookieParams(array $cookies) {
        // TODO: Implement withCookieParams() method.
    }

    public function getQueryParams() {
        return $this->queryParams;
    }

    public function withQueryParams(array $query) {
        // TODO: Implement withQueryParams() method.
    }

    public function getUploadedFiles() {
        return $this->uploadFiles;
    }

    public function withUploadedFiles(array $uploadedFiles) {
        // TODO: Implement withUploadedFiles() method.
    }

    public function getParsedBody() {
        return $this->parsedBody;
    }

    public function withParsedBody($data) {
        // TODO: Implement withParsedBody() method.
    }

    public function getAttributes() {
        return $this->attributes;
    }

    public function getAttribute($name, $default = null) {
        if (isset($this->attributes[$name])) {
            return $this->attributes[$name];
        } else {
            return $default;
        }
    }

    public function withAttribute($name, $value) {
        // TODO: Implement withAttribute() method.
    }

    public function withoutAttribute($name) {
        // TODO: Implement withoutAttribute() method.
    }

}