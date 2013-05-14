<!--section-start::sqlconnection-->
<h2><!--LANG::sql_connection_title--></h2>
<p><!--LANG::sql_connection_info--></p>
<form name="db_connection" method="post"> 
<p><label for="db_host"><!--LANG::sql_host_label--></label><input type="text" name="db_host" id="db_host" value="localhost"></p>
<p><label for="db_data"><!--LANG::sql_database_label--></label><input type="text" name="db_data" id="db_data" value="fs2_installer"></p>
<p><label for="db_user"><!--LANG::sql_user_label--></label><input type="text" name="db_user" id="db_user" value="frogsystem"></p>
<p><label for="db_pass"><!--LANG::sql_password_label--></label><input type="text" name="db_pass" id="db_pass" value="frogsystem"></p>
<p><label for="db_pref"><!--LANG::sql_prefix_label--></label><input type="text" name="db_pref" id="db_pref" value="fs2_"></p>
<p><button type="submit"><!--LANG::sql_check_connection_button--></button></p>
</form>
<!--section-end::sqlconnection-->

<!--section-start::sqlinstructions_info-->
<h2><!--LANG::sql_instructions_title--></h2>
<p><!--LANG::sql_instructions_info--></p>
<ul>
<!--TEXT::instruction_list-->
</ul>
<p><button><!--LANG::sql_start_instructions_button--></button></p>
<!--section-end::sqlinstructions_info-->

<!--section-start::sqlinstructions_info_element-->
    <li><!--TEXT::instruction--></li>
<!--section-end::sqlinstructions_info_element-->
