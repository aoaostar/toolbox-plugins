<?php

namespace plugin\aoaostar_com\speech_synthesis;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = '语音合成';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '在线语音合成、文本转语音';
        $model->version = 'v1.1';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
