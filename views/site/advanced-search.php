<?php

use yii\helpers\Url;

$this->title = 'Advanced Search';
?>

<div class="container-fluid max-width">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Advanced search</h3>
        </div>
        <div class="panel-body">

            <div class="inline" style="width: 250px">                
                    <select id="selected-category" style="width: 100%" >
                        <option></option>
                        <option>Human gene</option>
                        <option>Fly gene</option>
                    </select>                
            </div>
            <button type="button" id="add-rule" class="btn btn-default " >Add rule</button>            

        </div>

        <ul id="search-rules" class="list-group">

        </ul>

    </div>

    <form id="advanced-search-form" action="<?= Url::base(); ?>/search" method="get">
        <input type="hidden" id="search-query" name="searchQuery" value="abc">
        <button type="submit" id="advanced-search-submit" class="btn btn-info">Submit</button>        
    </form>

</div>
<script src="<?= Url::base(); ?>/js/advanced-search.js" ></script>