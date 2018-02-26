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
    <!-- MOBILE MENU -->
    <div class="core__menu-nav__mobile__alert">
        <!-- После адоптации - это меню откроется  -->
        <div class="core__menu-nav__mobile__alert__user">

        </div>
        <div class="core__menu-nav__mobile__alert__menu" data-core-name="Меню" data-js-core-resize-after="menu">
        </div>
    </div>
    <div class="core__menu-nav__mobile__button">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!-- END MOBILE MENU -->
    <div class="header">
        <div class="header__bg">
            <div class="container">
                <div class="header__main">
                    <div class="header__menu">
                        <ul class="header__menu__list">
                            <li class="active"><a href="" title="Для Вас">Модули</a></li>
                            <li><a href="" title="Каталог">Пользователи</a></li>
                            <li><a href="" title="Статьи">Настройки</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<div class="body-main" role="main">