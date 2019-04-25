<?php

namespace common\components;
use common\service\applog\ApplogService;
use Yii;

class HttpClient
{

    private static $headers = [];


    public static function get($url, $param =[] ) {

        return self::curl($url, $param,"get");
    }

    public static function post($url, $param,$extra = []) {

        return self::curl($url, $param,"post",$extra);
    }


    protected static function curl($url, $param, $method = 'post',$extra = [])
    {
        $calculate_time1 = microtime(true);
        // 初始华
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_CERTINFO , true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		//curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
		//curl_setopt($curl, CURLOPT_SSLVERSION, 3);
		curl_setopt($curl,CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);

        if( isset( Yii::$app->params['curl'] ) && isset(Yii::$app->params['curl']['timeout']) ){
            curl_setopt($curl, CURLOPT_TIMEOUT, Yii::$app->params['curl']['timeout']);
        }else{
            curl_setopt($curl, CURLOPT_TIMEOUT, 5);
        }

        if(array_key_exists("HTTP_USER_AGENT",$_SERVER)){
            curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
        }

        /**增加证书认证*/
        if( isset( $extra['SSLCERTTYPE'] ) && $extra['SSLCERTTYPE'] ){
            curl_setopt($curl,CURLOPT_SSLCERTTYPE,'PEM');
            curl_setopt($curl,CURLOPT_SSLCERT, $extra['SSLCERTTYPE']);
        }

        if( isset( $extra['CURLOPT_SSLKEYTYPE'] ) && $extra['CURLOPT_SSLKEYTYPE'] ){
            curl_setopt($curl,CURLOPT_SSLKEY,'PEM');
            curl_setopt($curl,CURLOPT_SSLKEY, $extra['CURLOPT_SSLKEYTYPE']);
        }


        if( !empty(self::$headers) ){
            $headerArr = [];
            foreach( self::$headers as $n => $v ) {
                $headerArr[] = $n .':' . $v;
            }
            curl_setopt ($curl, CURLOPT_HTTPHEADER , $headerArr );  //构造IP
        }


        // post处理
        if ($method == 'post')
        {
            curl_setopt($curl, CURLOPT_POST, TRUE);
            if( is_array($param) ){
				if( isset( $param['forbidden_build_query'] ) ){//有的要禁止build_query，例如上传文件

				}else{
					$param = http_build_query($param);
				}
            }

            curl_setopt($curl, CURLOPT_POSTFIELDS, $param);
        }else{
            curl_setopt($curl, CURLOPT_POST, FALSE);
        }

        // 执行输出
        $info = curl_exec($curl);
        
        //log
        $_errno = curl_errno($curl);
        $_error = '';
        if($_errno)
        {
            $_error = curl_error($curl);
        }
        curl_close($curl);
        $calculate_time_span = microtime(true) - $calculate_time1;
        $log = \Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR.'curl_'.date("Y-m-d").'.log';
		if( strlen( $info) < 10000 ){
			file_put_contents($log,date('Y-m-d H:i:s')." [ time:{$calculate_time_span} ] url: {$url} \nmethod: {$method} \ndata: ".json_encode($param)." \nresult: {$info} \nerrorno: {$_errno} error: {$_error} \n",FILE_APPEND);
		}else{
			file_put_contents($log,date('Y-m-d H:i:s')." [ time:{$calculate_time_span} ] url: {$url} \nmethod: {$method} \ndata: ".json_encode($param)." \nresult: too large  \nerrorno: {$_errno} error: {$_error} \n",FILE_APPEND);
		}

        return $info;
    }


    public static function setHeader($header){
         self::$headers = $header;
    }


    protected static function getProxy() {
        $proxy = array(
            '0' => '60.16.210.118:80',
            '1' => '183.62.60.100:80',
            '2' => '58.215.185.46:82',
            '3' => '223.4.21.184:80',
            '4' => '61.53.143.179:80',
            '5' => '42.121.105.155:8888',
            '6' => '115.29.184.17:82',
            '7' => '183.131.144.204:443',
            '8' => '121.199.30.110:82',
            '9' => '113.207.130.166:80',
            '10' => '124.202.181.226:8118',
            '11' => '116.236.216.116:8080',
            '12' => '114.255.183.173:8080',
            '13' => '202.108.50.75:80',
            '14' => '122.96.59.106:82',
            '15' => '122.96.59.106:83',
            '16' => '1.202.74.121:8118',
            '17' => '114.255.183.164:8080',
            '18' => '111.13.136.59:843',
            '19' => '122.96.59.106:843',
            '20' => '101.71.27.120:80',
            '21' => '122.96.59.106:81',
            '22' => '111.1.36.6:80',
            '23' => '114.255.183.174:8080',
            '24' => '120.198.243.111:80',
            '25' => '218.240.156.82:80',
            '26' => '61.184.192.42:80',
            '27' => '119.6.144.74:83',
            '28' => '119.6.144.74:843',
            '29' => '124.202.217.134:8118',
            '30' => '221.10.102.203:83',
            '31' => '119.6.144.74:82',
            '32' => '119.6.144.74:80',
            '33' => '58.252.72.179:3128',
            '34' => '60.24.122.236:8118',
            '35' => '203.192.10.66:80',
            '36' => '221.10.102.203:81',
            '37' => '211.141.130.96:8118',
            '38' => '124.88.67.13:843',
            '39' => '119.6.144.74:81',
            '40' => '222.33.41.228:80',
            '41' => '221.10.102.203:843',
            '42' => '111.7.129.133:80',
            '43' => '124.88.67.13:83',
            '44' => '61.156.3.166:80',
            '45' => '218.204.140.212:8001',
            '46' => '116.236.203.238:8080',
            '47' => '122.96.59.106:80',
            '48' => '182.118.23.7:8081',
            '49' => '222.45.194.122:8118',
            '50' => '123.171.119.52:80'
        );

        $rand = rand(0,50);
        return $proxy[$rand];
    }


}
