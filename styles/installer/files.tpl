<!--section-start::file_info-->
<h2><!--LANG::file_info_title--></h2>
<p><!--LANG::file_info_text--></p>
<!--IF::success-->
<p class="space success"><b><!--LANG::file_info_writable_title--></b><br><!--LANG::file_info_writable_text--></p>
<!--ENDIF-->  
<!--IF::error-->
<p class="space error"><b><!--LANG::file_info_not_writable_title--></b><br><!--LANG::file_info_not_writable_text--></p>
<!--ENDIF-->  
<ul>
<!--TEXT::instruction_list-->
</ul>

<p class="space attop <!--IF::error-->button-line center<!--ENDIF-->">
<!--IF::success-->
    <a class="button green <!--IF::error-->atleft<!--ENDIF-->" href="<!--TEXT::url_next-->">&raquo; <!--LANG::file_start_instructions_button--></a>
<!--ELSE-->
    <a class="button white <!--IF::error-->atleft<!--ENDIF-->" href="<!--TEXT::url_self-->">&raquo; <!--LANG::file_recheck_permissions--></a>
<!--ENDIF-->
<!--IF::error-->
    <span><!--LANG::or--></span>
    <a class="button orange atright" href="<!--TEXT::url_next-->">&raquo; <!--LANG::file_start_instructions_button_with_errors--></a>
<!--ENDIF-->
</p>
<!--section-end::file_info-->

<!--section-start::instruction_element-->
    <li <!--IF::error-->class="error"<!--ENDIF-->><!--TEXT::instruction-->
        <!--IF::success--><img src="<!--TEXT::success_img-->" alt="<!--LANG::success-->"><!--ENDIF-->
        <!--IF::error--><img src="<!--TEXT::error_img-->" alt="<!--LANG::error-->"><!--ENDIF-->
        <!--IF::error--><br><span class="small"><!--TEXT::error_message--></span><!--ENDIF-->
<!--section-end::instruction_element-->


<!--section-start::file_runner-->
<h2><!--LANG::file_runner_title--></h2>
<p><!--LANG::file_runner_info--></p>
<!--IF::done-->
    <!--IF::all_successful-->
    <p class="space success"><b><!--LANG::file_operations_done_title--></b><br><!--LANG::file_operations_done--></p>
    <!--ELSE-->
    <p class="space warning"><b><!--LANG::file_operations_done_but_error_title--></b><br><!--LANG::file_operations_done_but_error--></p>
    <!--ENDIF-->    
<!--ENDIF-->

<ul>
<!--TEXT::instruction_list-->
</ul>
<p class="space atbottom"><b><!--LANG::total_runtime-->:</b> <!--TEXT::total_runtime--><!--LANG::seconds_short--></p>

<!--IF::done-->
    <!--IF::all_successful-->
    <p><a class="button green" href="<!--TEXT::url-->">&raquo; <!--LANG::continue_with_next_step--></a></p>
    <!--ELSE-->
    <p class="button-line center">
        <a class="button orange atleft" href="<!--TEXT::url_self-->">&raquo; <!--LANG::file_operations_retry--></a>
        <span><!--LANG::or--></span>
        <a class="button orange atright" href="<!--TEXT::url-->">&raquo; <!--LANG::file_operations_continue_with_errors--></a>
    </p>
    <!--ENDIF-->
<!--ELSE-->  
    <p><a class="button white" href="<!--TEXT::url-->">&raquo; <!--LANG::continue_file_operations--></a></p>
<!--ENDIF-->

<!--section-end::file_runner-->
