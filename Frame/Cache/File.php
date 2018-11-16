<?php

namespace Frame\Cache;

/**
 * Created by PhpStorm.
 * User: fehrim
 * Date: 11/22/16
 * Time: 10:48 AM
 */
use Frame\Traits\_Class;


class File extends Cache
{

    public static $PATH = __DIR__ . '/cache_pre_';

    use _Class;


    public static function age($k = null)
    {
        $k = str_replace(':', '_', $k);

        $f = self::$PATH . $k . '.cache';
        $ses = file_exists($f) ? unserialize(file_get_contents($f)) : [];
        if (empty($ses)) return 0;
        if (empty($ses['e'])) return 9999999999999999999999;
        if (time() - intval($ses['t']) <= intval($ses['e'])) {
            return intval($ses['e']) - (time() - intval($ses['t']));
        } else {
            @unlink($f);
        }
        return 0;
    }

    public static function get($k = null)
    {
        $k = str_replace(':', '_', $k);
        $f = self::$PATH . $k . '.cache';
        $ses = file_exists($f) ? unserialize(file_get_contents($f)) : [];
        if (empty($ses)) return null;
        if (empty($ses['e']) || time() - intval($ses['t']) <= intval($ses['e'])) {
            return unserialize($ses['v']);
        } else {
            @unlink($f);
        }
        return null;
    }

    public static function set($k = null, $v = null, $e = null)
    {
        $k = str_replace(':', '_', $k);
        $v = ['e' => $e, 't' => time(), 'v' => serialize($v)];

        $f = self::$PATH . $k . '.cache';
        if (!is_dir(dirname($f))) exec('mkdir -p '.dirname($f));

        return file_put_contents($f, serialize($v));
    }

    public static function has($k)
    {
        $k = str_replace(':', '_', $k);
        return file_exists(self::$PATH . $k . '.cache');
    }

    public static function del($k = null)
    {
        $k = str_replace(':', '_', $k);
        if (!empty($k)) @unlink(self::$PATH . $k . '.cache');
        if ($k == -1) {
            exec('mkdir -p '.self::$PATH);
        }
    }


}