# formitBitrix
Create leads in Bitrix24 from MODX FormIt

### Usage

```php
[[!FormIt?
    &hooks=`rest.php`
    &validate=`NAME:required:minLength=^2^,EMAIL_HOME:required:email,COMMENTS:required:minLength=^10^`
    &FormFields=`TITLE,NAME,EMAIL_HOME,COMMENTS`
    &successMessage=`<div class="uk-alert uk-alert-large">Ваша заявка принята!</div>`
    &submitVar=`submit`
    ]]
    [[!+fi.successMessage]]
<form class="uk-form uk-form-horizontal" id="contactForm" method="post" action="[[~[[*id]]]]">
<input type="hidden" name="TITLE" id="" value="Заявка">
    <fieldset>
        <legend>Отправить сообщение</legend>
        <div class="uk-form-row">
		<input type="text" name="NAME" placeholder="Имя" class=" uk-width-1-1 uk-form-large[[!+fi.error.NAME:notempty=` uk-form-danger`]]" value="[[!+fi.NAME]]" required>
		[[!+fi.error.NAME:notempty=`<p class="uk-text-danger uk-text-bold">Поле должно содержать не менее 2 символов</p>`]]
		</div>

        <div class="uk-form-row">
		<input type="email" name="EMAIL_HOME" placeholder="Email" class=" uk-width-1-1 uk-form-large[[!+fi.error.EMAIL_HOME:notempty=` uk-form-danger`]]" value="[[!+fi.EMAIL_HOME]]" required>
		</div>
		[[!+fi.error.EMAIL_HOME:notempty=`<p class="uk-text-danger uk-text-bold">Укажите ваш Email</p>`]]
		<div class="uk-form-row">
		<textarea  name="COMMENTS" cols="30" rows="6" placeholder="Сообщение" class=" uk-width-1-1 uk-form-large[[!+fi.error.COMMENTS:notempty=` uk-form-danger`]]" required>[[!+fi.COMMENTS]]</textarea>
		[[!+fi.error.COMMENTS:notempty=`<p class="uk-text-danger uk-text-bold">Поле должно содержать не менее 10 символов</p>`]]
		</div>

		<div class="uk-form-row"><input class="uk-button uk-button-large uk-button-primary" name="submit" type="submit" value="Отправить сообщение »"></div>
    </fieldset>
</form>
```