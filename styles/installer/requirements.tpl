<!--section-start::requirements-->
<h2><!--LANG::requirements_title--></h2>
<p><!--LANG::requirements_info--></p>
<!--TEXT::fs_version-->
<!--TEXT::php_version-->
<!--TEXT::php_extensions-->
<p class="space attop">
    <!--IF::any_error-->
        <a class="button orange" href="?step=database">&raquo; <!--LANG::continue_anyway--> (<!--LANG::database_operations-->)</a>
    <!--ELSE-->
        <a class="button green" href="?step=database">&raquo; <!--LANG::continue_with--> <!--LANG::database_operations--></a>
    <!--ENDIF-->
</p>
<!--section-end::requirements-->

<!--section-start::fs_version-->
<p class="list l150 <!--IF::fs_version_error-->error<!--ELSE-->success<!--ENDIF-->">
    <b><!--IF::fs_version_error--><!--LANG::fs_version_error--><!--ELSE--><!--LANG::fs_version_ok--><!--ENDIF--></b><br>
    <label><!--LANG::required_version-->:</label> <b><!--TEXT::required_version--></b><br>
    <label><!--LANG::your_version-->:</label> <b class="<!--IF::fs_version_error-->>error<!--ELSE-->success<!--ENDIF-->"><!--TEXT::your_version--></b>
</p>
<!--section-end::fs_version-->

<!--section-start::php_version-->
<p class="list l150 <!--IF::php_version_error-->error<!--ELSE-->success<!--ENDIF-->">
    <b><!--IF::php_version_error--><!--LANG::php_version_error--><!--ELSE--><!--LANG::php_version_ok--><!--ENDIF--></b><br>
    <label><!--LANG::required_version-->:</label> <b><!--TEXT::required_version--></b><br>
    <label><!--LANG::your_version-->:</label> <b class="<!--IF::php_version_error-->>error<!--ELSE-->success<!--ENDIF-->"><!--TEXT::your_version--></b>
</p>
<!--section-end::php_version-->

<!--section-start::php_extensions-->
<!--IF::php_extensions_error-->
<p class="list l300 <!--IF::php_extensions_error-->error<!--ELSE-->success<!--ENDIF-->">
    <b><!--IF::php_extensions_error--><!--LANG::php_extensions_error--><!--ELSE--><!--LANG::php_extensions_ok--><!--ENDIF--></b><br>
    <label><!--LANG::missing_extensions-->:</label> <b class="error"><!--TEXT::missing_extensions--></b><br>
</p><!--ENDIF-->
<!--section-end::php_extensions-->


