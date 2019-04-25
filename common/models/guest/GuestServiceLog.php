<?php

namespace common\models\guest;

use Yii;

/**
 * This is the model class for table "guest_service_log".
 *
 * @property int $id
 * @property string $guest_code 游客code
 * @property string $guest_name 游客昵称
 * @property string $guest_avatar 游客头像
 * @property string $guest_client_id 游客客服系统分配的客户端id
 * @property string $guest_ip 游客的ip
 * @property string $kf_code 客服code
 * @property string $begin_time 服务开始时间
 * @property string $end_time 服务结束时间
 * @property string $updated_time 更新时间
 * @property string $created_time 创建时间
 */
class GuestServiceLog extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'guest_service_log';
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
            [['guest_name'], 'required'],
            [['begin_time', 'end_time', 'updated_time', 'created_time'], 'safe'],
            [['guest_code', 'guest_name', 'kf_code'], 'string', 'max' => 32],
            [['guest_avatar'], 'string', 'max' => 255],
            [['guest_client_id'], 'string', 'max' => 64],
            [['guest_ip'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'guest_code' => 'Guest Code',
            'guest_name' => 'Guest Name',
            'guest_avatar' => 'Guest Avatar',
            'guest_client_id' => 'Guest Client ID',
            'guest_ip' => 'Guest Ip',
            'kf_code' => 'Kf Code',
            'begin_time' => 'Begin Time',
            'end_time' => 'End Time',
            'updated_time' => 'Updated Time',
            'created_time' => 'Created Time',
        ];
    }
}
