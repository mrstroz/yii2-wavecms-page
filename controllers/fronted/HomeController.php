<?php

namespace mrstroz\wavecms\page\controllers\frontend;

use yii\web\Controller;

class HomeController extends Controller
{

    public function init()
    {
        $this->viewPath = '@wavecms_page/views/frontend/home';
    }

    public function actionIndex()
    {

    }
}