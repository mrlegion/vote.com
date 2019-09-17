<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\View;

/* @var $this View */

$this->title = "Регистрация в разумном голосовании"
?>

<section class="top">
    <div class="container">
        <div class="row">
            <div class="col"><a class="top__logo" href="<?= Url::home() ?>"><?= Html::img('@web/images/logo.png', ['alt' => 'Разумное голосование']) ?></a></div>
        </div>
    </div>
</section>
<section class="registration">
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h1 class="registration__title">Зарегистрируйтесь</h1>
                <p class="registration__text">
                    Чтобы знать, кто будет самым сильным депутатом на вашем участке, нам нужен ваш точный адрес регистрации. Оставьте его, и перед выборами мы пришлем вам рекомендации, за кого проголосовать, чтобы ваш голос действительно на что-то повлиял.</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 col offset-md-2">
                <form class="form registration-form">
                    <div class="row">
                        <div class="col">
                            <input class="form__input" type="email" placeholder="E-mail *"/>
                        </div>
                        <div class="col">
                            <input class="form__input" type="phone" placeholder="Номер телефона *"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input class="form__input" type="text" placeholder="Регион"/>
                        </div>
                        <div class="col">
                            <input class="form__input" type="text" placeholder="Населенный пункт"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input class="form__input" type="text" placeholder="Улица"/>
                        </div>
                        <div class="col">
                            <input class="form__input" type="text" placeholder="Дом"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12"><span class="form__title">Ваш возраст (для нашей статистики):</span></div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <input id="g1" type="radio" name="age"/>
                                <label for="g1">Меньше 18</label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <input id="g2" type="radio" name="age"/>
                                <label for="g2">18-24</label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <input id="g3" type="radio" name="age"/>
                                <label for="g3">25-29</label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <input id="g4" type="radio" name="age"/>
                                <label for="g4">30-39</label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <input id="g5" type="radio" name="age"/>
                                <label for="g5">40-49</label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <input id="g6" type="radio" name="age"/>
                                <label for="g6">50-59</label>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <input id="g7" type="radio" name="age"/>
                                <label for="g7">60+</label>
                            </div>
                        </div>
                    </div>
                    <hr class="form__line"/>
                    <div class="row">
                        <div class="col-12"><span class="form__title">Знаете ли Вы своего депутата? Если да, то напишите, кто он:</span></div>
                        <div class="col-12">
                            <textarea class="form__textarea" row="5" name="description" placeholder="Некое описание депутата во всех красках"></textarea>
                        </div>
                    </div>
                    <div class="row mt-20">
                        <div class="col-12"><span class="form__title">Как Вы оцениваете его работу по шкале от 1 до 10, где 1 - совсем не устраивает, а 10 - все устраивает</span></div>
                        <div class="col-12 registration-form__rating">
                            <div class="form-group">
                                <input id="gr1" type="radio" name="rating"/>
                                <label for="gr1">1</label>
                            </div>
                            <div class="form-group">
                                <input id="gr2" type="radio" name="rating"/>
                                <label for="gr2">2</label>
                            </div>
                            <div class="form-group">
                                <input id="gr3" type="radio" name="rating"/>
                                <label for="gr3">3</label>
                            </div>
                            <div class="form-group">
                                <input id="gr4" type="radio" name="rating"/>
                                <label for="gr4">4</label>
                            </div>
                            <div class="form-group">
                                <input id="gr5" type="radio" name="rating"/>
                                <label for="gr5">5</label>
                            </div>
                            <div class="form-group">
                                <input id="gr6" type="radio" name="rating"/>
                                <label for="gr6">6</label>
                            </div>
                            <div class="form-group">
                                <input id="gr7" type="radio" name="rating"/>
                                <label for="gr7">7</label>
                            </div>
                            <div class="form-group">
                                <input id="gr8" type="radio" name="rating"/>
                                <label for="gr8">8</label>
                            </div>
                            <div class="form-group">
                                <input id="gr9" type="radio" name="rating"/>
                                <label for="gr9">9</label>
                            </div>
                            <div class="form-group">
                                <input id="gr10" type="radio" name="rating"/>
                                <label for="gr10">10</label>
                            </div>
                        </div>
                    </div>
                    <hr class="form__line"/>
                    <div class="row mt-20 mb-20">
                        <div class="col-12">
                            <div class="form-group">
                                <label class="form__checkbox" for="team_and_policy">
                                    <input id="team_and_policy" type="checkbox" name="team_and_policy"/>
                                    <div class="form__checkbox--custom"></div><span>
                        Я даю согласие на обработку моих персональных данных в объеме и на условиях, определенных <a href="#">Положением</a> и <a href="#">офертой</a></span>
                                </label>
                            </div>
                        </div>
                    </div><a class="button button--red mr-20 mt-20" href="veritify.html">Зарегистрироваться</a><a class="button button--outline mt-20" href="index.html">Отмена</a>
                </form>
            </div>
        </div>
    </div>
</section>
