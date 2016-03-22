<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/3/20
 * Time: 15:29
 */
namespace Tool;
class Http{
    public  static  function getHost(){
        return $_SERVER['HTTP_HOST'];
    }
}