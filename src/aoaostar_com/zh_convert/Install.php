<?php

namespace plugin\aoaostar_com\zh_convert;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = '中文简繁体转化';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '对文字进行中文简繁体转化';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
