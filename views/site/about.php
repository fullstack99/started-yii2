<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
$this->registerMetaTag(['name' => 'keywords', 'content' => 'yii, developing, views, meta, tags']);
$this->registerMetaTag(['name' => 'description', 'content' => 'This is the description of this page!'], 'description');
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is the About page. You may modify the following file to customize its content:
        Current Time <?= $date ?>
    </p>

    <code><?= __FILE__ ?></code>
</div>
