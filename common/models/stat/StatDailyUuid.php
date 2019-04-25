<?php

namespace common\models\stat;

use Yii;

/**
 * This is the model class for table "stat_daily_uuid".
 *
 * @property int $id
 * @property string $date 日期 20161016
 * @property string $uuid 唯一标示
 * @property int $total_number 总次数
 * @property string $updated_time 最后一次更新时间
 * @property string $created_time 创建时间
 */
class StatDailyUuid extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stat_daily_uuid';
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
            [['date', 'uuid'], 'required'],
            [['date', 'updated_time', 'created_time'], 'safe'],
            [['total_number'], 'integer'],
            [['uuid'], 'string', 'max' => 100],
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
            'uuid' => 'Uuid',
            'total_number' => 'Total Number',
            'updated_time' => 'Updated Time',
            'created_time' => 'Created Time',
        ];
    }
}
