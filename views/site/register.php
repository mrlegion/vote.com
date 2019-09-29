<?php

use app\models\RegisterForm;
use app\models\User;
use app\models\Vote;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\MaskedInput;

/* @var $this View */
/* @var $model RegisterForm */

$this->title = "Регистрация в разумном голосовании"
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

<?php if (Yii::$app->session->hasFlash('error')) : ?>
<section class="alert">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="alert-block alert-danger">
                    <h2><?= Yii::t('app', 'Error on registration') ?></h2>
                    <p><?= Yii::$app->session->getFlash('error') ?></p>
                </div>
            </div>
        </div>
    </div>

</section>
<?php endif; ?>

<section class="registration">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1 class="registration__title"><?= Yii::t('app', 'Sign up') ?></h1>
                <p class="registration__text">
                    Чтобы знать, кто будет самым сильным депутатом на вашем участке, нам нужен ваш точный адрес
                    регистрации. Оставьте его, и перед выборами мы пришлем вам рекомендации, за кого проголосовать,
                    чтобы ваш голос действительно на что-то повлиял.</p>
            </div>
        </div>
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-md-8 col offset-md-2">
                <form class="form registration-form">
                    <div class="row">
                        <div class="col">
                            <?= $form->field($model, 'email')->widget(MaskedInput::class, [
                                'name' => 'email',
                                'clientOptions' => [
                                    'alias' => 'email',
                                ],
                                'options' => [
                                    'placeholder' => Yii::t('app', 'Email'),
                                    'class' => 'form__input',
                                ],
                            ])->label(false) ?>
                        </div>
                        <div class="col">
                            <?= $form->field($model, 'phone')->widget(MaskedInput::class, [
                                'mask' => '+7 (999) 99-99-999',
                                'name' => 'phone',
                                'options' => [
                                    'placeholder' => Yii::t('app', 'Phone'),
                                    'class' => 'form__input',
                                ],
                            ])->label(false) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <?= $form->field($model, 'state')->textInput([
                                'class' => 'form__input',
                                'id' => 'region',
                                'placeholder' => Yii::t('app', 'State')
                            ])->label(false) ?>
                        </div>
                        <div class="col">
                            <?= $form->field($model, 'city')->textInput([
                                'class' => 'form__input',
                                'id' => 'city',
                                'placeholder' => Yii::t('app', 'City')
                            ])->label(false) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <?= $form->field($model, 'street')->textInput([
                                'class' => 'form__input',
                                'id' => 'street',
                                'placeholder' => Yii::t('app', 'Street')
                            ])->label(false) ?>
                        </div>
                        <div class="col">
                            <?= $form->field($model, 'home')->textInput([
                                'class' => 'form__input',
                                'id' => 'home',
                                'placeholder' => Yii::t('app', 'Home')
                            ])->label(false) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12"><span class="form__title">Ваш возраст (для нашей статистики):</span></div>
                        <?= $form->field($model, 'age', ['options' => ['class' => 'container']])->radioList(User::AGES, [
                            'class' => 'row',
                            'item' => function ($index, $label, $name, $checked, $value) {
                                $html = <<<HTML
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <input id="age_$index" type="radio" name="$name" value="$value"/>
                                                <label for="age_$index">$label</label>
                                            </div>
                                        </div>
HTML;
                                return $html;
                            }])->label(false) ?>

                    </div>
                    <hr class="form__line"/>
                    <div class="row">
                        <div class="col-12"><span
                                    class="form__title"><?= Yii::t('app', 'Do you know your deputy? If yes, then write who he is:') ?></span>
                        </div>
                        <div class="col-12">
                            <?= $form->field($model, 'text')->textarea([
                                'class' => 'form__textarea',
                                'row' => '5',
                                'placeholder' => Yii::t('app','A certain description of the deputy in all colors'),
                            ])->label(false) ?>
                        </div>
                    </div>
                    <div class="row mt-20">
                        <div class="col-12"><span class="form__title">Как Вы оцениваете его работу по шкале от 1 до 10, где 1 - совсем не устраивает, а 10 - все устраивает</span>
                        </div>
                        <?= $form->field($model, 'ratio', ['options' => ['class' => 'col-12 ']])->radioList(Vote::RATING_VALUES, [
                            'class' => 'registration-form__rating',
                            'item' => function ($index, $label, $name, $checked, $value) {
                                $html = <<<HTML
                                        <div class="form-group">
                                            <input id="r_$index" type="radio" name="$name" value="$value"/>
                                            <label for="r_$index">$label</label>
                                        </div>
HTML;
                                return $html;
                            }])->label(false) ?>
                    </div>
                    <hr class="form__line"/>
                    <div class="row mt-20 mb-20">
                        <div class="col-12">
                            <div class="form-group">
                                <?= $form->field($model, 'accept', [
                                    'template' => '<label class="form__checkbox" for="team_and_policy">
                                        {input}
                                        <div class="form__checkbox--custom"></div>
                                        <span>Я даю согласие на обработку моих персональных данных в объеме и на условиях, определенных
                                        <a href="#">Положением</a> и <a href="#">офертой</a></span>
                                        </label>
                                        <div>{error}</div>'
                                ])->checkbox([
                                    'label' => false,
                                    'value' => 0,
                                    'unchecked' => 0,
                                    'checked' => $model->accept ? true : false,
                                    'id' => 'team_and_policy',
                                ]) ?>
                                <!--<label class="form__checkbox" for="team_and_policy">
                                    <input id="team_and_policy" type="checkbox" name="RegisterForm[accept]"/>
                                    <div class="form__checkbox--custom"></div>
                                    <span>
                                        Я даю согласие на обработку моих персональных данных в объеме и на условиях, определенных
                                        <a href="#">Положением</a> и <a href="#">офертой</a>
                                    </span>
                                </label>-->
                            </div>
                        </div>
                    </div>
                    <?= Html::submitButton(Yii::t('app', 'Sign up'), ['class' => 'button button--red mr-20 mt-20']) ?>
                    <?= Html::a(Yii::t('app', 'Cancel'), Url::home(), ['class' => 'button button--outline mt-20']) ?>
                </form>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</section>

<?php
$js = <<<JS
let policy = document.querySelector('#team_and_policy[type="checkbox"]');
if (policy) {
    policy.addEventListener('change', function() {
        this.value = (Number(this.checked));
    });
}
JS;
$this->registerJs($js, View::POS_READY);
?>
