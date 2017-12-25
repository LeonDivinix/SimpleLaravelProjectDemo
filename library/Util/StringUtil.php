<?php
/**
 * Created by leon
 * Date: 2016-11-27 17:10
 */

namespace Library\Util;


class StringUtil
{
    /**
     * 随机字符串生成
     * @param int $len 生成的字符串长度
     * @param array $chars 用于构建字符串的字符数组
     * @return string
     */
    public static function randomString($len = 6, $chars = array(
        "A", "B", "C", "D", "E", "F", "G",
        "H", "J", "K", "L", "M", "N", "P", "Q", "R",
        "S", "T", "U", "V", "W", "X", "Y", "Z", "2",
        "3", "4", "5", "6", "7", "8", "9"
    )) {
        $result = "";
        $charsLen = count($chars) - 1;
        shuffle($chars);    // 将数组打乱
        $start = 0;
        $filter = array("3P", "SB"); //todo require("number_char_filter_word.php");
        while ($start < $len) {
            for ($i = $start; $i < $len; ++$i) {
                $result .= $chars[mt_rand(0, $charsLen)];
            }
            foreach ($filter as $v) {
                $result = str_replace($v, "", $result);
            }
            $start = strlen($result);
        }

        return $result;
    }
    function aaa()
    {
        $zz = <<<'EOT'
    /**
     * 构建白名单
     * @return array
     */
    function buildSupportTag() {
        return  array(
            "img" => 1,
            "div" => 1,
            "p" => 1,
            "span" => 1,
            "br" => 1,
            "i" => 1,
            "b" => 1,
            "sub" => 1,
            "sup" => 1,
            "ul" => 1,
            "ol" => 1,
            "li" => 1,
            "h1" => 1,
            "h2" => 1,
            "h3" => 1,
            "h4" => 1,
            "h5" => 1,
            "h6" => 1
        );
    }

    /**
     * 是否有效tag
     * @param $content
     * @return bool
     */
    function isValidTag($content) {
        $result = true;
        $whiteTag = buildSupportTag();
        // 获取所有标签
        preg_match_all('/<[a-z1-9]+[ >]/', $content, $haveTags);
        if (!empty($haveTags[0])) {
            foreach ($haveTags[0] as $tag) {
                $tag = trim($tag, '<> ');
                if (!isset($whiteTag[$tag])) {
                    $result = false;
                    break;
                }
            }
        }
        return $result;
    }

    /**
     * 过滤标签
     * @param $content
     * @param $imagePath
     * @param $imageUrl
     * @return array
     */
    function filterTag($content, $imagePath, $imageUrl) {
        $whiteTag = buildSupportTag();
        $content = deleteScriptTag($content);
        // 获取所有标签
        preg_match_all('/<[a-z1-9]+[ >]/', $content, $haveTags);
        $tags = array();
        $errors = array();
        if (!empty($haveTags[0])) {
            foreach ($haveTags[0] as $tag) {
                $tag = trim($tag, '<> ');
                $tags[$tag] = $tag;
            }
            unset($haveTags);
            $tags = array_values($tags);
            foreach ($tags as $tag) {
                // 白名单内，替换 img特别处理
                if (isset($whiteTag[$tag])) {
                    if (strcasecmp($tag, "img") === 0) {
                        $content = dealImage($content, $imagePath, $imageUrl, $errors);
                    } else {
                        $content = preg_replace('/<' . $tag . '[^>]*>/i', "<{$tag}>", $content);
                    }
                } // 不在白名单，删除
                else {
                    $content = preg_replace('/<' . $tag . '[^>]*>/i', "", $content);
                    $content = str_replace('</' . $tag . '>', "", $content);
                }
            }
        }
        return array($content, $errors);
    }

    /**
     * 处理图片
     * @param $content
     * @param $imagePath
     * @param $imageUrl
     * @param $errors
     * @return mixed
     */
    function dealImage($content, $imagePath, $imageUrl, &$errors) {
        $images = array();
        $imagePath = rtrim($imagePath, "/") . "/";
        $imageUrl = rtrim($imageUrl, "/") . "/";
        preg_match_all('/<img [^>]*>/i', $content, $images);
        foreach ($images[0] as $imageStr) {
            preg_match("/src=['\"][^('\")]*/", $imageStr, $image);
            if (!empty($image[0])) {
                if (stripos($image[0], STATICS_DOMAIN) === false) { // 本服务器图片不替换
                    $image = substr($image[0], 5);
                    $buffer = @file_get_contents($image);
                    if (empty($buffer)) {
                        $errors[] = $image;
                        $content = str_replace($image, "", $content);
                    } else {
                        $fileName = uniqid("upload_") . ".jpg";
                        file_put_contents($imagePath . $fileName, $buffer);
                        unset($buffer);
                        $content = str_replace($imageStr, "<img src=\"{$imageUrl}{$fileName}\" />", $content);
//                    $content = str_replace($image, $imageUrl . $fileName, $content);
                    }
                }
            }
        }
        return $content;
    }

    /**
     * 去掉script代码
     * @param $content
     * @return mixed
     */
    function deleteScriptTag($content) {
        return preg_replace("/<script[^>]*?>.*?<\\/script>/si", "", $content);
    }
EOT;
    }
}