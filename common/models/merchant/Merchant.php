<?php

namespace common\models\merchant;

use Yii;

/**
 * This is the model class for table "merchant".
 *
 * @property int $id
 * @property string $login_name 登录用户名
 * @property string $login_pwd 登录密码
 * @property string $login_salt 随机加密字符串
 * @property string $sn 会员唯一编号
 * @property int $status 状态 1：有效 0：无效
 * @property string $updated_time 更新时间
 * @property string $created_time 创建时间
 */
class Merchant extends \yii\db\ActiveRecord {
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
        return 'merchant';
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
            [['status'], 'integer'],
            [['updated_time', 'created_time'], 'safe'],
            [['login_name'], 'string', 'max' => 30],
            [['login_pwd', 'login_salt'], 'string', 'max' => 32],
            [['sn'], 'string', 'max' => 10],
            [['sn'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login_name' => 'Login Name',
            'login_pwd' => 'Login Pwd',
            'login_salt' => 'Login Salt',
            'sn' => 'Sn',
            'status' => 'Status',
            'updated_time' => 'Updated Time',
            'created_time' => 'Created Time',
        ];
    }
}
