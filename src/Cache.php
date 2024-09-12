<?php

class Cache
{
    private $cacheDir;

    public function __construct($cacheDir = 'cache/')
    {
        $this->cacheDir = $cacheDir;
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0755, true);
        }
    }

    public function get($key)
    {
        $filePath = $this->cacheDir . $key . '.cache';
        return file_exists($filePath) ? file_get_contents($filePath) : false;
    }

    public function set($key, $value)
    {
        $filePath = $this->cacheDir . $key . '.cache';
        file_put_contents($filePath, $value);
    }
}