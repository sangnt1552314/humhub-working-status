<?php
namespace humhub\modules\workingStatus\models;

use yii\db\ActiveRecord;

class WorkingStatusType extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'working_status_type';
    }
}