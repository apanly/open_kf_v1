<?php

namespace www\modules\merchant\controllers;

use common\components\DataHelper;
use common\components\GlobalUrlService;
use common\models\ChatHistory;
use common\models\guest\GuestMessage;
use www\modules\merchant\controllers\common\AuthController;

class ChatController extends AuthController{

    public function actionLog(){

        $p = intval( $this->get("p",1) );
        $query = ChatHistory::find();
        $total_count = $query->count();
        $offset = ($p - 1) * $this->page_size;
        $list = $query->offset($offset)->orderBy([ 'id' => SORT_DESC ])
            ->limit( $this->page_size )->all();

        $pages = DataHelper::ipagination([
            "total_count" => $total_count,
            "page_size" => $this->page_size,
            "page" => $p,
            "display" => 10
        ]);

        return $this->render('log',[
            "list" => $list,
            "pages" => $pages
        ]);
    }
}
