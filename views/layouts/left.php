<?php

use app\models\Menu;
use yii\helpers\ArrayHelper;
?>
<aside class="main-sidebar">
    <section class="sidebar">
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= \Yii::getAlias('@web/uploads/module-free.gif') ?>" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p><?= \Yii::$app->user->identity->username??''; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..." />
                <span class="input-group-btn">
                    <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                    </button>
                </span>
            </div>
        </form>
        <?php
        $menu[] = Yii::$app->user->isGuest ? (['label' => 'Login', 'url' => ['/site/login'], 'icon' => 'glyphicon glyphicon-log-in']
        ) : (['label' => 'Logout', 'url' => ['/site/logout'], 'icon' => 'glyphicon glyphicon-log-out', 'options' => ['data-method' => 'post']]
        );
        dmstr\widgets\Menu::$iconClassPrefix='';
        ?>
        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                //'iconClassPrefix' => '', //default fa fa-
                'items' => (!Yii::$app->user->isGuest) ? ArrayHelper::merge(Menu::getMenu(), $menu) : $menu
            ]
        ) ?>
    </section>
</aside>