<?php
/**
 * Created by PhpStorm.
 * User: suiman
 * Date: 17/3/15
 * Time: 下午8:36
 */

namespace Walker\Http;

use Psr\Http\Message\UriInterface;

class Uri implements UriInterface
{
    protected $scheme = '';

    protected $authority = '';

    protected $userinfo = '';

    protected $host = '';

    protected $port = '';

    protected $path = '';

    protected $query = '';

    protected $fragment = '';

    public function __construct(Environment $environment) {
        $this->host = $environment->get('HTTP_HOST');
        $request_uri = $environment->get('REQUEST_URI');
        $this->scheme = parse_url($request_uri, PHP_URL_SCHEME);
        $this->authority = parse_url($request_uri, PHP_URL_PASS);
        $this->userinfo = parse_url($request_uri, PHP_URL_USER);
        $this->port = parse_url($request_uri, PHP_URL_PORT);
        $this->path = parse_url($request_uri, PHP_URL_PATH);
        $this->query = parse_url($request_uri, PHP_URL_QUERY);
        $this->fragment = parse_url($request_uri, PHP_URL_FRAGMENT);
    }

    public function getScheme() {
        return $this->scheme;
    }

    public function getAuthority() {
        return $this->authority;
    }

    public function getUserInfo() {
        return $this->userinfo;
    }

    public function getHost() {
        return $this->host;
    }

    public function getPort() {
        return $this->port;
    }

    public function getPath() {
        return $this->path;
    }

    public function getQuery() {
        return $this->query;
    }

    public function getFragment() {
        return $this->fragment;
    }

    public function withScheme($scheme) {
        $clone = clone $this;
        $clone->scheme = $scheme;
        return $clone;
    }

    public function withUserInfo($user, $password = null) {
        $clone = clone $this;
        $clone->userinfo = $user;
        return $clone;
    }

    public function withHost($host) {
        $clone = clone $this;
        $clone->host = $host;
        return $clone;
    }

    public function withPort($port) {
        $clone = clone $this;
        $clone->port = $port;
        return $clone;
    }

    public function withPath($path) {
        $clone = clone $this;
        $clone->path = $path;
        return $clone;
    }

    public function withQuery($query) {
        $clone = clone $this;
        $clone->query = $query;
        return $clone;
    }

    public function withFragment($fragment) {
        $clone = clone $this;
        $clone->fragment = $fragment;
        return $clone;
    }

    public function __toString() {

    }


}