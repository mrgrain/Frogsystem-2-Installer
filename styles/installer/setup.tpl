<!--section-start::superadmin-->
<h2><!--LANG::superadmin_title--></h2>
<p><!--LANG::superadmin_info--></p>
<!--IF::form_error-->
<p class="error">
    <b><!--LANG::superadmin_form_error_title--></b><br>
    <!--TEXT::superadmin_form_error-->
</p>
<!--ENDIF-->
<form method="post" action="?step=setup">
    <input type="hidden" name="setup_admin" value="1">
    <p class="list aligned <!--IF::user_error-->error<!--ENDIF-->"><label class="l150" for="user"><!--LANG::setup_admin_username_label-->:</label><input type="text" name="user" id="user" value="<!--TEXT::user-->" size="30"></p>
    <p class="list aligned <!--IF::pass_error-->error<!--ENDIF-->"><label class="l150" for="pass"><!--LANG::setup_admin_password_label-->:</label><input type="password" name="pass" id="pass" value="<!--TEXT::pass-->" size="30"></p>
    <p class="list aligned space attop <!--IF::mail_error-->error<!--ENDIF-->"><label class="l150" for="mail"><!--LANG::setup_admin_mail_label-->:</label><input type="text" name="mail" id="mail" value="<!--TEXT::mail-->" size="30"></p>
    
    <p class="space attop">
        <button type="submit" class="button green">&raquo; <!--LANG::setup_save_superadmin--></button>
    </p>
</form>
<!--section-end::superadmin-->

<!--section-start::settings-->
<h2><!--LANG::settings_title--></h2>
<p><!--LANG::settings_info--></p>
<!--IF::form_error-->
<p class="error">
    <b><!--LANG::settings_form_error_title--></b><br>
    <!--TEXT::settings_form_error-->
</p>
<!--ENDIF-->
<form method="post" action="?step=setup">
    <input type="hidden" name="minimal_settings" value="1">
    <p class="list aligned <!--IF::title_error-->error<!--ENDIF-->">
        <label class="l150" for="title"><!--LANG::settings_title_label-->:</label>
        <input type="text" name="title" id="title" value="<!--TEXT::title-->" size="30">
    </p>
    <p class="list aligned <!--IF::url_error-->error<!--ENDIF-->">
        <label class="l150" for="url"><!--LANG::settings_url_label-->:</label>
        <select name="protocol" id="protocol">
            <option value="http://" <!--IF::protocol_http-->selected<!--ENDIF-->>http://</option>
            <option value="https://" <!--IF::protocol_https-->selected<!--ENDIF-->>https://</option>
        </select>
        <input type="text" name="url" id="url" value="<!--TEXT::url-->" size="30">
    </p>
    <p class="list aligned <!--IF::admin_mail_error-->error<!--ENDIF-->">
        <label class="l150" for="admin_mail"><!--LANG::settings_admin_mail_label-->:</label>
        <input type="text" name="admin_mail" id="admin_mail" value="<!--TEXT::admin_mail-->" size="30">
    </p>    
    <p class="list aligned <!--IF::url_style_error-->error<!--ENDIF-->">
        <label class="l150" for="url_style"><!--LANG::settings_url_style_label-->:</label>
        <select name="url_style" id="url_style">
            <option value="default" <!--IF::url_style_default-->selected<!--ENDIF-->><!--LANG::settings_url_style_default--></option>
            <option value="seo" <!--IF::url_style_seo-->selected<!--ENDIF-->><!--LANG::settings_url_style_seo--></option>
        </select><br>
        <label class="l150">&nbsp;</label>
        <span class="small"><!--LANG::settings_url_style_info--></span>
    </p>
    <p class="list aligned <!--IF::timezone_error-->error<!--ENDIF-->">
        <label class="l150" for="timezone"><!--LANG::settings_timezone_label-->:</label>
        <select name="timezone" id="timezone">
            <!--TEXT::timezones-->
        </select>
    </p>
    
    <p class="space attop">
        <button type="submit" class="button green">&raquo; <!--LANG::setup_save_settings--></button>
    </p>
</form>
<!--section-end::settings-->

