<?php

use humhub\modules\workingStatus\widgets\ConfigMenu;

?>

<div class="panel panel-default">
    <div class="panel-heading"><strong>Working Status</strong> configuration</div>

    <?= ConfigMenu::widget() ?>   <!-- same widget, different tab is active -->

    <div class="panel-body">
        <!-- content for "Create Status" tab -->
    </div>
</div>