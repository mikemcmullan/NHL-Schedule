<?php

namespace NHL\Schedule;

use Illuminate\Cache\Repository as CacheRepository;
use Illuminate\Config\Repository as ConfigRepository;
use GuzzleHttp\Client;

class ScheduleDownloader {

    /**
     * @var ScheduleImporter
     */
    private $scheduleImporter;

    /**
     * @var ConfigRepository
     */
    private $client;

    /**
     * @var CacheRepository
     */
    private $cache;

    /**
     *  @var Client     $client
     *  @var Repository $cache
     */
    public function __construct(Client $client, CacheRepository $cache, ConfigRepository $config)
    {
        $this->client = $client;
        $this->cache = $cache;
        $this->config = $config;
    }

    /**
     * Creates a cache key based on the provided string.
     * 
     * @param  string $string
     * @return string
     */
    private function createCacheKey($string)
    {
        return sha1($string);
    }

    /**
     * Download the provided url if not in cache already.
     * 
     * @param  string $url
     * @return string
     */
    public function get($url)
    {
        $key = $this->createCacheKey($url);

        if ( ! $this->cache->has($key))
        {
            $request  = $this->client->createRequest('GET', $url);
            $response = $this->client->send($request);
            $body     = (string) $response->getBody();

            $this->cache->put($key, $body, $this->config->get('nhl.scheduleCacheLength'));

            return $body;
        }
        

        return $this->cache->get($key);
    }

}