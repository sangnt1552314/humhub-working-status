<?php
namespace humhub\modules\workingStatus;

use yii\helpers\Url;

class Module extends \humhub\components\Module 
{
    /**
     * @inheritdoc
     */
    public function getConfigUrl()
    {
        return Url::to(['/working-status/config/index']);
    }
}