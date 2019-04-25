<?php

namespace common\models\merchant;

use Yii;

/**
 * This is the model class for table "merchant_staff".
 *
 * @property int $id
 * @property string $nickname 昵称
 * @property string $sn 标识
 * @property string $avatar 头像
 * @property string $login_name 登录用户名
 * @property string $login_pwd 登录密码
 * @property string $login_salt 登录密码随机码
 * @property int $status 状态
 * @property int $online_status 在线状态
 * @property string $last_active_time 最后活跃时间
 * @property string $updated_time 最后更新时间
 * @property string $created_time 插入时间
 */
class MerchantStaff extends \yii\db\ActiveRecord
{
    public function setPassword( $password ) {
        $this->login_pwd = $this->getSaltPassword($password);
    }

    public function setSalt( $length = 16 ){
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*";
        $salt = '';
        for ( $i = 0; $i < $length; $i++ ){
            $salt .= $chars[ mt_rand(0, strlen($chars) - 1) ];
        }
        $this->login_salt = $salt;
    }

    public function getSaltPassword($password) {
        return md5( $password.md5($this->login_salt) );
    }


    public function verifyPassword($password) {
        return $this->login_pwd === $this->getSaltPassword($password);
    }
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'merchant_staff';
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
            [['status', 'online_status'], 'integer'],
            [['last_active_time', 'updated_time', 'created_time'], 'safe'],
            [['nickname'], 'string', 'max' => 30],
            [['sn', 'login_pwd', 'login_salt'], 'string', 'max' => 32],
            [['avatar'], 'string', 'max' => 255],
            [['login_name'], 'string', 'max' => 20],
            [['login_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nickname' => 'Nickname',
            'sn' => 'Sn',
            'avatar' => 'Avatar',
            'login_name' => 'Login Name',
            'login_pwd' => 'Login Pwd',
            'login_salt' => 'Login Salt',
            'status' => 'Status',
            'online_status' => 'Online Status',
            'last_active_time' => 'Last Active Time',
            'updated_time' => 'Updated Time',
            'created_time' => 'Created Time',
        ];
    }
}
