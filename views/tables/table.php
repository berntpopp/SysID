<?php

use yii\helpers\Url;

$this->title = \Yii::$app->id . " - $tableName";
?>  
        <div id="query-table" class="container-fluid">
            <table id="t-<?php echo $tableName ?>"></table>
            <div id="pager-t-<?php echo $tableName ?>"></div>
        </div>

    <script src="<?php echo Url::base(); ?>/js/table.js"></script>
    <script src="<?php echo Url::base(); ?>/js/tables/t-<?php echo $tableName ?>.js" type="text/javascript"></script>