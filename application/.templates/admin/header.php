<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <!-- Icons -->
    <link rel="apple-touch-icon" sizes="76x76" href="/">
    <link rel="icon" type="image/png" href="/assets/img/favicon.png"/>

    <!-- SEO -->
    <title></title>
    <meta name="description" content="<?//=$arParam['description']?>"/>
    <meta name="robots" content="noodp"/>
    <meta property="og:locale" content="ru_RU" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?//=$arParam['title']?>" />
    <meta property="og:description" content="<?//=$arParam['description']?>" />
    <meta property="og:url" content="http://sitename.com/" />
    <meta property="og:site_name" content="Название сайта" />

    <!-- CSS Files -->
    <link rel="stylesheet" href="/assets/js/libs/fancybox/fancybox.min.css" type='text/css' media='all' />
    <link rel="stylesheet" href="/assets/css/admin.min.css" type='text/css' media='all' />

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700|PT+Sans:400,700" rel="stylesheet">
</head>
<body class="body-content">
<?//include ('_icon.php');?>
<header>
    <?if($this->app->user_check('admin')):?>
        <div class="header">
            <div class="header__bg">
                <div class="container">
                    <div class="header__main">
                        <div class="header__menu">
                            <ul class="header__menu__list">
                                <li class="active"><a href="/admin/" title="Для Вас">Модули</a></li>
                                <li><a href="" title="Статьи">Настройки</a></li>
                                <li><a href="" title="">Обновление</a></li>
                            </ul>
                        </div>
                        <?if($this->app->user_check()):?>
                            <div class="header__user">
                                <a href=""><?=$this->app->user_get('name')?></a>
                                <i class="core__icon core__icon_restricted-user"></i>
                                <span> | </span>
                                <a href="/admin/user/exit/">Выход</a>
                            </div>
                        <?endif;?>
                    </div>
                </div>
            </div>
        </div>
    <?endif;?>
</header>
<div class="body-main" role="main">