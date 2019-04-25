<?php

namespace www\modules\merchant\controllers;

use common\components\DataHelper;
use common\components\GlobalUrlService;
use common\models\ChatHistory;
use common\models\guest\GuestMessage;
use common\models\GuestTrace;
use common\models\stat\StatDailyAccessSource;
use common\models\stat\StatDailyBrowser;
use common\models\stat\StatDailyOs;
use common\models\stat\StatDailyUuid;
use common\services\ip\IPService;
use www\modules\merchant\controllers\common\AuthController;


class StatController extends AuthController{

    public function actionTrace(){
        $p = intval( $this->get("p",1) );
        $date_from = $this->get("date_from",date("Y-m-01") );
        $date_to = $this->get("date_to",date("Y-m-d") );

        $source = trim( $this->get("source","") );
        $uuid = trim( $this->get("uuid",""));
        $client_os = trim( $this->get("client_os",""));
        $client_browser = trim( $this->get("client_browser",""));

        $query = GuestTrace::find();
        if( $date_from ){
            $query->andWhere([ '>=','created_time',date("Y-m-d 00:00:00",strtotime( $date_from ) ) ]);
        }
        if( $date_from ){
            $query->andWhere([ '<=','created_time',date("Y-m-d 23:59:59",strtotime( $date_to ) ) ]);
        }

        if( $source ){
            $query->andWhere([ 'source' => $source ]);
        }

        if( $uuid ){
            $query->andWhere([ 'f_code' => $uuid ]);
        }

        if( $client_os ){
            $query->andWhere([ 'client_os' => $client_os ]);
        }

        if( $client_browser ){
            $query->andWhere([ 'client_browser' => $client_browser ]);
        }

        $total_count = $query->count();
        $offset = ($p - 1) * $this->page_size;
        $list = $query->offset($offset)->orderBy([ 'id' => SORT_DESC ])
            ->limit( $this->page_size )->asArray()->all();

        $pages = DataHelper::ipagination([
            "total_count" => $total_count,
            "page_size" => $this->page_size,
            "page" => $p,
            "display" => 10
        ]);

        $data = [];
        if( $list ){
            foreach( $list as $_item){
                $_item[ 'ip_desc' ] = implode(" ",IPService::find($_item['ip']) );
                $data[] = $_item;
            }
        }

        $search_conditions = [
            'date_from' => $date_from,
            'date_to' => $date_to,
            'source' => $source,
            'uuid' => $uuid,
            'client_os' => $client_os,
            'client_browser' => $client_browser
        ];

        return $this->render('trace',[
            "list" => $data,
            "pages" => $pages,
            'search_conditions' => $search_conditions
        ]);
    }

    public function actionUuid(){
        $date_from = $this->get("date_from",date("Y-m-d") );
        $date_to = $this->get("date_to",date("Y-m-d") );

        $p = intval( $this->get("p",1) );
        if(!$p){
            $p = 1;
        }


        $query = StatDailyUuid::find();
        if( $date_from ){
            $query->andWhere([ '>=','date',date("Y-m-d",strtotime( $date_from ) ) ]);
        }
        if( $date_from ){
            $query->andWhere([ '<=','date',date("Y-m-d",strtotime( $date_to ) ) ]);
        }

        $total_count = $query->count();
        $offset = ($p - 1) * $this->page_size;
        $list = $query->orderBy("id desc")->offset($offset)->limit( $this->page_size )->all();

        $pages = DataHelper::ipagination([
            "total_count" => $total_count,
            "page_size" => $this->page_size,
            "page" => $p,
            "display" => 10
        ]);

        $search_conditions = [
            'date_from' => $date_from,
            'date_to' => $date_to,
        ];
        return $this->render("uuid",[
            "data" => $list,
            "pages" => $pages,
            'search_conditions' => $search_conditions
        ]);
    }

    public function actionSource(){
        $date_from = $this->get("date_from",date("Y-m-d") );
        $date_to = $this->get("date_to",date("Y-m-d") );

        $p = intval( $this->get("p",1) );
        if(!$p){
            $p = 1;
        }


        $query = StatDailyAccessSource::find();
        if( $date_from ){
            $query->andWhere([ '>=','date',date("Y-m-d",strtotime( $date_from ) ) ]);
        }
        if( $date_from ){
            $query->andWhere([ '<=','date',date("Y-m-d",strtotime( $date_to ) ) ]);
        }

        $total_count = $query->count();
        $offset = ($p - 1) * $this->page_size;
        $list = $query->orderBy("id desc")->offset($offset)->limit( $this->page_size )->all();

        $pages = DataHelper::ipagination([
            "total_count" => $total_count,
            "page_size" => $this->page_size,
            "page" => $p,
            "display" => 10
        ]);


        $search_conditions = [
            'date_from' => $date_from,
            'date_to' => $date_to,
        ];
        return $this->render("source",[
            "data" => $list,
            "pages" => $pages,
            'search_conditions' => $search_conditions
        ]);
    }

    public function actionOs(){
        $date_from = $this->get("date_from",date("Y-m-d") );
        $date_to = $this->get("date_to",date("Y-m-d") );

        $p = intval( $this->get("p",1) );
        if(!$p){
            $p = 1;
        }


        $query = StatDailyOs::find();
        if( $date_from ){
            $query->andWhere([ '>=','date',date("Y-m-d",strtotime( $date_from ) ) ]);
        }
        if( $date_from ){
            $query->andWhere([ '<=','date',date("Y-m-d",strtotime( $date_to ) ) ]);
        }

        $total_count = $query->count();
        $offset = ($p - 1) * $this->page_size;
        $list = $query->orderBy([ 'id' => SORT_DESC ])->offset($offset)->limit( $this->page_size )->all();

        $pages = DataHelper::ipagination([
            "total_count" => $total_count,
            "page_size" => $this->page_size,
            "page" => $p,
            "display" => 10
        ]);


        $search_conditions = [
            'date_from' => $date_from,
            'date_to' => $date_to,
        ];
        return $this->render("os",[
            "data" => $list,
            "pages" => $pages,
            'search_conditions' => $search_conditions
        ]);
    }

    public function actionBrowser(){
        $date_from = $this->get("date_from",date("Y-m-d") );
        $date_to = $this->get("date_to",date("Y-m-d") );

        $p = intval( $this->get("p",1) );
        if(!$p){
            $p = 1;
        }


        $query = StatDailyBrowser::find();
        if( $date_from ){
            $query->andWhere([ '>=','date',date("Y-m-d",strtotime( $date_from ) ) ]);
        }
        if( $date_from ){
            $query->andWhere([ '<=','date',date("Y-m-d",strtotime( $date_to ) ) ]);
        }

        $total_count = $query->count();
        $offset = ($p - 1) * $this->page_size;
        $list = $query->orderBy([ 'id' => SORT_DESC ])->offset($offset)->limit( $this->page_size )->all();

        $pages = DataHelper::ipagination([
            "total_count" => $total_count,
            "page_size" => $this->page_size,
            "page" => $p,
            "display" => 10
        ]);


        $search_conditions = [
            'date_from' => $date_from,
            'date_to' => $date_to,
        ];
        return $this->render("browser",[
            "data" => $list,
            "pages" => $pages,
            'search_conditions' => $search_conditions
        ]);
    }
}
