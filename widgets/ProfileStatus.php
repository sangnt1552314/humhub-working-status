<?php

namespace humhub\modules\workingStatus\widgets;

use humhub\components\Widget;
use humhub\modules\user\models\User;
use humhub\modules\workingStatus\services\WorkingStatusService;
use Yii;
use yii\helpers\Url;

/**
 * Displays the current working status of a user on their profile sidebar.
 * Renders nothing when the user has no working status set.
 */
class ProfileStatus extends Widget
{
    /**
     * @var User the profile owner
     */
    public $user;

    public function run(): string
    {
        if ($this->user === null) {
            return '';
        }

        $status = (new WorkingStatusService())->findUserStatus($this->user->id);

        // Do not show an empty widget when no status is set.
        if ($status === null || $status->type === null) {
            return '';
        }

        $isOwnProfile = !Yii::$app->user->isGuest
            && Yii::$app->user->id === $this->user->id;

        return $this->render('profileStatus', [
            'status' => $status,
            'isOwnProfile' => $isOwnProfile,
            'editUrl' => Url::to(['/working-status/status/edit']),
        ]);
    }
}
