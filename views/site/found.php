<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */

$this->title = "Поиск кандидата по участку";
?>

<section>
    <div class="container">
        <div class="row">
            <div class="col">
                <a class="top__logo" href="<?= Url::home() ?>">
                    <?= Html::img('@web/images/logo.png', ['alt' => 'Разумное голосование']) ?>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <h1>Поиск кандидата</h1>
                <pre><?= print_r($three, true) ?></pre>
            </div>
        </div>
    </div>
</section>
