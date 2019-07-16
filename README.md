# formitBitrix
Create leads in Bitrix24 from MODX FormIt

### Usage

```php
[[!FormIt?
    &hooks=`rest.php`
    &validate=`NAME:required,EMAIL_HOME:required:email,COMMENTS:required`
    &FormFields=`TITLE,NAME,EMAIL_HOME,COMMENTS`
    &submitVar=`submit`
]]

<form method="post" action="[[~[[*id]]]]">
<input type="hidden" name="TITLE" id="" value="Lead title">
    <fieldset>
        <legend>Send message</legend>
        <div class="form-group">
            <input type="text" name="NAME" placeholder="Имя" value="[[!+fi.NAME]]" required>
		</div>

        <div class="form-group">
            <input type="email" name="EMAIL_HOME" placeholder="Email" value="[[!+fi.EMAIL_HOME]]" required>
		</div>
        <div class="form-group">
            <textarea name="COMMENTS" placeholder="Message" required>[[!+fi.COMMENTS]]</textarea>
            [[!+fi.error.COMMENTS:notempty=`<p class="uk-text-danger uk-text-bold">Поле должно содержать не менее 10 символов</p>`]]
		</div>

        <div class="form-group">
            <input name="submit" type="submit" value="Send">
        </div>
    </fieldset>
</form>
```