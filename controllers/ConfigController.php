<?php
namespace humhub\modules\workingStatus\controllers;

use humhub\modules\admin\components\Controller;
use humhub\modules\workingStatus\models\WorkingStatusType;
use humhub\modules\workingStatus\services\WorkingStatusService;
use Yii;
use yii\web\NotFoundHttpException;

class ConfigController extends Controller
{
    public function actionIndex()
    {
        $service = new WorkingStatusService();
        return $this->render('index', [
            'statusTypes' => $service->getAllWorkingStatusTypes(),
        ]);
    }

    public function actionEditType($id = null)
    {
        if ($id) {
            $model = WorkingStatusType::findOne($id);
            if (!$model) {
                throw new NotFoundHttpException();
            }
        } else {
            $model = new WorkingStatusType();
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->view->saved();
            return $this->htmlRedirect(['/working-status/config/index']);
        }

        return $this->renderAjax('editModal', ['model' => $model]);
    }

    public function actionCreate()
    {
        $model = new WorkingStatusType();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->view->saved();
            return $this->redirect(['/working-status/config/index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionDeleteType($id)
    {
        $this->forcePostRequest();
        $model = WorkingStatusType::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException();
        }
        $model->is_deleted = 1;
        $model->save(false);
        return $this->htmlRedirect(['/working-status/config/index']);
    }
}