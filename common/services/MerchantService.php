<?php
namespace common\services;

use common\models\merchant\Merchant;
use common\models\merchant\MerchantStaff;

class MerchantService extends BaseService {

    public static function getUniqueSn( $mobile ){
        do{
            $sn = md5("saas_merchant_{$mobile}".time());
            $sn = mb_substr($sn,5,8);
        }while( Merchant::findOne( ['sn'=>$sn] ) );
        return $sn;
    }

    public static function getStaffUniqueSn( $login_name ){
        do{
            $sn = md5("saas_kf_{$login_name}".time());
            $sn = mb_substr($sn,5,8);
        }while( MerchantStaff::findOne( ['sn'=>$sn] ) );
        return $sn;
    }

    public static function getMerchantInfoBySn( $sn ){
        $merchant_info = Merchant::findOne([ 'sn' => $sn ]);
        return $merchant_info;
    }


    public static function getGuestNumer( $f_code = '' ){
        //给游客一个编号，一天有效。建议使用缓存 这样同一天的f_code 编号一样
        return mt_rand(0,10000);
    }

}