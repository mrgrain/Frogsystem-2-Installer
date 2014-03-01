<!--section-start::instruction_element-->
    <li <!--IF::error-->class="error"<!--ENDIF-->>
    <!--TEXT::instruction--><!--IF::success-->&nbsp;<img src="<!--TEXT::success_img-->" alt="<!--LANG::success-->"><!--ENDIF--><!--IF::error-->&nbsp;<img src="<!--TEXT::error_img-->" alt="<!--LANG::error-->"><!--ENDIF-->
    <!--IF::error--><br><span class="small"><!--TEXT::error_message--></span><!--ENDIF-->
<!--section-end::instruction_element-->

<!--section-start::templates_info-->
<h2><!--LANG::templates_info_title--></h2>
<p><!--LANG::templates_info_text--></p>

<h3><!--LANG::template_styles_title--></h3>
<p><!--LANG::template_styles_info--></p>
<ul class="checkbox-list">
<!--TEXT::styles_selection-->
</ul>

<h3><!--LANG::template_jobs_title--></h3>
<p><!--LANG::template_jobs_info--></p>
<!--TEXT::info_list-->
<ul>
<!--TEXT::instruction_list-->
</ul>

<p class="space attop atbottom button-line center">
    <a class="button green atleft" href="<!--TEXT::url_start-->">&raquo; <!--LANG::templates_start_instructions_button--></a>
    <span><!--LANG::or--></span>
    <a class="button white atright" href="<!--TEXT::url_skip-->">&raquo; <!--LANG::templates_skip_instructions_button--></a>
</p>
<!--section-end::templates_info-->


<!--section-start::styles_selection-->
<form>
    <!--TEXT::styles_selection_list-->
</form>
<!--section-end::styles_selection-->

<!--section-start::styles_selection_element-->
    <li>
        <label class="pointer middle sans-serif small" for="style_<!--TEXT::style-->">
            <input checked type="checkbox" id="style_<!--TEXT::style-->" value="<!--TEXT::style-->">
            <span><!--TEXT::style--></span> - <!--TEXT::info-->
        </label>
    </li>
<!--section-end::styles_selection_element-->



<!--section-start::instruction_element-->
    <li <!--IF::error-->class="error"<!--ENDIF-->>
    <!--TEXT::instruction--><!--IF::success-->&nbsp;<img src="<!--TEXT::success_img-->" alt="<!--LANG::success-->"><!--ENDIF--><!--IF::error-->&nbsp;<img src="<!--TEXT::error_img-->" alt="<!--LANG::error-->"><!--ENDIF-->
    <!--IF::error--><br><span class="small"><!--TEXT::error_message--></span><!--ENDIF-->
<!--section-end::instruction_element-->

<!--section-start::info_element-->
    <p class="info"><!--TEXT::info--></p>
<!--section-end::info_element-->


<!--section-start::template_runner-->
<h2><!--LANG::template_runner_title--></h2>
<p><!--LANG::template_runner_info--></p>
<!--IF::done-->
    <!--IF::all_successful-->
    <p class="space success"><b><!--LANG::template_operations_done_title--></b><br><!--LANG::template_operations_done--></p>
    <!--ELSE-->
    <p class="space warning"><b><!--LANG::template_operations_done_but_error_title--></b><br><!--LANG::template_operations_done_but_error--></p>
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
        <a class="button orange atleft" href="<!--TEXT::url_self-->">&raquo; <!--LANG::template_operations_retry--></a>
        <span><!--LANG::or--></span>
        <a class="button orange atright" href="<!--TEXT::url-->">&raquo; <!--LANG::template_operations_continue_with_errors--></a>
    </p>
    <!--ENDIF-->
<!--ELSE-->
    <p><a class="button white" href="<!--TEXT::url-->">&raquo; <!--LANG::continue_template_operations--></a></p>
<!--ENDIF-->

<!--section-end::template_runner-->
