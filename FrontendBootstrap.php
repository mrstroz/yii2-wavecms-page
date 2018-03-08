<?php

namespace mrstroz\wavecms\page;

use mrstroz\wavecms\page\components\helpers\Front;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\helpers\VarDumper;
use yii\web\View;

/**
 * Class FrontendBootstrap
 * @package mrstroz\wavecms\page
 * Boostrap class for frontend wavecms page
 */
class FrontendBootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        $app->view->on(View::EVENT_BEGIN_PAGE, function ($event) {

            $favicon = \Yii::$app->settings->get('PageSettings','favicon');

            if ($favicon) {
                $event->sender->registerLinkTag([
                    'rel' => 'icon',
                    'type' => 'image/png',
                    'href' => Front::imgUrl($favicon)
                ]);
            }

            $topJs = \Yii::$app->settings->get('PageSettings','top_javascript');
            if ($topJs) {
                $event->sender->registerJs($topJs,View::POS_HEAD);
            }

            $btmJs = \Yii::$app->settings->get('PageSettings','btm_javascript');
            if ($btmJs) {
                $event->sender->registerJs($btmJs);
            }

        });


    }


}