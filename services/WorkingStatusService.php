<?php

namespace humhub\modules\workingStatus\services;

use humhub\modules\workingStatus\models\WorkingStatusType;
use yii\base\Component;

class WorkingStatusService extends Component
{
    public function getAllWorkingStatusTypes()
    {
        return WorkingStatusType::find()
            ->where(['is_deleted' => 0])
            ->orderBy(['sort_order' => SORT_ASC])
            ->all();
    }
}