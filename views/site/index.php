<?php

use app\models\FoundForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model FoundForm */
$this->title = "Разумное голосование! Голосуй с умом!"
?>

<section class="header">
    <div class="container">
        <div class="row">
            <div class="col">
                <a class="top__logo" href="<?= Url::home() ?>">
                    <?= Html::img('@web/images/logo.png', ['alt' => 'Разумное голосование']) ?>
                </a>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 col-12">
                <h1 class="header__title">Разумное голосование</h1>
                <h2 class="header__undertitle">Крупнейшее объединение избирателей</h2>
                <p class="header__text">
                    Голосует разумно за тех, кто реально будет работать на нас, а не забивать свои карманы <br><br>За
                    несколько дней до выборов программа пришлет вам имя кандидата,
                    которого нужно поддержать. Это будет лучший выбор из всех возможных, сделанный на основе
                    многофакторного анализа.
                </p>
                <?= Html::a('Зарегистрироваться', 'site/register', ['class' => 'button button--blue button--lg header__button']) ?>
            </div>
        </div>
    </div>
</section>


<section class="found section">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="found__image"></div>
            </div>
            <div class="col-lg-8 found-content">
                <h1 class="found__title">Найдите своего кандидата</h1>
                <p class="found__text">
                    Чтобы дать вам рекомендацию, за кого голосовать, нам нужно узнать ваш округ.<br> Для этого укажите,
                    пожалуйста, свой адрес регистрации.</p>
                <?php $form = ActiveForm::begin() ?>
                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'region')->textInput(['class' => 'form__input', 'placeholder' => $model->getAttributeLabel('region')])->label(false) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'city')->textInput(['class' => 'form__input', 'placeholder' => $model->getAttributeLabel('city')])->label(false) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <?= $form->field($model, 'street')->textInput(['class' => 'form__input', 'placeholder' => $model->getAttributeLabel('street')])->label(false) ?>
                        </div>
                        <div class="col-sm-6">
                            <?= $form->field($model, 'home')->textInput(['class' => 'form__input', 'placeholder' => $model->getAttributeLabel('home')])->label(false) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <?= Html::submitButton('Найти', ['class' => 'button button--red form__button']) ?>
                        </div>
                    </div>
                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</section>
<section class="footer section">
    <div class="container">
        <div class="row">
            <div class="col"><?= Html::img('@web/images/logo-invert.png', ['alt' => 'Разумное голосование']) ?></div>
        </div>
    </div>
</section>