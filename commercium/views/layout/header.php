<?php
use framework\components\base\Helpers;
use framework\components\base\Html;
use framework\components\base\SessionManagement;

/**
 * @var \framework\components\Controller $this
 */
?>
<!DOCTYPE html>
<html lang="<?= $layoutParams['language'] ?>">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Commercium: <?= $layoutParams['title'] ?></title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="//bootswatch.com/sandstone/bootstrap.min.css" rel="stylesheet"/>
    <?= Html::link('assets/css/style.css') ?>
    <?= Html::link('assets/images/favicon.png', 'icon') ?>
</head>

<body>
<header>
    <nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= Helpers::getUrl('') ?>">Commercium</a>
            </div>
            <?php if (SessionManagement::isLoggedIn()) { ?>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li><?= Html::a("/", "Home") ?></li>
                        <li><?= Html::a("portfolio", "Portfolio") ?></li>
                        <li><?= Html::a("transactions", "Transactions") ?></li>
                        <li class="active"><?= Html::a("users", "User managament") ?></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <?= Html::openForm('login/logout') ?>
                            <?= Html::a('users/edit?id=' . SessionManagement::getUser()->getPrimaryKey(), SessionManagement::getUser()->firstname, 'btn btn-info navbar-btn') ?>
                            <button type="submit" class="btn btn-danger navbar-btn"><i class="fa fa-power-off"></i> Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            <?php } ?>
        </div>
    </nav>
    <nav class="navbar navbar-default navbar-fixed-top" id="title-wrapper">
        <h1><?= $layoutParams['title'] ?></h1>
    </nav>
</header>
<main class="container">