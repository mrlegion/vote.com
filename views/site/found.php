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
            </div>
            <div class="col">
                <p>
                    По вашему адресу: <b><?= $model['region'] ?>, <?= $model['city'] ?>, <?= $model['street'] ?>, <?= $model['home'] ?></b> не найдено ни одного кандидата!
                </p>
            </div>
        </div>
        <div class="row mt-20">
            <div class="col">
                <?= Html::a('Вернуться на главную', 'index', ['class' => 'button button--outline button--outline_red']) ?>
            </div>
        </div>
    </div>
</section>
