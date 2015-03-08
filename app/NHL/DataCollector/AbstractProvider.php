<?php

namespace NHL\DataCollector;

use NHL\DataCollector\Contracts\Consumer;
use NHL\DataCollector\Contracts\Parser;

abstract class AbstractProvider {

	/**
	 * Array of consumers.
	 *
	 * @var array
	 */
	protected $consumers = [];

	/**
	 * The url to the data you want to download.
	 *
	 * @return mixed
	 */
	abstract protected function getDownloadUrl();

	/**
	 * An instance of the parser used to parse the data.
	 * Must be an instance of \NHL\DataCollector\Contracts\Parser.
	 *
	 * @return \NHL\DataCollector\Contracts\Parser
	 */
	abstract protected function getParser();

	/**
	 * Get the data.
	 *
	 * @return \GuzzleHttp\Message\ResponseInterface
	 */
	protected function downloadData()
	{
		return $this->getHttpClient()->get($this->getDownloadUrl())->getBody();
	}

	/**
	 * An instance of an http client.
	 *
	 * @return \GuzzleHttp\Client
	 */
	protected function getHttpClient()
	{
		return new \GuzzleHttp\Client;
	}

	/**
	 * Add to the array of consumers. Consumers are run after the data
	 * is parsed.
	 *
	 * @param Consumer $consumer
	 *
	 * @return $this
	 */
	public function addConsumer(Consumer $consumer)
	{
		$this->consumers[] = $consumer;

		return $this;
	}

	/**
	 * Get's the array of consumers.
	 *
	 * @return array
	 */
	public function getConsumers()
	{
		return $this->consumers;
	}

	/**
	 * @return mixed
	 * @throws \Exception
	 */
	public function execute()
	{
		$data = $this->downloadData();
		$parser = $this->getParser();

		if ( ! $parser instanceof Parser)
		{
			throw new \Exception('Parser must be an instance of ' . Parser::class . ', ' . get_class($parser) . ' given.');
		}

		$data = $this->getParser()->parse($data);

		foreach ($this->consumers as $consumer)
		{
			$consumer->execute($data);
		}

		return $data;
	}

}