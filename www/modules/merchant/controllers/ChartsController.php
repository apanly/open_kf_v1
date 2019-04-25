<?php

namespace www\modules\merchant\controllers;

use common\models\stat\StatDailyAccessSource;
use common\models\stat\StatDailyBrowser;
use common\models\stat\StatDailyDevice;
use common\models\stat\StatDailyOs;
use www\modules\merchant\controllers\common\AuthController;


class ChartsController extends AuthController {
    public function actionDashboard(){
		$date_from = $this->get("date_from", date("Y-m-d") );
		$date_to = $this->get("date_to", date("Y-m-d") );

        $date_from_int = date("Ymd",strtotime( $date_from ) );
        $date_to_int = date("Ymd",strtotime( $date_to ) );
        $data_source = [
			'series' => [
				[
					'data' => []
				]
			]
		];
        //->andWhere([ 'not in','source',$ignore_source ])
		$source_list = StatDailyAccessSource::find()
			->select([ 'source','SUM(total_number) as total_number' ])
			->andWhere([ 'between','date' , $date_from_int,$date_to_int ])
			->orderBy([ 'total_number' => SORT_DESC ])
			->groupBy([ 'source' ])
			->asArray()
			->all();
		if( $source_list ){
			$total_number = array_sum(  array_column($source_list,"total_number") );
			foreach( $source_list as $_item ){
				$data_source['series'][0]['data'][] =[
					'name' => $_item['source'],
					'y' => floatval( sprintf("%.2f", ( $_item['total_number']/ $total_number) * 100 ) ),
					'total_number' => $_item['total_number']
				];
			}
		}

		/*浏览器统计*/
		$data_client_browser = [
			'series' => [
				[
					'data' => []
				]
			]
		];

		$client_browser_list = StatDailyBrowser::find()
			->select([ 'client_browser','SUM(total_number) as total_number' ])
			->andWhere([ 'between','date' , $date_from_int,$date_to_int ])
			->orderBy([ 'total_number' => SORT_DESC ])
			->groupBy([ 'client_browser' ])
			->asArray()
			->all();
		if( $client_browser_list ){
			$total_number = array_sum(  array_column($client_browser_list,"total_number") );
			foreach( $client_browser_list as $_item ){
				$data_client_browser['series'][0]['data'][] =[
					'name' => $_item['client_browser'],
					'y' => floatval( sprintf("%.2f", ( $_item['total_number']/ $total_number) * 100 ) ),
					'total_number' => $_item['total_number']
				];
			}
		}



        return $this->renderJSON([
			'source' => $data_source,
			'client_browser' => $data_client_browser,
		]);
    }
}