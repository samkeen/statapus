<?php
namespace Statapus;
/**
 * Created by JetBrains PhpStorm.
 * User: sam
 * Date: 9/12/12
 * Time: 10:17 AM
 * To change this template use File | Settings | File Templates.
 */
class Http
{
    static protected $base_path;

    static function set_base_path($base_path)
    {
        self::$base_path = rtrim($base_path, ' /');
    }
    static function redirect($path, $exit=true)
    {
        $path = ltrim($path, ' /');
        header("Location: " . self::$base_path . "/{$path}");
        $exit ? exit() : null;
    }
}
