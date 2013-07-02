<!--section-start::cleanup_info-->
<h2><!--LANG::cleanup_info_title--></h2>
<p><!--LANG::cleanup_info_text--></p>
<!--IF::total_success-->
<p class="space success"><b><!--LANG::cleanup_success_title--></b><br><!--LANG::cleanup_success--></p>
<!--ENDIF-->  
<!--IF::any_error-->
<p class="space warning"><b><!--LANG::cleanup_done_but_error_title--></b><br><!--LANG::cleanup_done_but_error--></p>
<!--ENDIF--> 

<!--IF::files-->
<h3><!--LANG::cleanup_files--></h3>
<!--IF::files_error-->
<p class="space error"><b><!--LANG::files_done_but_error_title--></b><br><!--LANG::files_done_but_error--></p>
<!--ENDIF-->  
<ul>
<!--TEXT::instructions_files-->
</ul>
<!--ENDIF-->

<!--IF::sql-->
<h3><!--LANG::cleanup_sql--></h3>
<!--IF::sql_error-->
<p class="space error"><b><!--LANG::sql_done_but_error_title--></b><br><!--LANG::sql_done_but_error--></p>
<!--ENDIF-->  
<ul>
<!--TEXT::instructions_sql-->
</ul>
<!--ENDIF-->

<!--IF::total_success-->
<p><a class="button green" href="<!--TEXT::url_next-->">&raquo; <!--LANG::finish_cleanup--></a></p>
<!--ELSE-->  
<form method="post" action="?step=cleanup">
<p class="space attop button-line center">
    <button class="button <!--IF::any_error-->orange<!--ELSE-->green<!--ENDIF--> atleft" name="cleanup_both" value="1">&raquo; <!--IF::any_error--><!--LANG::retry_cleanup--><!--ELSE--><!--LANG::start_cleanup--><!--ENDIF--></button>
    <a class="button <!--IF::any_error-->orange<!--ELSE-->blue<!--ENDIF--> atright" href="<!--TEXT::url_next-->">&raquo; <!--IF::any_error--><!--LANG::continue_with_errors--><!--ELSE--><!--LANG::skip_cleanup--><!--ENDIF--></a>
    <br>
</p>
<p class="center">
    <span><!--LANG::or--></span>
</p>
<p class="button-line center">
    <!--IF::any_error-->
        <button name="cleanup_files" value="1" class="button white atleft">&raquo; <!--LANG::cleanup_retry_files_only--></button>
        <button name="cleanup_sql" value="1" class="button white atright">&raquo; <!--LANG::cleanup_retry_sql_only--></button>
    <!--ELSE-->  
        <!--IF::files--><button name="cleanup_files" value="1" class="button white atleft">&raquo; <!--LANG::cleanup_files_only--></button><!--ENDIF-->
        <!--IF::sql--><button name="cleanup_sql" value="1" class="button white <!--IF::files-->atright<!--ELSE-->atleft<!--ENDIF-->">&raquo; <!--LANG::cleanup_sql_only--></button><!--ENDIF-->
    <!--ENDIF-->
    <br>
</p>
</form>
<!--ENDIF-->  
<!--section-end::cleanup_info-->

<!--section-start::instruction_element-->
    <li <!--IF::error-->class="error"<!--ENDIF-->><!--TEXT::instruction-->
        <!--IF::success--><img src="<!--TEXT::success_img-->" alt="<!--LANG::success-->"><!--ENDIF-->
        <!--IF::error--><img src="<!--TEXT::error_img-->" alt="<!--LANG::error-->"><!--ENDIF-->
        <!--IF::error--><br><span class="small"><!--TEXT::error_message--></span><!--ENDIF-->
<!--section-end::instruction_element-->

<!--section-start::instruction_element_table--><b><!--TEXT::table--></b><!--section-end::instruction_element_table-->
