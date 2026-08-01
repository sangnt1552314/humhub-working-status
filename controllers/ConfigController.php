<?php
namespace humhub\modules\workingStatus\controllers;

use humhub\modules\admin\components\Controller;
use Yii;

class ConfigController extends Controller
{
    public function actionIndex()
    {
        // list existing status types
        return $this->render('index');
    }

    public function actionCreate()
    {
        // form to create a new status type
        return $this->render('create');
    }
}