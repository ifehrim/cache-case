<?php

namespace Frame\Cache;

/**
 * Created by PhpStorm.
 * User: fehrim
 * Date: 11/22/16
 * Time: 10:48 AM
 */
use Frame\Traits\_Class;

if (isset($_COOKIE[session_name()]) && $_COOKIE[session_name()]) {
    session_id($_COOKIE[session_name()]);
}
@session_start();

class Session extends Cache
{

    use _Class;

    public static function age($k = null)
    {
        $ses = isset($_SESSION[$k]) ? unserialize($_SESSION[$k]) : [];
        if (empty($ses)) return 0;
        if (empty($ses['e'])) return 9999999999999999999999;
        if (time() - intval($ses['t']) <= intval($ses['e'])) {
            return intval($ses['e']) - (time() - intval($ses['t']));
        } else {
            unset($_SESSION[$k]);
        }
        return 0;
    }

    public static function get($k = null)
    {
        $ses = isset($_SESSION[$k]) ? unserialize($_SESSION[$k]) : [];
        if (empty($ses)) return null;
        if (empty($ses['e']) || time() - intval($ses['t']) <= intval($ses['e'])) {
            return unserialize($ses['v']);
        } else {
            unset($_SESSION[$k]);
        }
        return null;
    }

    public static function set($k = null, $v = null, $e = null)
    {
        $_SESSION[$k] = serialize(['e' => $e, 't' => time(), 'v' => serialize($v)]);
        return true;
    }

    public static function has($k)
    {
        return isset($_SESSION[$k]);
    }

    public static function del($k = null)
    {
        if (!empty($k)) unset($_SESSION[$k]);
        if ($k == -1) {
            session_destroy();
        }
    }


}