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
    protected static $modes = [
        'readable' => ['r', 'r+', 'w+', 'a+', 'x+', 'c+'],
        'writable' => ['r+', 'w', 'w+', 'a', 'a+', 'x', 'x+', 'c', 'c+']
    ];
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
        if (is_resource($this->stream)) {
            return $this->getContents();
        } else {
            return '';
        }
    }

    public function close()
    {
        fclose($this->stream);
        $this->detach();
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
        if (is_resource($this->stream)) {
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
        if ($this->isSeekable()) {
            fseek($this->stream, $offset, $whence);
        }
    }

    public function rewind()
    {
        if ($this->isSeekable()) {
            rewind($this->stream);
        }
    }

    public function isWritable()
    {
        if (is_null($this->writable)) {
            $this->writable = false;
            if (is_resource($this->stream)) {
                $thisMode = $this->getMetadata('mode');
                foreach (self::$modes['writable'] as $mode) {
                    if (strpos($thisMode, $mode) === 0) {
                        $this->writable = true;
                        break;
                    }
                }
            }
        }
        return $this->writable;
    }

    public function write($string)
    {
        if ($this->isWritable()) {
            $this->size = null;
            return fwrite($this->stream, $string);
        }
    }

    public function isReadable()
    {
        if (is_null($this->readable)) {
            $this->readable = false;
            if (is_resource($this->stream)) {
                $thisMode = $this->getMetadata('mode');
                foreach (self::$modes['readable'] as $mode) {
                    if (strpos($thisMode, $mode) === 0) {
                        $this->readable = true;
                        break;
                    }
                }
            }
        }
        return $this->readable;
    }

    public function read($length)
    {
        if ($this->isReadable()) {
            return fread($this->stream, $length);
        }
    }

    public function getContents()
    {
        if ($this->isReadable()) {
            return stream_get_contents($this->stream);
        }
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