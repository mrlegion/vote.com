<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */

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
        <div class="success-block">
            <div class="success-block__image"></div>
            <h1 class="success-block__title"><?=Yii::t('app','Thank you!<br> Your mail has been confirmed.')?></h1>
            <p class="success-block__text"><?=Yii::t('app','Thank you for successfully confirming the mail and joining the "Reasonable Voting".<br>At the right time, we will write you which candidate is worth voting for.')?></p>
            <?= Html::a(Yii::t('app','Return to site'), Url::home(), ['class' => 'button button--outline button--outline_blue success-block__button']) ?>
        </div>
    </div>
</section>
