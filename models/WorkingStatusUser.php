<?php

namespace humhub\modules\workingStatus\models;

use humhub\modules\user\models\User;
use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "working_status_user".
 *
 * @property int $id
 * @property int $user_id
 * @property int $type_id
 * @property string|null $custom_text
 * @property string $created_at
 * @property string $updated_at
 *
 * @property-read WorkingStatusType $type
 * @property-read User $user
 */
class WorkingStatusUser extends ActiveRecord
{
    public const NOTE_MAX_LENGTH = 255;

    public static function tableName(): string
    {
        return 'working_status_user';
    }

    public function rules(): array
    {
        return [
            [['user_id', 'type_id'], 'required'],
            [['user_id', 'type_id'], 'integer'],
            [['custom_text'], 'string', 'max' => self::NOTE_MAX_LENGTH],
            [['custom_text'], 'default', 'value' => null],
            [['type_id'], 'validateActiveType'],
        ];
    }

    /**
     * Ensures the selected status type exists and is not deleted.
     */
    public function validateActiveType($attribute): void
    {
        $exists = WorkingStatusType::find()
            ->where(['id' => $this->$attribute, 'is_deleted' => 0])
            ->exists();

        if (!$exists) {
            $this->addError($attribute, Yii::t('WorkingStatusModule.base', 'The selected status is not available.'));
        }
    }

    public function attributeLabels(): array
    {
        return [
            'type_id' => Yii::t('WorkingStatusModule.base', 'Status'),
            'custom_text' => Yii::t('WorkingStatusModule.base', 'Note'),
        ];
    }

    public function getType(): \yii\db\ActiveQuery
    {
        return $this->hasOne(WorkingStatusType::class, ['id' => 'type_id']);
    }

    public function getUser(): \yii\db\ActiveQuery
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
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
