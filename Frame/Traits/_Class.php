<?php
/**
 * Created by PhpStorm.
 * User: ifehrim@gmail.com
 * Date: 9/6/2018
 * Time: 16:22
 */

namespace Frame\Traits;


trait _Class
{

    public static function instance($arr = [])
    {
        static $_frame_classes;
        if (isset($_frame_classes[__CLASS__])) {
            return $_frame_classes[__CLASS__];
        } else {
            $instance = new static($arr);
            $_frame_classes[__CLASS__] = $instance;
            return $instance;
        }
    }

}