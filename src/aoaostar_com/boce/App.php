<?php

namespace plugin\aoaostar_com\boce;

use plugin\Drive;

class App implements Drive
{
    public function Index()
    {
        return success();
    }
}