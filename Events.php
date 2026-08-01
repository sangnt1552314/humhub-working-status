<?php

namespace humhub\modules\workingStatus;

use humhub\modules\ui\menu\MenuLink;
use humhub\modules\user\widgets\AccountTopMenu;
use humhub\modules\user\widgets\ProfileSidebar;
use humhub\modules\workingStatus\assets\OnlineStatusAsset;
use humhub\modules\workingStatus\widgets\ProfileStatus;
use humhub\widgets\bootstrap\Button;
use Yii;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\web\View;

class Events
{
    /**
     * Adds a "Working Status" entry to the account (avatar) dropdown menu that
     * opens the reusable status modal, and registers the presence-dot tinting
     * script for every authenticated page.
     */
    public static function onAccountTopMenuInit($event): void
    {
        if (Yii::$app->user->isGuest) {
            return;
        }

        // Register the script that tints online presence dots site-wide.
        $view = Yii::$app->view;
        OnlineStatusAsset::register($view);
        $view->registerJs(
            'window.workingStatusColorsUrl = ' . Json::encode(Url::to(['/working-status/status/colors'])) . ';',
            View::POS_BEGIN,
        );

        /* @var AccountTopMenu $menu */
        $menu = $event->sender;
        $url = Url::to(['/working-status/status/edit']);

        $menu->addEntry(new MenuLink([
            'id' => 'working-status-account-link',
            'link' => Button::asLink(Yii::t('WorkingStatusModule.base', 'Working Status'))
                ->icon('clock-o')
                ->action('ui.modal.load', $url),
            'sortOrder' => 250,
        ]));
    }

    /**
     * Injects the working status widget into the user profile sidebar.
     */
    public static function onProfileSidebarInit($event): void
    {
        $user = $event->sender->user ?? null;
        if ($user === null) {
            return;
        }

        $event->sender->addWidget(ProfileStatus::class, ['user' => $user], ['sortOrder' => 250]);
    }
}
