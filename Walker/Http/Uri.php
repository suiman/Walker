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

    public function getScheme() {
        // TODO: Implement getScheme() method.
    }

    public function getAuthority() {
        // TODO: Implement getAuthority() method.
    }

    public function getUserInfo() {
        // TODO: Implement getUserInfo() method.
    }

    public function getHost() {
        // TODO: Implement getHost() method.
    }

    public function getPort() {
        // TODO: Implement getPort() method.
    }

    public function getPath() {
        // TODO: Implement getPath() method.
    }

    public function getQuery() {
        // TODO: Implement getQuery() method.
    }

    public function getFragment() {
        // TODO: Implement getFragment() method.
    }

    public function withScheme($scheme) {
        // TODO: Implement withScheme() method.
    }

    public function withUserInfo($user, $password = null) {
        // TODO: Implement withUserInfo() method.
    }

    public function withHost($host) {
        // TODO: Implement withHost() method.
    }

    public function withPort($port) {
        // TODO: Implement withPort() method.
    }

    public function withPath($path) {
        // TODO: Implement withPath() method.
    }

    public function withQuery($query) {
        // TODO: Implement withQuery() method.
    }

    public function withFragment($fragment) {
        // TODO: Implement withFragment() method.
    }

    public function __toString() {
        // TODO: Implement __toString() method.
    }


}