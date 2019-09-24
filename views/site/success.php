<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var View $this */
/* @var string $email */

?>

<section class="top">
    <div class="container">
        <div class="row">
            <div class="col"><a class="top__logo"
                                href="<?= Url::home() ?>"><?= Html::img('@web/images/logo.png', ['alt' => 'Разумное голосование']) ?></a>
            </div>
        </div>
    </div>
</section>
<section class="mt-20">
    <div class="container">
        <div class="veritify-block">
            <div class="veritify-block__image"></div>
            <h1 class="veritify-block__title">Подтвердите почту</h1>
            <p class="veritify-block__text">
                Вам на почту <b>(<?= $email ?>)</b> отправлено письмо со ссылкой. <br>Пройдите по ней, чтобы подтвердить свою почту.</p>
            <?= Html::a(Yii::t('app', 'Repeating send'), ['site/register-success'], ['class' => 'button button--outline button--outline_red veritify-block__button']) ?>
        </div>
    </div>
</section>
