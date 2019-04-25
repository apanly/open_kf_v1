<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "guest_trace".
 *
 * @property int $id
 * @property string $cmd 动作
 * @property string $f_code 游客的uuid
 * @property string $f_clientid 游客ws的clientid
 * @property string $ua 浏览器UA
 * @property string $ip 游客ip
 * @property string $referer 游客referer
 * @property string $talk_url 浏览页面
 * @property string $source 来源域名
 * @property string $client_browser 浏览器
 * @property string $client_browser_version 浏览器版本号
 * @property string $client_os 客户端操作系统
 * @property string $client_os_version 操作系统版本号
 * @property string $client_device 客户端设备
 * @property string $created_time 创建时间
 */
class GuestTrace extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'guest_trace';
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
            [['created_time'], 'safe'],
            [['cmd', 'client_os', 'client_device'], 'string', 'max' => 20],
            [['f_code'], 'string', 'max' => 64],
            [['f_clientid', 'ip'], 'string', 'max' => 32],
            [['ua', 'talk_url'], 'string', 'max' => 500],
            [['referer'], 'string', 'max' => 1500],
            [['source'], 'string', 'max' => 100],
            [['client_browser'], 'string', 'max' => 50],
            [['client_browser_version', 'client_os_version'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cmd' => 'Cmd',
            'f_code' => 'F Code',
            'f_clientid' => 'F Clientid',
            'ua' => 'Ua',
            'ip' => 'Ip',
            'referer' => 'Referer',
            'talk_url' => 'Talk Url',
            'source' => 'Source',
            'client_browser' => 'Client Browser',
            'client_browser_version' => 'Client Browser Version',
            'client_os' => 'Client Os',
            'client_os_version' => 'Client Os Version',
            'client_device' => 'Client Device',
            'created_time' => 'Created Time',
        ];
    }
}
