<?php

namespace Orbtalk;


class NetsapObjSubscriber extends NetsapObj {

    public function count (array $params)
    {
        echo "subscriber count!\n";
    }

    public function read (array $params)
    {
        echo "subscriber read!\n";
    }
}