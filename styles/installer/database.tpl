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
    <!--IF::table_duplicates-->
    <p class="warning">
        <b><!--LANG::fs2_table_error_title--></b><br>
        <span class="small"><!--TEXT::table_duplicates--></span><br>
        <!--LANG::fs2_table_error-->
    </p>
    <!--ENDIF-->    
    <p class="list aligned <!--IF::table_duplicates-->warning<!--ENDIF-->"><label class="l150" for="db_pref"><!--LANG::sql_prefix_label-->:</label><input type="text" name="db_pref" id="db_pref" value="<!--TEXT::sql_pref-->" size="30"></p>
    <p class="space attop <!--IF::table_duplicates-->center button-line<!--ENDIF-->">
        <button class="button green <!--IF::table_duplicates-->atleft<!--ENDIF-->" type="submit">&raquo; <!--LANG::sql_check_connection_button--></button>
        <!--IF::table_duplicates-->
        <span class="middle"><!--LANG::or--></span>
        <button name="db_table_overwrite" value="1"  type="submit" class="button orange atright">&raquo; <!--LANG::overwrite_table_duplicates--></button>
        <!--ENDIF-->
    </p>
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
    <li><!--TEXT::instruction--> <!--IF::success-->okay!<!--ENDIF--><!--IF::error-->error<!--ENDIF--></li>
<!--section-end::sqlinstructions_info_element-->

<!--section-start::sql_runner-->
<h2><!--LANG::sql_runner_title--></h2>
<p><!--LANG::sql_runner_info--></p>
<!--IF::done-->
    <!--IF::all_successful-->
    <p class="space success"><b><!--LANG::sql_operations_done_title--></b><br><!--LANG::sql_operations_done--></p>
    <!--ELSE-->
    <p class="space warning"><b><!--LANG::sql_operations_done_but_error_title--></b><br><!--LANG::sql_operations_done_but_error--></p>
    <!--ENDIF-->    
<!--ENDIF-->

<ul>
<!--TEXT::instruction_list-->
</ul>
<p class="space atbottom"><b><!--LANG::total_runtime-->:</b> <!--TEXT::total_runtime--><!--LANG::seconds_short--></p>

<!--IF::done-->
    <!--IF::all_successful-->
    <p><a class="button green" href="<!--TEXT::url-->">&raquo; <!--LANG::continue_with--> <!--LANG::setup--></a></p>
    <!--ELSE-->
    <p class="button-line center">
        <a class="button orange atleft" href="<!--TEXT::url_self-->">&raquo; <!--LANG::sql_operations_retry--></a>
        <span><!--LANG::or--></span>
        <a class="button orange atright" href="<!--TEXT::url-->">&raquo; <!--LANG::sql_operations_continue_with_errors--></a>
    </p>
    <!--ENDIF-->
<!--ELSE-->  
    <p><a class="button white" href="<!--TEXT::url-->">&raquo; <!--LANG::continue_sql_operations--></a></p>
<!--ENDIF-->

<!--section-end::sql_runner-->
