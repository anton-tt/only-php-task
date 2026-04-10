<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
?>

<?= $arResult["FORM_HEADER"] ?>

<div class="contact-form">
    <div class="contact-form__head">
        <div class="contact-form__head-title">Связаться</div>
        <div class="contact-form__head-text">Наши сотрудники помогут выполнить подбор услуги и&nbsp;расчет цены с&nbsp;учетом
            ваших требований
        </div>
    </div>

    <div class="contact-form__form">
        <div class="contact-form__form-inputs">
            <?php foreach ($arResult["QUESTIONS"] as $question): ?>
                <?php
                $field = $question["STRUCTURE"][0];
                $type = $field["FIELD_TYPE"];
                $name = "form_text_" . $field["FIELD_ID"];
                $required = $question["REQUIRED"] === "Y" ? "required" : "";
                ?>

                <?php if ($type != "textarea"): ?>
                    <div class="input contact-form__input">
                        <label class="input__label">
                            <div class="input__label-text"><?= $question["CAPTION"] ?></div>
                            <?= $question["HTML_CODE"] ?>
                            <div class="input__notification">
                                <?php if ($type === "email"): ?>
                                    Неверный формат почты
                                <?php else: ?>
                                    Поле должно содержать не менее 3-х символов
                                <?php endif; ?>
                            </div>
                        </label>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>

        </div>

        <div class="contact-form__form-message">
            <?php foreach ($arResult["QUESTIONS"] as $question): ?>
                <?php if ($question["STRUCTURE"][0]["FIELD_TYPE"] == "textarea"): ?>
                    <div class="input contact-form__input">
                        <label class="input__label">
                            <div class="input__label-text"><?= $question["CAPTION"] ?></div>
                            <?= $question["HTML_CODE"] ?>
                            <div class="input__notification"></div>
                        </label>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <div class="contact-form__bottom">
            <div class="contact-form__bottom-policy">Нажимая &laquo;Отправить&raquo;, Вы&nbsp;подтверждаете, что
                ознакомлены, полностью согласны и&nbsp;принимаете условия &laquo;Согласия на&nbsp;обработку персональных
                данных&raquo;.
            </div>
            <button class="form-button contact-form__bottom-button" type="submit" name="web_form_submit"
                value="Y" data-success="Отправлено" data-error="Ошибка отправки">
                <div class="form-button__title">Оставить заявку</div>
            </button>
        </div>
    </div>

</div>

<?= $arResult["FORM_FOOTER"] ?>