<?php

namespace humhub\modules\workingStatus\services;

use humhub\modules\user\models\User;
use humhub\modules\workingStatus\models\WorkingStatusType;
use humhub\modules\workingStatus\models\WorkingStatusUser;
use yii\base\Component;

class WorkingStatusService extends Component
{
    /**
     * Returns all active status types ordered by the admin-defined sort order.
     *
     * @return WorkingStatusType[]
     */
    public function getActiveTypes(): array
    {
        return WorkingStatusType::find()
            ->where(['is_deleted' => 0])
            ->orderBy(['sort_order' => SORT_ASC])
            ->all();
    }

    /**
     * @deprecated use getActiveTypes(), kept for the admin config views.
     * @return WorkingStatusType[]
     */
    public function getAllWorkingStatusTypes(): array
    {
        return $this->getActiveTypes();
    }

    /**
     * Returns active types as [id => name] for dropdown lists.
     */
    public function getActiveTypeOptions(): array
    {
        $options = [];
        foreach ($this->getActiveTypes() as $type) {
            $options[$type->id] = $type->name;
        }
        return $options;
    }

    /**
     * Returns the current working status of the given user, if any.
     */
    public function findUserStatus(int $userId): ?WorkingStatusUser
    {
        return WorkingStatusUser::findOne(['user_id' => $userId]);
    }

    /**
     * Loads the current status record for a user or creates a fresh one.
     */
    public function getOrCreateUserStatus(User $user): WorkingStatusUser
    {
        $status = $this->findUserStatus($user->id);
        if ($status === null) {
            $status = new WorkingStatusUser();
            $status->user_id = $user->id;
        }
        return $status;
    }

    /**
     * Returns a map of [contentcontainer_id => color] for every user that has
     * an active working status set. Used to tint the online presence dots.
     */
    public function getContainerColorMap(): array
    {
        $rows = (new \yii\db\Query())
            ->select(['u.contentcontainer_id', 't.color'])
            ->from(WorkingStatusUser::tableName() . ' su')
            ->innerJoin('user u', 'u.id = su.user_id')
            ->innerJoin(WorkingStatusType::tableName() . ' t', 't.id = su.type_id AND t.is_deleted = 0')
            ->all();

        $map = [];
        foreach ($rows as $row) {
            if (!empty($row['contentcontainer_id'])) {
                $map[(int) $row['contentcontainer_id']] = $row['color'];
            }
        }
        return $map;
    }
}
