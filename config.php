<?php

use humhub\modules\user\widgets\AccountTopMenu;
use humhub\modules\user\widgets\ProfileSidebar;
use humhub\modules\workingStatus\Events;

return [
    'id' => 'working-status',
    'class' => 'humhub\modules\workingStatus\Module',
    'namespace' => 'humhub\modules\workingStatus',
    'events' => [
        ['class' => AccountTopMenu::class, 'event' => AccountTopMenu::EVENT_INIT, 'callback' => [Events::class, 'onAccountTopMenuInit']],
        ['class' => ProfileSidebar::class, 'event' => ProfileSidebar::EVENT_INIT, 'callback' => [Events::class, 'onProfileSidebarInit']],
    ],
];