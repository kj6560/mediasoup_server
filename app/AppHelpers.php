<?php

namespace App;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use GuzzleHttp\Client;

class AppHelpers
{
    public static function redirect($url, $statusCode = 303)
    {
        header('Location: ' . $url, true, $statusCode);
    }
    public static function setSessionData($key, $value)
    {
        $_SESSION[$_SESSION['login_id']][$key] = $value;
        return isset($_SESSION[$_SESSION['login_id']][$key]) ? true : false;
    }
    public static function getSessionData($key)
    {
        return $_SESSION[$_SESSION['login_id']][$key];
    }
    public static function removeSessionData($key)
    {
        unset($_SESSION[$_SESSION['login_id']][$key]);
        return !isset($_SESSION[$_SESSION['login_id']][$key]) ? true : false;
    }
    public static function getCache()
    {
        return new FilesystemAdapter();
    }
    public static function getCacheItem($cache, $item)
    {
        $cacheItem = $cache->getItem($item);
        if ($cacheItem->isHit()) {
            return $cacheItem;
        }
        return false;
    }
    public static function setCacheItem($cache, $key, $item)
    {
        $cacheItem = $cache->getItem($key);
        $cacheItem->set(4711);
        $cache->save($item);
        return $cacheItem->get();
    }
    public static function makeRequest($url, $body, $method)
    {
        $client = new \GuzzleHttp\Client();
        if ($method == "post"){
            $response = $client->post(
                $url,
                array(
                    'form_params' => $body
                )
            );
        }else if($method=="get"){
            $response = $client->get(
                $url,
                array(
                    'form_params' => $body
                )
            );
        }
            
        return $response;
    }
    public static function processData($data){
        $processedData = array();
        if(!empty($data)){
            $headers = !empty($data[0])?$data[0]:array();
            for($i=1;$i<count($data)-1;$i++){
                $da = $data[$i];
                $res = array();
                for($j=0;$j<count($headers);$j++){
                    $res[$headers[$j]] = $da[$j];
                }
                array_push($processedData,$res);
            }
        }
        return $processedData;
    }
}
