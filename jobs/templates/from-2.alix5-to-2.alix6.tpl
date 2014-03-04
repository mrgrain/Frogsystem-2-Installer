INFO new_url_style
INFO 0_polls.tpl APPLET_POLL_BODY polls_form_poll_id_change
INFO 0_search.tpl SEARCH search_update_phonetic_help
INFO 0_search.tpl SEARCH search_new_tag_operators
INFO 0_search.tpl RESULT_LINE search_update_rank
INFO 0_search.tpl BODY search_new_tag_info
INFO 0_user.tpl user_reset_password_link

FILE CREATE 0_main.tpl
SECTION MOVE 0_general.tpl DOCTYPE 0_main.tpl DOCTYPE
SECTION MOVE 0_general.tpl MAINPAGE 0_main.tpl MAIN
SECTION MOVE 0_general.tpl MATRIX 0_main.tpl MATRIX
FILE CREATE 0_viewer.tpl
SECTION MOVE 0_general.tpl POPUPVIEWER 0_viewer.tpl VIEWER
SECTION CREATE 0_search.tpl INFO ./copy/templates/searchinfo.tpl
TAG RENAME 0_search.tpl RESULT_LINE num_matches rank
FILE CREATE 0_top_downloads.tpl ./copy/templates/top_downloads.tpl
SECTION CREATE 0_user.tpl NEW_PASSWORD ./copy/templates/newpassword.tpl


#INFO 0_test.tpl testSection testTag testLang
#TAG RENAME "0_search.tpl" TEST 'test' test2
#TAG REPLACE 0_search.tpl TEST test ./copy/templates/newpassword.tpl
#TAG REPLACE "0_search.tpl" TEST test
#SECTION DELETE 0_general.tpl BLUBB
#SECTION CREATE -O 0_search.tpl EMPTYSECTION
#SECTION MOVE -O 0_general.tpl MATRIX 0_main.tpl OVERWRITE
#FILE CREATE -O 0_main2.tpl ./copy/templates/top_downloads.tpl
#FILE DELETE 0_main2.tpl
#FILE MOVE -O 0_old.tpl 0_new.tpl
#FILE MOVE 0_old.tpl 0_new.tpl
