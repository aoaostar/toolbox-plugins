<?php

namespace plugin\aoaostar_com\image_url;

use plugin\Drive;
use think\facade\Request;
use think\facade\Validate;

class App implements Drive
{

    public function __construct()
    {

    }

    public function Index()
    {
        return msg("ok", "success", plugin_info_get());
    }

    public function upload()
    {
        $validate = Validate::rule([
            'node' => 'require|alphaDash',
            'file' => 'require|file|fileExt:jpg,jpeg,png,gif,bmp.webp,ico',
        ]);

        $node = Request::param('node');
        $uploadedFile = Request::file('file');

        if (!$validate->check([
            'node' => $node,
            'file' => $uploadedFile,
        ])) {
            return msg('error', $validate->getError());
        }

        $filename = uniqid() . '.' . $uploadedFile->extension();
        $tmpDir = app()->getRuntimePath() . '/tmp';
        if (!is_dir($tmpDir)) {
            mkdir($tmpDir, 0777, true);
        }
        $uploadedFile->move($tmpDir, $filename);

        $path = plugin_path_get(plugin_current_class_get(__NAMESPACE__));

        require "$path/Plugin.php";
        require "$path/common.php";
        require "$path/ApiException.php";
        if (!file_exists("$path/nodes/$node/main.php")) {
            return msg('error', "该节点[$node]不存在");
        }
        require "$path/nodes/$node/main.php";

        if (!class_exists($node)) {
            return msg('error', "该节点[$node]不存在");
        }
        $instance = new $node();
        try {
            $res = $instance->main($tmpDir . DIRECTORY_SEPARATOR . $filename);
        } catch (\Exception $e) {

            return msg('error', $e->getMessage());
        }


        return msg('ok', "success", [
            'url' => $res,
        ]);
    }
}