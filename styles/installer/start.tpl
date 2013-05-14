<!--section-start::introduction-->
<h2><!--LANG::welcome--></h2>
<p><!--LANG::introduction--></p>
<p><a class="button" href=""><!--LANG::start_installation--></a></p>
<!--section-end::introduction-->

<!--section-start::sqlconnection-->
<h2><!--LANG::sql_connection_title--></h2>
<p><!--LANG::sql_connection_info--></p>
<form action="" method="post"> 
<p><label for="db_host"><!--LANG::sql_host_label--></label><input type="text" name="db_host" id="db_host" value="localhost"></p>
<p><label for="db_database"><!--LANG::sql_database_label--></label><input type="text" name="db_database" id="db_database" value="fs2_installer"></p>
<p><label for="db_user"><!--LANG::sql_user_label--></label><input type="text" name="db_user" id="db_user" value="frogsystem"></p>
<p><label for="db_password"><!--LANG::sql_password_label--></label><input type="text" name="db_password" id="db_password" value="frogsystem"></p>
<p><label for="db_prefix"><!--LANG::sql_prefix_label--></label><input type="text" name="db_prefix" id="db_prefix" value="fs2_"></p>
</form>
<p><button><!--LANG::sql_check_connection_button--></button></p>
<!--section-end::sqlconnection-->

$dbc['host'] = 'localhost'; //Database Hostname
$dbc['user'] = 'frogsystem'; //Database Username
$dbc['pass'] = 'frogsystem'; //Database User-Password
$dbc['data'] = 'fs2'; //Database Name
$dbc['pref'] = 'fs2_'; //Table Prefix
