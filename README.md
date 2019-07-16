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
        <input type="text" name="NAME" placeholder="Имя" value="[[!+fi.NAME]]" required>
        <input type="email" name="EMAIL_HOME" placeholder="Email" value="[[!+fi.EMAIL_HOME]]" required>
		<textarea name="COMMENTS" placeholder="Message" required>[[!+fi.COMMENTS]]</textarea>

        <input name="submit" type="submit" value="Send">
    </fieldset>
</form>
```