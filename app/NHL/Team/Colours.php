<?php

namespace NHL\Team;

use Illuminate\Support\Collection;

class Colours extends Collection {

    public function __construct(array $colours)
    {
        parent::__construct($colours);
    }

    public function height($key, $rowHeight = 50)
    {
        return (count($this) * $rowHeight) - ($key * $rowHeight);
    }

}