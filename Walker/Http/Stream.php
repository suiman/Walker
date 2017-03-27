<?php
/**
 * Created by PhpStorm.
 * User: suiman
 * Date: 2017/3/27
 * Time: 下午11:21
 */

namespace Walker\Http;

use Psr\Http\Message\StreamInterface;

class Stream implements StreamInterface
{
    protected $stream;

    protected $seekable;

    protected $writable;

    protected $readable;

    protected $size;

    protected $meta;

    public function __construct($newStream)
    {
        if (is_resource($this->stream)) {
            $this->detach();
        }
        if (is_resource($newStream)) {
            $this->stream = $newStream;
        }
    }

    public function __toString()
    {
        // TODO: Implement __toString() method.
    }

    public function close()
    {
        // TODO: Implement close() method.
    }

    public function detach()
    {
        $this->stream = null;
        $this->seekable = null;
        $this->writable = null;
        $this->readable = null;
        $this->size = null;
        $this->meta = null;
    }

    public function getSize()
    {
        if (!$this->size && is_resource($this->stream)) {
            $stats = fstat($this->stream);
            $this->size = $stats['size'];
        }
        return $this->size;
    }

    public function tell()
    {
        $position = null;
        if(is_resource($this->stream)) {
            $position = ftell($this->stream);
        }
        return $position;
    }

    public function eof()
    {
        return is_resource($this->stream) ? feof($this->stream) : true;
    }

    public function isSeekable()
    {
        if (is_null($this->seekable)) {
            $this->seekable = false;
            if (is_resource($this->stream)) {
                $this->seekable = $this->getMetadata('seekable');
            }
        }
        return $this->seekable;
    }

    public function seek($offset, $whence = SEEK_SET)
    {
        // TODO: Implement seek() method.
    }

    public function rewind()
    {
        // TODO: Implement rewind() method.
    }

    public function isWritable()
    {
        // TODO: Implement isWritable() method.
    }

    public function write($string)
    {
        // TODO: Implement write() method.
    }

    public function isReadable()
    {
        // TODO: Implement isReadable() method.
    }

    public function read($length)
    {
        // TODO: Implement read() method.
    }

    public function getContents()
    {
        // TODO: Implement getContents() method.
    }

    public function getMetadata($key = null)
    {
        $this->meta = stream_get_meta_data($this->stream);
        if (is_null($key)) {
            return $this->meta;
        }
        return isset($this->meta[$key]) ? $this->meta[$key] : null;
    }


}