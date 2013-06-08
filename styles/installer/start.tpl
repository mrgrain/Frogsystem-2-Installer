<!--section-start::introduction-->
<h2><!--LANG::welcome--></h2>
<!--LANG::introduction-->
<p class="space both center"><a class="button green large" href="?step=requirements">&raquo; <!--LANG::start_installation--></a></p>

<p class="big"><span>&raquo;</span> <a class="big" href="#changelog"><!--LANG::changelog--></a></p>
<div id="changelog" class="hidden"><!--TEXT::changelog--></div>

<p class="big"><span>&raquo;</span> <a class="big" href="#notes"><!--LANG::notes--></a></p>
<div id="notes" class="hidden"><!--TEXT::notes--></div>

<p class="big"><span>&raquo;</span> <a class="big" href="#copyright"><!--LANG::copyright--></a></p>
<div id="copyright" class="hidden"><!--TEXT::copyright--></div>

<script type="text/javascript">    
    $("a[href^=#]").click(function(e) {    
        var info = $(this).attr('href');
        $('#changelog, #notes, #copyright').not(info).slideUp();        
        
        if ($(info).is(':hidden'))
            $(info).slideDown();
        else
            $(info).slideUp();

        return false;  
    });
</script>
<!--section-end::introduction-->

<!--section-start::changelog-->
<p class="small"><!--TEXT::changelog_text--></p>
<!--section-end::changelog-->

<!--section-start::notes-->
<p class="small"><!--TEXT::notes_text--></p>
<!--section-end::notes-->

<!--section-start::copyright-->
<p class="small"><!--TEXT::copyright_text--></p>
<!--section-end::copyright-->
