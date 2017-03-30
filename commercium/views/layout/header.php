<?php
use framework\components\base\Helpers;
use framework\components\base\SessionManagement;

/**
 * @var \framework\components\Controller $this
 */
?>
<!DOCTYPE html>
<html lang="<?= $this->layoutParams['language'] ?>">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>Commercium: <?= $this->layoutParams['title'] ?></title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="//bootswatch.com/sandstone/bootstrap.min.css" rel="stylesheet"/>
    <link rel="icon" href="<?= Helpers::getUrl('assets/images/favicon.png') ?>"/>
</head>

<body>

<nav class="navbar navbar-inverse navbar-static-top">
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
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <form method="post" action="<?= Helpers::getUrl('login/logout') ?>">
                            <button type="submit" class="btn btn-danger navbar-btn"><i class="fa fa-power-off"></i> Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        <?php } ?>
    </div>
</nav>

<div class="container">