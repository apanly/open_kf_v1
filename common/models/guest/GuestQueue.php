<?php

namespace common\models\guest;

use Yii;

/**
 * This is the model class for table "guest_queue".
 *
 * @property int $id
 * @property string $f_name 发送方昵称
 * @property string $f_code 发送方code
 * @property string $f_avatar 发送方头像
 * @property string $f_clientid ws服务分配的客户端id
 * @property string $updated_time 更新时间
 * @property string $created_time 创建时间
 */
class GuestQueue extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'guest_queue';
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
            [['updated_time', 'created_time'], 'safe'],
            [['f_name', 'f_code', 'f_clientid'], 'string', 'max' => 32],
            [['f_avatar'], 'string', 'max' => 250],
            [['f_code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'f_name' => 'F Name',
            'f_code' => 'F Code',
            'f_avatar' => 'F Avatar',
            'f_clientid' => 'F Clientid',
            'updated_time' => 'Updated Time',
            'created_time' => 'Created Time',
        ];
    }
}
