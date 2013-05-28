<!--section-start::requirements-->
<h2><!--LANG::requirements_title--></h2>
<p><!--LANG::requirements_info--></p>
<!--TEXT::fs_version-->
<!--TEXT::php_version-->
<!--TEXT::php_extensions-->
<p><a class="button" href="?step=database"><!--LANG::next_database_operations--></a></p>
<!--section-end::requirements-->

<!--section-start::fs_version-->
<p <!--IF::fs_version_error-->class="error"<!--ENDIF-->>
    <!--IF::fs_version_error--><!--LANG::fs_version_error--><!--ELSE--><!--LANG::fs_version_ok--><!--ENDIF--><br>
    <b><!--LANG::required_version-->:</b> <!--TEXT::required_version--><br>
    <b><!--LANG::your_version-->:</b> <!--TEXT::your_version-->
</p>
<!--section-end::fs_version-->

<!--section-start::php_version-->
<p <!--IF::php_version_error-->class="error"<!--ENDIF-->>
    <!--IF::php_version_error--><!--LANG::php_version_error--><!--ELSE--><!--LANG::php_version_ok--><!--ENDIF--><br>
    <b><!--LANG::required_version-->:</b> <!--TEXT::required_version--><br>
    <b><!--LANG::your_version-->:</b> <!--TEXT::your_version-->
</p>
<!--section-end::php_version-->

<!--section-start::php_extensions-->
<!--IF::php_extensions_error-->
<p <!--IF::php_extensions_error-->class="error"<!--ENDIF-->>
    <!--IF::php_extensions_error--><!--LANG::php_extensions_error--><!--ELSE--><!--LANG::php_extensions_ok--><!--ENDIF--><br>
    <b><!--LANG::missing_extensions-->:</b> <!--TEXT::missing_extensions-->
</p><!--ENDIF-->
<!--section-end::php_extensions-->


