<?php

namespace NHL\Schedule;

use Illuminate\Cache\Repository as CacheRepository;
use Illuminate\Config\Repository as ConfigRepository;
use GuzzleHttp\Client;

class ScheduleDownloader {

    /**
     * @var ConfigRepository
     */
    private $client;

    /**
     * @var CacheRepository
     */
    private $cache;

    /**
     * @var Client $client
     * @param CacheRepository|Repository $cache
     * @param ConfigRepository $config
     */
    public function __construct(Client $client, CacheRepository $cache, ConfigRepository $config)
    {
        $this->client = $client;
        $this->cache = $cache;
        $this->config = $config;
    }

    /**
     * Download the provided url if not in cache already.
     * 
     * @param  string $url
     * @return string
     */
    public function get($url)
    {
        $cacheLength = $this->config->get('nhl.scheduleCacheLength', 0);

        if ( ! $this->cache->has($url) || $cacheLength === false)
        {
            $request  = $this->client->createRequest('GET', $url);
            $response = $this->client->send($request);
            $body     = (string) $response->getBody();

            $cacheLength && $this->cache->put($url, $body, $cacheLength);

            return $body;
        }

        return $this->cache->get($url);
    }
}