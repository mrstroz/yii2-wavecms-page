<?php

namespace mrstroz\wavecms\page;

/**
 * Class Module
 * @package mrstroz\wavecms\page
 * This is the main module class of the yii2-wavecms-page.
 */
class Module extends \yii\base\Module
{
    /**
     * @var array Class mapping
     */
    public $classMap = [];

    public function init()
    {
        $this->controllerNamespace = 'mrstroz\wavecms\page\controllers';

        parent::init();
    }

}
