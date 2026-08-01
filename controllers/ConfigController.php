<?php
namespace humhub\modules\workingStatus\controllers;

use humhub\modules\admin\components\Controller;
use humhub\modules\workingStatus\services\WorkingStatusService;

class ConfigController extends Controller
{
    public function actionIndex()
    {
        $service = new WorkingStatusService();

        return $this->render('index', [
            'statusTypes' => $service->getAllWorkingStatusTypes(),
        ]);
    }

    public function actionCreate()
    {
        // form to create a new status type
        return $this->render('create');
    }
}