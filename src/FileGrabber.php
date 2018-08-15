<?php

namespace Suitcore\FileGrabber;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Collection;
use Suitcore\File\File;

class FileGrabber
{
    protected static $temp;

    protected static $chmod = 0775;

    protected static $prefix = 'grabbed';

    public function setTemp($temp, $chmod = null)
    {
        if (! file_exists($temp)) {
            mkdir($temp, $chmod ?: static::$chmod, true);
        }

        static::$temp = $temp;
    }

    /**
     * [setPrefix description]
     * @param [type] $prefix [description]
     */
    public function setPrefix($prefix)
    {
        static::$prefix = $prefix;
    }

    /**
     * [setChmod description]
     * @param [type] $chmod [description]
     */
    public function setChmod($chmod)
    {
        static::$chmod = $chmod;
    }

    /**
     * [from description]
     * @param  [type]  $url      [description]
     * @param  boolean $isStream [description]
     * @return false | File      [description]
     */
    public function from($url, $isStream = false)
    {
        $fileResult = false;
        $resource = null;
        try {
            $tmpfile = tempnam(static::$temp, static::$prefix);
            $resource = fopen($tmpfile, 'w');
            $stream = Psr7\stream_for($resource);

            try {
                $client = new Client;
                $res = $client->request('GET', $url, ['sink' => $stream]);
                $fileResult = new File($tmpfile);
            } catch (RequestException $e) { }
        } catch (Exception $e) { }
        if ($resource) {
            // try to close handler
            try {
                fclose($resource);
            } catch (Exception $e) { }
        }
        return $fileResult;
    }
}
