<?php

namespace plugin\aoaostar_com\dplayer;

use plugin\Drive;

class App implements Drive
{
    public function Index()
    {
        return success();
    }
}