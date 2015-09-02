<?php
/**
 * Created by PhpStorm.
 * User: janhuang
 * Date: 15/9/2
 * Time: 下午4:11
 * Github: https://www.github.com/janhuang
 * Coding: https://www.coding.net/janhuang
 * SegmentFault: http://segmentfault.com/u/janhuang
 * Blog: http://segmentfault.com/blog/janhuang
 * Gmail: bboyjanhuang@gmail.com
 * WebSite: http://www.janhuang.me
 */

namespace FastD\Http\Session\Storage;

interface SessionStorageInterface
{
    public function setTtl($ttl);

    public function getTtl();

    public function get($name);

    public function set($name, $value);

    public function exists($name);

    public function remove($name);
}