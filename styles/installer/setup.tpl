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

