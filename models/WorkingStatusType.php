<?php
namespace humhub\modules\workingStatus\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * @property int $id
 * @property string $name
 * @property string $color
 * @property int $sort_order
 * @property int $is_deleted
 * @property string $created_at
 * @property string $updated_at
 */
class WorkingStatusType extends ActiveRecord
{
    public static function tableName(): string
    {
        return 'working_status_type';
    }

    public function rules(): array
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
            [['color'], 'string', 'max' => 7],
            [['color'], 'default', 'value' => '#6c757d'],
            [['sort_order'], 'integer'],
            [['sort_order'], 'default', 'value' => 0],
        ];
    }

    public function attributeLabels(): array
    {
        return [
            'name'       => Yii::t('WorkingStatusModule.base', 'Name'),
            'color'      => Yii::t('WorkingStatusModule.base', 'Color'),
            'sort_order' => Yii::t('WorkingStatusModule.base', 'Sort Order'),
        ];
    }

    public function beforeSave($insert): bool
    {
        $now = date('Y-m-d H:i:s');
        if ($insert) {
            $this->created_at = $now;
        }
        $this->updated_at = $now;
        return parent::beforeSave($insert);
    }
}