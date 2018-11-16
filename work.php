<?php
/**
 * Created by IntelliJ IDEA.
 * User: pc
 * Date: 11/16/2018
 * Time: 13:58
 */


use Frame\Cache\Cookie;
use Frame\Cache\File;
use Frame\Cache\Nexus;
use Frame\Cache\Session;

include 'Frame/Traits/_Class.php';
include 'Frame/Cache/Cache.php';
include 'Frame/Cache/Nexus.php';
include 'Frame/Cache/Cookie.php';
include 'Frame/Cache/File.php';
include 'Frame/Cache/Memcache.php';
include 'Frame/Cache/Redis.php';


File::$PATH = __DIR__ . '/log/';

Nexus::on('file'); //file redis memcache cookie session
Nexus::set('key','val');
if(Nexus::has('key')){
    print "key:".Nexus::get('key');
}

File::set('key-f','val-f');
if(File::has('key-f')){
    print "key-f:".File::get('key-f');
}
//
//Session::set('key','val');
//if(Session::has('key')){
//    print "key:".Session::get('key');
//}







