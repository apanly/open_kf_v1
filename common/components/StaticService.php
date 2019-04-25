<?php
namespace common\components;

use common\components\GlobalUrlService;
use Yii;

class StaticService {

    public static function includeAppStatic($type, $path, $depend){
        $release_version = defined("RELEASE_VERSION") ? RELEASE_VERSION : time();
        if (stripos($path, "?") !== false) {
            $path = $path . "&version={$release_version}";
        } else {
            $path = $path . "?version={$release_version}";
        }

        if ($type == "css") {
            Yii::$app->getView()->registerCssFile($path, ['depends' => $depend]);
        } else {
            Yii::$app->getView()->registerJsFile($path, ['depends' => $depend]);
        }
    }

    public static function includeAppJsStatic($path, $depend)
    {
        self::includeAppStatic("js", $path, $depend);
    }

    public static function includeAppCssStatic($path, $depend)
    {
        self::includeAppStatic("css", $path, $depend);
    }

    public static function buildStaticUrl($path)
    {
        $release_version = defined("RELEASE_VERSION") ? RELEASE_VERSION : time();
        return "/" . $path . "?version={$release_version}";
    }

} 