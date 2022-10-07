<?php

namespace plugin\aoaostar_com\github_image_hosting;

use plugin\Drive;

class App implements Drive
{

    public function __construct()
    {

    }

    public function Index()
    {
        return success(plugin_info_get());
    }
}