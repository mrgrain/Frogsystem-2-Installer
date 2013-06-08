<!--section-start::sqlconnection-->
<h2><!--LANG::sql_connection_title--></h2>
<p><!--LANG::sql_connection_info--></p>
<!--IF::sql_error-->
<p class="error">
    <b><!--LANG::sql_connection_error_title--></b><br>
    <!--TEXT::sql_connection_error-->
</p>
<!--ENDIF-->
<!--IF::sql_prefill-->
<p class="info">
    <b><!--LANG::sql_prefill_info_title--></b><br>
    <!--LANG::sql_prefill_info-->
</p>
<!--ENDIF-->
<form name="db_connection" method="post" action="?step=database">
    <input type="hidden" name="db_from_form" value="1">
    <p class="list aligned <!--IF::sql_host_error-->error<!--ENDIF-->"><label class="l150" for="db_host"><!--LANG::sql_host_label-->:</label><input type="text" name="db_host" id="db_host" value="<!--TEXT::sql_host-->" size="30"></p>
    <p class="list aligned <!--IF::sql_database_error-->error<!--ENDIF-->"><label class="l150" for="db_data"><!--LANG::sql_database_label-->:</label><input type="text" name="db_data" id="db_data" value="<!--TEXT::sql_data-->" size="30"></p>
    <p class="list aligned <!--IF::sql_userpw_error-->error<!--ENDIF-->"><label class="l150" for="db_user"><!--LANG::sql_user_label-->:</label><input type="text" name="db_user" id="db_user" value="<!--TEXT::sql_user-->" size="30"></p>
    <p class="list aligned <!--IF::sql_userpw_error-->error<!--ENDIF-->"><label class="l150" for="db_pass"><!--LANG::sql_password_label-->:</label><input type="text" name="db_pass" id="db_pass" value="<!--TEXT::sql_pass-->" size="30"></p>
    <p class="space attop"><!--LANG::sql_table_prefix_info--></p>
    <p class="list aligned <!--IF::sql_prefix_error-->error<!--ENDIF-->"><label class="l150" for="db_pref"><!--LANG::sql_prefix_label-->:</label><input type="text" name="db_pref" id="db_pref" value="<!--TEXT::sql_pref-->" size="30"></p>
    <p class="space attop"><button class="button green" type="submit">&raquo; <!--LANG::sql_check_connection_button--></button></p>
</form>
<!--section-end::sqlconnection-->

<!--section-start::sqlinstructions_info-->
<h2><!--LANG::sql_instructions_title--></h2>
<p><!--LANG::sql_instructions_info--></p>
<ul>
<!--TEXT::instruction_list-->
</ul>
<p class="space attop"><a class="button green" href="<!--TEXT::url-->">&raquo; <!--LANG::sql_start_instructions_button--></a></p>
<p class="small">(<a href="?step=database&amp;reset"><!--LANG::sql_change_connection--></a>)</p>
<!--section-end::sqlinstructions_info-->

<!--section-start::sqlinstructions_info_element-->
    <li><!--TEXT::instruction--></li>
<!--section-end::sqlinstructions_info_element-->
