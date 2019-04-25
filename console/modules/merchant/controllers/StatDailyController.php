<?php

namespace console\modules\merchant\controllers;
use common\models\ChatHistory;
use common\models\GuestTrace;
use common\models\merchant\Merchant;
use common\models\stat\StatDailyAccessSource;
use common\models\stat\StatDailyBrowser;
use common\models\stat\StatDailyDevice;
use common\models\stat\StatDailyMerchant;
use common\models\stat\StatDailyOs;
use common\models\stat\StatDailyUuid;
use console\controllers\BaseController;

class StatDailyController extends BaseController {

    /**
     * php yii merchant/stat-daily/source
     */
    public function actionSource( $date = '' ){
        $date = $date?$date:date("Y-m-d");
        if( !preg_match("/^\d{4}-\d{2}-\d{2}$/",$date) ){
            return $this->echoLog("param date format error,2016-04-28");
        }
        $time_from = date("Y-m-d 00:00:00",strtotime( $date ) );
        $time_to = date("Y-m-d 23:59:59",strtotime( $date ) );

        $list = GuestTrace::find()
            ->select([ 'source','COUNT(*) as total_number' ])
            ->andWhere([ '>=','created_time',$time_from ])
            ->andWhere([ '<=','created_time',$time_to ])
            ->groupBy("source")
            ->asArray()
            ->all();

        if( !$list ){
            return $this->echoLog('no data to handle~~');
        }

        $date_now = date("Y-m-d H:i:s");
        foreach( $list as $_item ){
            $tmp_source = $_item['source'];
            if( !$tmp_source ){
                continue;
            }
            $tmp_total_number = $_item['total_number'];
            $tmp_info = StatDailyAccessSource::find()
                ->where([ 'date' => $date,'source' => $tmp_source ])
                ->one();
            if( $tmp_info ){
                $tmp_model_info = $tmp_info;
            }else{
                $tmp_model_info = new StatDailyAccessSource();
                $tmp_model_info->date = $date;
                $tmp_model_info->source = $tmp_source;
                $tmp_model_info->created_time = $date_now;
            }
            $tmp_model_info->total_number = $tmp_total_number;
            $tmp_model_info->updated_time = $date_now;
            $tmp_model_info->save(0);
        }
        return $this->echoLog("it's over~~");
    }



    /*
    * php yii merchant/stat-daily/browser
    * */
    public function actionBrowser( $date = '' ){
        $date = $date?$date:date("Y-m-d");
        if( !preg_match("/^\d{4}-\d{2}-\d{2}$/",$date) ){
            return $this->echoLog("param date format error,2016-04-28");
        }
        $time_from = date("Y-m-d 00:00:00",strtotime( $date ) );
        $time_to = date("Y-m-d 23:59:59",strtotime( $date ) );


        $list = GuestTrace::find()
            ->select([ 'client_browser','COUNT(*) as total_number' ])
            ->andWhere([ '>=','created_time',$time_from ])
            ->andWhere([ '<=','created_time',$time_to ])
            ->groupBy("client_browser")
            ->asArray()
            ->all();

        if( !$list ){
            return $this->echoLog('no data to handle~~');
        }

        $date_now = date("Y-m-d H:i:s");
        foreach( $list as $_item ){
            $tmp_client_browser = $_item['client_browser'];
            if( !$tmp_client_browser ){
                continue;
            }
            $tmp_total_number = $_item['total_number'];
            $tmp_info = StatDailyBrowser::find()
                ->where([ 'date' => $date,'client_browser' => $tmp_client_browser ])
                ->one();
            if( $tmp_info ){
                $tmp_model_info = $tmp_info;
            }else{
                $tmp_model_info = new StatDailyBrowser();
                $tmp_model_info->date = $date;
                $tmp_model_info->client_browser = $tmp_client_browser;
                $tmp_model_info->created_time = $date_now;
            }
            $tmp_model_info->total_number = $tmp_total_number;
            $tmp_model_info->updated_time = $date_now;
            $tmp_model_info->save(0);
        }

        return $this->echoLog("it's over~~");
    }


    /**
     * php yii merchant/stat-daily/cal-all
     */
    public function actionCalAll(){
        $tmp_date = date("Y-m-d" );
        $this->actionBrowser( $tmp_date );
        $this->actionSource( $tmp_date );
    }
}