<!--section-start::target-->
<h2><!--LANG::target_title--></h2>
<p><!--LANG::target_info--></p>
<!--IF::target_error-->
<p class="error">
    <b><!--LANG::target_error_title--></b><br>
    <!--LANG::target_error_text-->
</p>
<!--ENDIF-->
<!--IF::target_prefill-->
<p class="info">
    <b><!--LANG::target_prefill_title--></b><br>
    <!--LANG::target_prefill_info-->
</p>
<!--ENDIF-->
<!--IF::installation-->
<p class="success">
    <b><!--LANG::target_installation_title--></b><br>
    <!--LANG::target_installation_text-->
</p>
<!--ENDIF-->
<!--IF::update-->
<p class="success">
    <b><!--LANG::target_update_title--></b><br>
    <!--LANG::target_update_text-->
</p>
<!--ENDIF-->
<form method="post" action="?step=target">
    <input type="hidden" name="set_target" value="1">
    <p class="list aligned <!--IF::target_error-->error<!--ENDIF-->"><label class="l150" for="target_path"><!--LANG::target_path_label-->:</label><input type="text" name="target_path" id="target_path" value="<!--TEXT::target_path-->" size="50"></p>
    <p class="space attop <!--IF::target_path-->button-line center<!--ENDIF-->">
        <!--IF::target_path-->
        <a class="button green atleft" href="?step=requirements">&raquo; <!--IF::update--><!--LANG::start_update--><!--ELSE--><!--LANG::start_installation--><!--ENDIF--></a>
        <span><!--LANG::or--></span>
        <button class="button white atright" type="submit">&raquo; <!--LANG::target_check_path_again--></button>
        <!--ELSE-->
        <button class="button white" type="submit">&raquo; <!--LANG::target_check_path--></button>
        <!--ENDIF-->
    </p>
</form>
<!--section-end::target-->

