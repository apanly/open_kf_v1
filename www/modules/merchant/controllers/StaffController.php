<?php

namespace www\modules\merchant\controllers;

use common\components\DataHelper;
use common\components\GlobalUrlService;
use common\models\merchant\MerchantStaff;
use common\services\Constants;
use common\services\MerchantService;
use www\modules\merchant\controllers\common\AuthController;


class StaffController extends AuthController{

    public function actionIndex(){
        $p = intval( $this->get("p",1) );
        $query = MerchantStaff::find();
        $total_count = $query->count();
        $offset = ($p - 1) * $this->page_size;
        $list = $query->offset($offset)
            ->limit( $this->page_size )
            ->asArray()->all();

        $pages = DataHelper::ipagination([
            "total_count" => $total_count,
            "page_size" => $this->page_size,
            "page" => $p,
            "display" => 10
        ]);

        return $this->render('index',[
            "list" => $list,
            "pages" => $pages
        ]);
    }

    public function actionSet(  ){


        if( \Yii::$app->request->isGet ){
            $id = intval( $this->get("id",0 ) );
            $staff_info = [];
            if( $id ){
                $staff_info = MerchantStaff::findOne([ 'id' => $id ]);
            }

            $info = [];
            if( $staff_info ){
                $info['id'] = $staff_info['id'];
                $info['avatar'] = $staff_info['avatar'];
                $info['nickname'] = $staff_info['nickname'];
                $info['login_name'] = $staff_info['login_name'];
                $info['login_pwd'] = Constants::$default_login_pwd;
            }
            return $this->render("set",[ "info" => $info ]);
        }
        $id = $this->post("id",0);
        $avatar = Constants::$default_kf_avatar;
        $nickname = trim($this->post('nickname',''));
        $login_name = trim($this->post('login_name',''));
        $login_pwd = $this->post('login_pwd','');
        if( mb_strlen($nickname,'utf-8') < 1 ){
            return $this->renderJSON([],"请输入符合规范的昵称~~",-1);
        }

        if( mb_strlen( $login_name,'utf-8') < 4 || mb_strlen($login_name,'utf-8') > 11){
            return $this->renderJSON([],"请输入符合规范的登录用户名，登录名称介于4 - 11 个字符~~",-1);
        }

        if( mb_strlen( $login_pwd,'utf-8') < 6 ){
            return $this->renderJSON([],"请输入符合规范的密码，密码不能少于6位~",-1);
        }

        $same_login_name_staff = MerchantStaff::find()
            ->where([ 'login_name' => $login_name ])
            ->andWhere( ['!=','id',$id] )->one();

        if( $same_login_name_staff ){
            return $this->renderJSON([],"登录账号已被占用，请换一个试试哦~~",-1);
        }

        $staff_info = MerchantStaff::findOne([ 'id' => $id ]);

        if( $staff_info ){
            $model_staff = $staff_info;
        }else{
            $model_staff = new MerchantStaff();
            $model_staff->setSalt();
            $model_staff->sn = MerchantService::getStaffUniqueSn( $login_name );
        }
        $model_staff->avatar = $avatar;
        $model_staff->nickname = $nickname;
        if( $model_staff->login_name != $login_name ){
            $model_staff->login_name = $login_name;
        }

        if( $login_pwd != Constants::$default_login_pwd  && $model_staff->getSaltPassword( $login_pwd ) != $model_staff->login_pwd ){
            $model_staff->setPassword( $login_pwd );
        }

        $model_staff->save( 0 );
        return $this->renderJSON();
    }
}
