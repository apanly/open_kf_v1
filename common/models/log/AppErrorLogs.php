<?php

namespace common\models\log;

use Yii;

/**
 * This is the model class for table "app_error_logs".
 *
 * @property int $id
 * @property string $app_name app 名字
 * @property string $request_uri 请求uri
 * @property string $content 日志内容
 * @property string $ip ip
 * @property string $ua ua信息
 * @property string $cookies cookie信息。如果有的话
 * @property string $created_time 插入时间
 */
class AppErrorLogs extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'app_error_logs';
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
            [['content'], 'required'],
            [['content'], 'string'],
            [['created_time'], 'safe'],
            [['app_name'], 'string', 'max' => 30],
            [['request_uri'], 'string', 'max' => 255],
            [['ip'], 'string', 'max' => 500],
            [['ua', 'cookies'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'app_name' => 'App Name',
            'request_uri' => 'Request Uri',
            'content' => 'Content',
            'ip' => 'Ip',
            'ua' => 'Ua',
            'cookies' => 'Cookies',
            'created_time' => 'Created Time',
        ];
    }
}
