<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "chat_history".
 *
 * @property int $id
 * @property string $cmd 指令
 * @property string $f_name 发送方昵称
 * @property string $f_code 发送方code
 * @property string $f_avatar 发送方头像
 * @property string $to_name 接收方昵称
 * @property string $to_code 接收方code
 * @property string $to_avatar 接收方头像
 * @property string $content 发送内容
 * @property int $source 来源 1：访客 2：客服 3：系统
 * @property string $updated_time 更新时间
 * @property string $created_time 创建时间
 */
class ChatHistory extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat_history';
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
            [['cmd'], 'required'],
            [['source'], 'integer'],
            [['updated_time', 'created_time'], 'safe'],
            [['cmd'], 'string', 'max' => 20],
            [['f_name', 'f_code', 'to_name', 'to_code'], 'string', 'max' => 32],
            [['f_avatar', 'to_avatar'], 'string', 'max' => 250],
            [['content'], 'string', 'max' => 1000],
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
            'f_name' => 'F Name',
            'f_code' => 'F Code',
            'f_avatar' => 'F Avatar',
            'to_name' => 'To Name',
            'to_code' => 'To Code',
            'to_avatar' => 'To Avatar',
            'content' => 'Content',
            'source' => 'Source',
            'updated_time' => 'Updated Time',
            'created_time' => 'Created Time',
        ];
    }
}
