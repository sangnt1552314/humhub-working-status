<?php

use humhub\modules\workingStatus\widgets\ConfigMenu;

?>

<div class="panel panel-default">
    <div class="panel-heading"><strong>Working Status</strong> configuration</div>

    <?= ConfigMenu::widget() ?>   <!-- renders the tab bar -->

    <div class="panel-body">
        <!-- content for "Status Types" tab -->
    </div>
</div>