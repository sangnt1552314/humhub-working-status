<?php

namespace humhub\modules\workingStatus\controllers;

use humhub\components\Controller;
use humhub\modules\workingStatus\services\WorkingStatusService;
use Yii;
use yii\web\Response;

/**
 * Handles the logged-in user setting or changing their own working status.
 */
class StatusController extends Controller
{
    /**
     * @inheritdoc
     */
    public function getAccessRules()
    {
        return [
            ['login'],
        ];
    }

    /**
     * Renders the reusable status modal form and handles saving.
     * Used by both the account menu and the profile "Change status" action.
     */
    public function actionEdit()
    {
        $service = new WorkingStatusService();
        $user = Yii::$app->user->getIdentity();

        // A user can only ever load and update their own status record.
        $model = $service->getOrCreateUserStatus($user);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $this->view->saved();
            // Redirect to the user's own profile so the applied status is visible.
            return $this->htmlRedirect($user->createUrl('/user/profile/home'));
        }

        return $this->renderAjax('modal', [
            'model' => $model,
            'typeOptions' => $service->getActiveTypeOptions(),
        ]);
    }

    /**
     * Returns a JSON map of [contentcontainer_id => color] so the client can
     * tint online presence dots with each user's working status color.
     */
    public function actionColors()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        return (new WorkingStatusService())->getContainerColorMap();
    }
}
