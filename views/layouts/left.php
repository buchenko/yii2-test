<?php
/* @var $directoryAsset string */

if (Yii::$app->user->isGuest){
    $items = [['label' => 'Login', 'url' => ['site/login'],]];
} else {
    $items = [
        ['label' => 'Shops', 'icon' => 'file-code-o', 'url' => ['/shop'],],
        ['label' => 'Categories', 'icon' => 'dashboard', 'url' => ['/category'],],
        ['label' => 'Products', 'icon' => 'dashboard', 'url' => ['/product'],],
    ];
}

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => $items,
            ]
        ) ?>

    </section>

</aside>
