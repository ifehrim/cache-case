<?php
/**
 * Created by PhpStorm.
 * User: ifehrim@gmail.com
 * Date: 9/6/2018
 * Time: 17:39
 */

namespace Frame\Cache;


use A;
use Frame\Traits\_Class;

class Redis extends Cache
{
    use _Class;

    /**
     * @return \Redis
     */
    private static function re(){
        return null;
    }
    

    public static function get($k = null)
    {
        $v = self::re()->get($k);
        if ($v === false) return null;
        return unserialize($v);
    }

    public static function age($k = null)
    {
        $v = self::re()->ttl($k);
        if ($v === false) return 0;
        return $v;
    }

    public static function set($k = null, $v = null, $e = null)
    {
        if (empty($e)) $e = 0;
        return self::re()->set($k, serialize($v), $e);
    }

    public static function has($k)
    {
        return self::re()->exists($k);
    }

    public static function del($k = null)
    {
        if (!empty($k)) return self::re()->del($k);
        if ($k == -1) {
            self::re()->flushDB();
        }

    }
}