<?php

namespace NHL\Schedule;

use NHL\Schedule\ScheduleImporter as ScheduleImporterInterface;
use Illuminate\Cache\Repository as CacheRepository;
use Illuminate\Config\Repository as ConfigRepository;

class ScheduleCache implements ScheduleImporterInterface {

    /**
     * @var ScheduleImporter
     */
    private $scheduleImporter;

    /**
     * @var Repository
     */
    private $cache;

    /**
     * @var Repository
     */
    private $config;

    /**
     * @param ScheduleImporter $scheduleImporter
     */
    public function __construct(ScheduleImporter $scheduleImporter, CacheRepository $cache, ConfigRepository $config)
    {
        $this->scheduleImporter = $scheduleImporter;
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
     * Run the import if the results aren't already in cache.
     * @param  string $team
     * @return 
     */
    public function run($teamId)
    {
        $key = $this->createCacheKey("nhl.schedule.{$teamId}");

        if ( ! $this->cache->has($key))
        {
            $body = $this->scheduleImporter->run($teamId);

            $this->cache->put($key, $body, $this->config->get('nhl.scheduleCacheLength'));

            return $body;
        }

        return $this->cache->get($key);
    }

}