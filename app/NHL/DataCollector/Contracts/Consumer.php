<?php

namespace NHL\DataCollector\Contracts;

use Illuminate\Support\Collection;

interface Consumer {

	/**
	 * @param $data
	 *
	 * @return mixed
	 */
	public function execute(Collection $data);

}