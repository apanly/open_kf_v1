<?php

namespace common\models\stat;

use Yii;

/**
 * This is the model class for table "stat_daily_device".
 *
 * @property int $id
 * @property string $date 日期
 * @property string $client_device 设备名称
 * @property int $total_number 当日总次数
 * @property string $updated_time 最后一次更新时间
 * @property string $created_time 插入时间
 */
class StatDailyDevice extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stat_daily_device';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_kf');
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date', 'client_device'], 'required'],
            [['date', 'updated_time', 'created_time'], 'safe'],
            [['total_number'], 'integer'],
            [['client_device'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'client_device' => 'Client Device',
            'total_number' => 'Total Number',
            'updated_time' => 'Updated Time',
            'created_time' => 'Created Time',
        ];
    }
}
