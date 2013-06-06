<!--section-start::introduction-->
<h2><!--LANG::welcome--></h2>
<p><!--LANG::introduction--></p>
<p><a class="button green" href="?step=requirements"><!--LANG::start_installation--></a></p>

<p class="big"><span>&raquo;</span> <a class="big" href="#changelog"><!--LANG::changelog--></a></p>
<p id="changelog" class="hidden">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumyeirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diamvoluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.Lorem i</p>

<p class="big"><span>&raquo;</span> <a class="big" href="#notes"><!--LANG::notes--></a></p>
<p id="notes" class="hidden">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumyeirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diamvoluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.Lorem i</p>

<p class="big"><span>&raquo;</span> <a class="big" href="#copyright"><!--LANG::copyright--></a></p>
<p id="copyright" class="hidden">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumyeirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diamvoluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.Lorem i</p>

<script type="text/javascript">
    $("a[href^=#]").click(function(e) {    
        var info = $(this).attr('href');
        $(info).show();
        //~ switch (info) {
            //~ case '#changelog':
                //~ $(info).show();
                //~ break;
            //~ case '#notes':
                //~ $(info).show();
                //~ break;                
            //~ case '#copyright':
                //~ break;            
        //~ }
        
        return false;  
    });
</script>
<!--section-end::introduction-->
