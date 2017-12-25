<?php
/**
 * 远程模拟http请求
 * Created leon
 * Date: 2017/2/6
 * Time: 11:09
 */

namespace Library\Util;

class CurlUtil
{
    /**
     * 同步get请求
     * @param $url
     * @param null $params
     * @return mixed
     */
    public static function sendGet($url, $params = null) {
        if (!empty($params)) {
            $params = http_build_query($params);
            $url .= "?" . $params;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /**
     * 同步post请求
     * @param $url
     * @param null $params
     * @return mixed
     */
    public static function sendPost($url, $params = null) {
        $params = http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_POST, 1);
        if (!empty($params)) {
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    /**
     * 异步post请求
     * @param $url
     * @param null $params
     */
    public function sendSnyPost($url, $params = null){
        $str = "";
        if (!empty($params)) {
            $str = json_encode($params);
        }
        $parse = parse_url($url);
        isset($parse['host']) ||$parse['host'] = '';
        isset($parse['path']) || $parse['path'] = '';
        isset($parse['query']) || $parse['query'] = '';
        isset($parse['port']) || $parse['port'] = '';
        $path = $parse['path'] ? $parse['path'].($parse['query'] ? '?'.$parse['query'] : '') : '/';
        $host = $parse['host'];
        //协议
        if ($parse['scheme'] == 'https') {
            $version = '1.1';
            $port = empty($parse['port']) ? 443 : $parse['port'];
            $host = 'ssl://'.$host;
        } else {
            $version = '1.0';
            $port = empty($parse['port']) ? 80 : $parse['port'];
        }
        //Headers
        $headers[] = "Host: {$parse['host']}";
        $headers[] = 'Connection: Close';
        $headers[] = "User-Agent: Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/54.0.2840.99 Safari/537.36";
        $headers[] = 'Accept: */*';

        $headers[] = "Content-type: application/json";
        $headers[] = 'Content-Length: ' . strlen($str);
        $out = "POST $path HTTP/$version\r\n" . implode("\r\n", $headers)."\r\n\r\n" . $str;
        unset($headers);
        //发送请求
        $fp = fsockopen($host, $port, $errno, $errstr, 30);
        stream_set_blocking($fp, 0);
        fwrite($fp, $out);
        fclose($fp);
    }
}