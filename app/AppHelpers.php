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
        $cacheItem = $cache->getItem('stats.products_count');
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
}
