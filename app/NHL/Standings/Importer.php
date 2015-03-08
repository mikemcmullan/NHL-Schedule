<?php

namespace NHL\Standings;

interface Importer {

    /**
     * @return array
     */
    public function all($type);

}