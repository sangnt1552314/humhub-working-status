<?php
namespace humhub\modules\workingStatus\widgets;

use humhub\widgets\SettingsTabs;
use Yii;

class ConfigMenu extends SettingsTabs
{
    public function init(): void
    {
        $this->items = [
            [
                'label' => Yii::t('WorkingStatusModule.base', 'Status Types'),
                'url' => ['/working-status/config/index'],
                'active' => $this->isCurrentRoute('working-status', 'config', 'index'),
                'sortOrder' => 10,
            ],
            [
                'label' => Yii::t('WorkingStatusModule.base', 'Create Status'),
                'url' => ['/working-status/config/create'],
                'active' => $this->isCurrentRoute('working-status', 'config', 'create'),
                'sortOrder' => 20,
            ],
        ];
        parent::init();
    }
}