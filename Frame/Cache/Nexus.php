<?php
/**
 * Created by PhpStorm.
 * User: ifehrim@gmail.com
 * Date: 8/30/2018
 * Time: 14:17
 */

namespace Frame\Cache;


/**
 * @auther ifehrim@gmail.com
 * Class Nexus
 * @package Frame\Cache
 *
 * @method  static Session session()
 * @method  static Memcache memcache()
 * @method static File file($path=null)
 * @method  static Redis redis()
 *
 */
class Nexus extends Cache
{
    /**
     * @auther ifehrim@gmail.com
     * @var Cache
     */
    protected static $cache;

    public static function on($type = null)
    {
        if (empty($type)) {
            static::$cache = self::file();
        } else {
            static::$cache = self::$type();
        }
    }

    public function __call($name, $arguments)
    {
        $class=__NAMESPACE__.'\\'.ucfirst($name);
        return $class::instance($arguments);
    }

    public static function __callStatic($name, $arguments)
    {
        $class=__NAMESPACE__.'\\'.ucfirst($name);
        return $class::instance($arguments);
    }


    public static function get($k = null)
    {

        return static::$cache->get($k);
    }

    public static function age($k = null)
    {
        return static::$cache->age($k);
    }

    public static function set($k = null, $v = null, $e = null)
    {
        return static::$cache->set($k, $v, $e);
    }

    public static function has($k)
    {
        return static::$cache->has($k);
    }

    public static function del($k = null)
    {
        return static::$cache->del($k);
    }
}