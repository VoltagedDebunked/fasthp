<?php

require_once 'Cache.php';

use parallel\Runtime;
use parallel\Future;
use parallel\Sync;

class ParallelHtmlRenderer
{
    private $cache;

    public function __construct()
    {
        $this->cache = new Cache();
    }

    public function render($templatePath, $data = [])
    {
        $cacheKey = md5($templatePath . serialize($data));
        $cachedOutput = $this->cache->get($cacheKey);

        if ($cachedOutput !== false) {
            echo $cachedOutput;
            return;
        }

        $runtime = new Runtime();
        $future = $runtime->run(function () use ($templatePath, $data) {
            ob_start();
            extract($data);
            include $templatePath;
            return ob_get_clean();
        });

        $output = $future->value();
        $this->cache->set($cacheKey, $output);
        echo $output;
    }
}