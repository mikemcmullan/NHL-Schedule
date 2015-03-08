<?php

namespace NHL\DataCollector\Contracts;

interface Parser {

	/**
	 * @param $data
	 *
	 * @return mixed
	 */
	public function parse($data);

}