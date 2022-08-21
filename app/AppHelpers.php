<?php

namespace App;

use DateTimeZone;
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
        if ($method == "post") {
            $response = $client->post(
                $url,
                array(
                    'form_params' => $body
                )
            );
        } else if ($method == "get") {
            $response = $client->get(
                $url,
                array(
                    'form_params' => $body
                )
            );
        }

        return $response;
    }
    public static function clean_data($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        return $data;
    }
    public static function processData($data)
    {
        $processedData = array();
        if (!empty($data)) {
            $headers = !empty($data[0]) ? $data[0] : array();
            for ($i = 1; $i < count($data); $i++) {
                $da = $data[$i];
                $res = array();
                for ($j = 0; $j < count($headers); $j++) {
                    $res[$headers[$j]] = $da[$j];
                }
                array_push($processedData, $res);
            }
        }
        return $processedData;
    }
    public static function isValidConference($conference_date, $conference_duration)
    {
        $conf_date = new \DateTime($conference_date);
        $conf_duration = $conference_duration;
        $conf_duration_ar = explode(":", $conf_duration);
        $date_current = new \DateTime("now",new DateTimeZone("Asia/Kolkata"));
        print_r($date_current);
        $conf_dur_hour = $conf_duration_ar[0];
        $conf_dur_min = $conf_duration_ar[1];
        $conf_dur_sec = $conf_duration_ar[2];
        $interval = $date_current->diff($conf_date);
        $total_conf_duration = $conf_dur_hour * 60 * 60 + $conf_dur_min * 60 + $conf_dur_sec;
        $left_duration = $interval->h * 60 * 60 + $interval->i * 60 + $interval->s;
        if ($total_conf_duration > $left_duration) {
            return true;
        }
        return false;
    }
}
