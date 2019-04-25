<?php

namespace common\components;
use  yii\helpers\Html;

class DataHelper {



    /**
     * 转移特殊字符
     */
    public static function encode($dispaly_text){
        return  Html::encode($dispaly_text);
    }

    /**
     * 根据某个字段 in  查询
     */
    public static function getDicByRelateID($data,$relate_model,$id_column,$pk_column,$name_columns = [])
    {
        $_ids = [];
        $_names = [];
        foreach($data as $_row)
        {
            $_ids[] = $_row[$id_column];
        }
        $rel_data = $relate_model::findAll([$pk_column => array_unique($_ids)]);
        foreach($rel_data as $_rel)
        {
            $map_item = [];
            if($name_columns && is_array($name_columns)){
                foreach($name_columns as $name_column){
                    $map_item[$name_column] = $_rel->$name_column;
                }
            }
            $_names[$_rel->$pk_column] = $map_item;
        }
        return $_names;
    }

    public static function getPkDict($model_class,$pk_column,$name_column,$condition=[])
    {
        $return = [];
        $db_records = $model_class::find()->where($condition)->all();
        foreach($db_records as $_tmp)
        {
            $return[$_tmp->$pk_column] = $_tmp->$name_column;
        }
        return $return;
    }


	/**
	 *分页
	 */
	public static function ipagination($params)
	{
		$ret = [
			'previous'  => true,
			'next'      => true,
			'from'      => 0,
			'end'       => 0,
			'totalPage' => 0,
			'total_page' => 0,
			'current'   => 0,
			'page_size' => intval( $params['page_size'] )
		];
		$total     = (int)$params['total_count'];
		$pageSize  = (int)$params['page_size'];
		$page      = (int)$params['page'];
		$display   = (int)$params['display'];
		$totalPage = (int)ceil($total / $pageSize);
		$totalPage = $totalPage?$totalPage:1;

		if ($page <= 1) {
			$ret['previous'] = false;
		}
		if ($page >= $totalPage) {
			$ret['next'] = false;
		}
		$semi = (int)ceil($display / 2);
		if ($page - $semi > 0) {
			$ret['from'] = $page - $semi;
		} else {
			$ret['from'] = 1;
		}
		if ($page + $semi <= $totalPage) {
			$ret['end'] = $page + $semi;
		} else {
			$ret['end'] = $totalPage;
		}
		$ret['total_count'] = $total;
		$ret['totalPage'] = $totalPage;
		$ret['total_page'] = $totalPage;
		$ret['current']   = $page;
		return $ret;
	}

    public static function getAuthorName(){
        return \Yii::$app->params['author']['nickname'];
    }

}