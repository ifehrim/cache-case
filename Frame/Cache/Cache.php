<?php
/**
 * Created by PhpStorm.
 * User: ifehrim@gmail.com
 * Date: 9/6/2018
 * Time: 16:00
 */

namespace Frame\Cache;


abstract class Cache
{
    abstract public static function get($k = null);

    abstract public static function age($k = null);

    abstract public static function set($k = null, $v = null, $e = null);

    abstract public static function has($k);

    abstract public static function del($k = null);
}