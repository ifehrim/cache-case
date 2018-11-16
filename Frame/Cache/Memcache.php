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

class Memcache extends Cache
{
    use _Class;

    /**
     * @return \Memcache
     */
    private static function me(){
        return null;
    }
    

    public static function get($k = null)
    {
        $vl = self::me()->get($k);
        $ses = !empty($vl) ? unserialize($vl) : [];
        if (empty($ses)) return null;
        if (empty($ses['e']) || time() - intval($ses['t']) <= intval($ses['e'])) {
            return unserialize($ses['v']);
        } else {
            self::me()->delete($k);
        }
        return null;
    }

    public static function age($k = null)
    {
        $vl = self::me()->get($k);
        $ses = !empty($vl) ? unserialize($vl) : [];
        if (empty($ses)) return 0;
        if (empty($ses['e'])) return 9999999999999999999999;
        if (time() - intval($ses['t']) <= intval($ses['e'])) {
            return intval($ses['e']) - (time() - intval($ses['t']));
        } else {
            self::me()->delete($k);
        }
        return 0;

    }

    public static function set($k = null, $v = null, $e = null)
    {
        if (empty($e)) $e = 0;
        $v = ['e' => $e, 't' => time(), 'v' => serialize($v)];
        return self::me()->set($k, serialize($v), MEMCACHE_COMPRESSED, $e);
    }

    public static function has($k)
    {
        return !empty(self::me()->get($k));
    }

    public static function del($k = null)
    {
        if (!empty($k)) return self::me()->delete($k);
        if ($k == -1) {
            self::me()->flush();
        }
    }
}