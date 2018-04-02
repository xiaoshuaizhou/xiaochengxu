<?php
/**
 * 自定义help函数，使用时需要 命令行执行  composer  dump-autoload  才可以加载自定义函数
 */
if (! function_exists('curl_get')){
    /*
   * curl 爬虫
   * @param $url
   * @param int $type 0 是get  1 是post
   * @param array $data
   */
    function curl_get($url , $type = 0 , $data = [])
    {
        //初始化curl
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        if ($type == 1){
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }

        //执行并获取内容
        $output = curl_exec($ch);

        //释放句柄
        curl_close($ch);
        return $output;
    }
}

if (! function_exists('curl_post_raw')){
    /**
     * curl post 请求   接受原始的字符创
     * @param $url
     * @param $rawData
     * @return mixed
     */
    function curl_post_raw($url, $rawData)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
        curl_setopt($ch, CURLOPT_PORT, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $rawData);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type:text']);
        $data = curl_exec($ch);
        return ($data);
    }
}
if (! function_exists('getRanChars')){
    /**
     * 生成随机字符串
     * @param $lenght
     * @return null|string
     */
    function getRanChars($lenght)
    {
        $str = null;
        $strPro = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz";
        $max = strlen($strPro) - 1;

        for ($i=0; $i< $lenght; $i++ ){
            $str .= $strPro[rand(0,$max)];
        }
        return $str;
    }
}





