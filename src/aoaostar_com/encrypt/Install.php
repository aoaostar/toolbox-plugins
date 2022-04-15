<?php

namespace plugin\aoaostar_com\encrypt;


use app\model\Plugin;

class Install implements \plugin\Install
{

    public function Install(Plugin $model)
    {
        $model->title = '对称加密解密';
        $model->class = plugin_current_class_get(__NAMESPACE__);
        $model->alias = base_space_name(__NAMESPACE__);
        $model->desc = '对称加密算法转换工具，包含有AES、DES、RC4、Rabbit、TripleDes、RC4Drop、RabbitLegacy等相关对称加密算法互相转换的工具';
        $model->version = 'v1.0';
    }

    public function UnInstall(Plugin $model)
    {

    }
}
