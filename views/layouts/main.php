<?php

use yii\helpers\Url;
use yii\helpers\Html;
//use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

$controllerId = \Yii::$app->controller->id;
$actionId = \Yii::$app->controller->action->id;
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-61462392-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());        
          gtag('config', 'UA-61462392-1');
        </script>
        <meta charset="<?= Yii::$app->charset ?>"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?= Html::csrfMetaTags() ?>
        <title><?= Html::encode($this->title) ?></title>

        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" >
<?php if($controllerId === "tables") :?>
        <link href="<?php echo Url::base(); ?>/css/smoothness/jquery-ui-1.10.4.custom.css" rel="stylesheet" type="text/css">        
        <link href="<?php echo Url::base(); ?>/css/ui.jqgrid.css" rel="stylesheet" type="text/css">
        <link href="<?php echo Url::base(); ?>/css/jqGrid.bootstrap.css" rel="stylesheet" type="text/css">
<?php endif; ?>
        <link href="<?php echo Url::base(); ?>/css/main.css" rel = "stylesheet" type="text/css" >
<?php if(!(($controllerId === "site" && $actionId !=="advanced-search") || $controllerId === "table")) :?>
        <link href="<?php echo Url::base(); ?>/css/select2.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo Url::base(); ?>/css/select2-bootstrap.css" rel="stylesheet" type="text/css"/>
<?php endif; ?>

        <script src="https://code.jquery.com/jquery-1.10.2.min.js" type="text/javascript"></script>
<?php if($controllerId === "tables") :?>
        <script src="<?php echo Url::base(); ?>/js/i18n/grid.locale-en.js" type="text/javascript"></script>
        <script src="<?php echo Url::base(); ?>/js/jquery.jqGrid.min.js" type="text/javascript"></script>
<?php endif; ?>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?= Url::base(); ?>/js/yii.js" type="text/javascript"></script>
<?php if(!(($controllerId === "site" && $actionId !=="advanced-search") || $controllerId === "table")) :?>
        <script src="<?php echo Url::base(); ?>/js/select2.min.js" type="text/javascript"></script>
<?php endif; ?>
        <script src="<?php echo Url::base(); ?>/js/main.js" type="text/javascript"></script>
<?php if ($controllerId === "site" && $actionId ==="about" && (Yii::$app->user->can('edit') || Yii::$app->user->can('manage'))) : ?>
        <script src="<?php echo Url::base(); ?>/js/ckeditor/ckeditor.js" type="text/javascript"></script>
<?php endif; ?>

        <link rel="shortcut icon" href="<?php echo Url::base(); ?>/images/SysID-favicon.ico">

    </head>
    <body>
        <?php $this->beginBody() ?>
<nav class="navbar navbar-default navbar-static-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header" id="main-logo">
                    <a href="<?php echo Url::base(); ?>/" class="navbar-brand"><img class="main-logo-image" src="<?php echo Url::base(); ?>/images/LogoDB.jpg" alt="SysID" >SysID database</a>
                </div>

                <form class="navbar-form navbar-left" id="search-form" role="search" action="<?php echo Url::base(); ?>/search" method="get">
                    <div class="form-group">
                        <input type="text" class="form-control" id="search-input" name="search" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-info">Submit</button>
                    <p class="search-description">Search by gene symbol, entrez id, fbgn or cg number (e.g. ABCD1)</p>
                </form>

                <ul class="nav navbar-nav navbar-right">
                <!--<li><a class="navigation-button" href="<?php echo Url::base(); ?>/advanced-search">Advanced search</a></li>-->
                    <li class="dropdown">
                        <a class="navigation-button dropdown-toggle" href="#" data-toggle="dropdown">Browse table <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a id="overview-link" href="<?php echo Url::base(); ?>/table/overview">Overview</a></li>
                            <li><a href="<?php echo Url::base(); ?>/table/human-gene-info">Human gene</a></li>
                            <li><a href="<?php echo Url::base(); ?>/table/fly-gene-info">Fly gene</a></li>
                            <li><a href="<?php echo Url::base(); ?>/table/disease-info">Disease info</a></li>
                            <li><a href="<?php echo Url::base(); ?>/table/orthology">Orthology</a></li>
                            <li><a href="<?php echo Url::base(); ?>/table/neuronal-screen">Neuronal screen</a></li>
                            <li><a href="<?php echo Url::base(); ?>/table/wing-screen">Wing screen</a></li>
                            <li><a href="<?php echo Url::base(); ?>/table/transcription-factor">Transcription factors</a></li>
			    <li><a href="<?= Url::base(); ?>/table/motif">Motifs</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a class="navigation-button dropdown-toggle" href="#" data-toggle="dropdown">About us <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo Url::base(); ?>/about#reference">Reference</a></li>
                            <li><a href="<?php echo Url::base(); ?>/about#citation-policy">Citation Policy & Credits</a></li>
                            <li><a href="<?php echo Url::base(); ?>/about#support">Support</a></li>
                            <li><a href="<?php echo Url::base(); ?>/about#news-updates">News/Updates</a></li>
                            <li><a href="<?php echo Url::base(); ?>/about#help">Help</a></li>
                        </ul>
                    </li>
                    <?php if (Yii::$app->user->can('edit')) : ?>
                    <li class="dropdown">
                        <a class="navigation-button dropdown-toggle" href="#" data-toggle="dropdown">Edit <b class="caret"></b></a>
                        <ul class="dropdown-menu">                            
                            <li><a href="<?= Url::base(); ?>/human-gene-edit">Human gene</a></li>
                            <li><a href="<?= Url::base(); ?>/gene-group-edit">Gene group</a></li>
                            <li><a href="<?= Url::base(); ?>/human-gene-disease-edit">Gene disease</a></li>
                            <li><a href="<?= Url::base(); ?>/disease-type-edit">Disease type</a></li>
                            <li><a href="<?= Url::base(); ?>/disease-subtype-edit">Disease subtype</a></li>
                            <li><a href="<?= Url::base(); ?>/fly-gene-edit">Fly gene</a></li>
                            <li><a href="<?= Url::base(); ?>/order-number-edit">Order number</a></li>
                            <li><a href="<?= Url::base(); ?>/stock-edit">Stock</a></li>
                            <li><a href="<?= Url::base(); ?>/cross-edit">Cross</a></li>
                            <li><a href="<?= Url::base(); ?>/orthology-manual-edit">Orthology</a></li>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if (Yii::$app->user->can('edit')) : ?>
                    <li class="dropdown">
                        <a class="navigation-button dropdown-toggle" href="#" data-toggle="dropdown">Admin <b class="caret"></b></a>
                        <ul class="dropdown-menu">                            
                            <li><a href="<?= Url::base(); ?>/admin">Admin</a></li>
                            <?php if (Yii::$app->user->can('manage')) : ?>
                            <li><a href="<?= Url::base(); ?>/users">User</a></li>
                            <?php endif; ?>
                        </ul>
                    </li>
                    <?php endif; ?>
                    <?php if (Yii::$app->user->isGuest) : ?>
                        <li><a class="navigation-button" href="<?php echo Url::base(); ?>/login">Login</a></li>
                    <?php else : ?>
                        <li><a class="navigation-button" href="<?php echo Url::base(); ?>/logout">Logout</a></li>
                    <?php endif; ?>

                </ul>
            </div>
        </nav>
        <?= $content ?>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
