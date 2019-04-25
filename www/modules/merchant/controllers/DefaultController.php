<?php

namespace www\modules\merchant\controllers;

use common\models\stat\StatDailyMerchant;
use www\modules\merchant\controllers\common\AuthController;


class DefaultController extends AuthController{

    public function actionIndex(){

        return $this->render('index',[
            'custom_date' => $this->getCustomDate()
        ]);
    }

    private function getCustomDate(){
        return [
            '今天' =>  [
                'date_from' => date("Y-m-d"),
                'date_to' => date("Y-m-d")
            ],
            '近7天' =>  [
                'date_from' => date("Y-m-d",strtotime("-7 days") ),
                'date_to' => date("Y-m-d")
            ],
            '近15天' =>  [
                'date_from' => date("Y-m-d",strtotime("-15 days") ),
                'date_to' => date("Y-m-d")
            ],
            '近30天' =>  [
                'date_from' => date("Y-m-d",strtotime("-30 days") ),
                'date_to' => date("Y-m-d")
            ],
            '本周' =>  [
                'date_from' => date("Y-m-d",strtotime("-".(date("N")-1)." days") ),
                'date_to' => date("Y-m-d")
            ],
            '本月' =>  [
                'date_from' => date("Y-m-01" ),
                'date_to' => date("Y-m-d")
            ]
        ];
    }
}
