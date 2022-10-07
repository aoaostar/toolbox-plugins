<?php

namespace plugin\aoaostar_com\youth_learning;

use plugin\Drive;

class App implements Drive
{


    public function Index()
    {
        return success(plugin_info_get());
    }

    public function S()
    {
        $title = request()->param('title', '“青年大学习”第十三季第一期');
        $url = request()->param('url', 'https://h5.cyol.com/special/daxuexi/bd1kh2uw0m/m.html');
        $html = <<<ETO
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>$title</title>
    <style>*{margin:0;padding:0}img{width:100%;height:100%}</style>
</head>
<body>
<img src="$url" alt="">
</body>
</html>
ETO;

        return $html;
    }
}