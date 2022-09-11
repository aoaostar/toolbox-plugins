<?php

namespace plugin\aoaostar_com\piano;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = '在线钢琴';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '在线钢琴演奏，让只会敲代码你瞬间变成钢琴小王子';
        $model->version = 'v1.1';
    }

    public function UnInstall(Plugin $model)
    {

    }
}