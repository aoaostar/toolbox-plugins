<?php

namespace plugin\aoaostar_com\svg_editor;


use app\model\Plugin;

class Install implements \plugin\Install
{
    # 安装时运行方法
    public function Install(Plugin $model)
    {
        # 标题
        $model->title = "SVG 在线编辑器";
        # 类名、无需修改
        $model->class = plugin_current_class_get(__NAMESPACE__);
        # 路由、即 example
        $model->alias = base_space_name(__NAMESPACE__);
        # 描述
        $model->desc = 'SVG 在线编辑器是一款非常方便的 SVG 在线编辑器,通过浏览器访问即可实现打开本地 SVG 文件在线编辑,也可以导入图片,对于制作好的 SVG 我们可以保存到本地来使用。';
        # 版本号
        $model->version = 'v1.0';
    }

    # 卸载时运行方法
    public function UnInstall(Plugin $model)
    {

    }
}