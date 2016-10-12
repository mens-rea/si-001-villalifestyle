<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    <!-- SNIPPET PCT006-001 : html elements -->
    <a href="#" id="smoothup" title="Back to top"><i class="fa fa-angle-up"></i></a>


     </div> <!-- end of #content -->
    </div> <!-- end of #wrapper -->
    <div class='iconload'></div>
    <div class="footer"><h6>Online POS is a product of <a target="_blank" class="lnk" href="http://potatocodes.com">Potatocodes Inc.</a> Copyright 2016</h6></div>

    <!-- add all script below this fold -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>

    <script src="<?php echo base_url(); ?>js/classie.js"></script>
    <script src="<?php echo base_url(); ?>js/pushmenu.js"></script>
    <script src="<?php echo base_url(); ?>js/rightpush.js"></script>

    <script src="<?php echo base_url(); ?>js/jquery-barcode.min.js"></script> 

    <script src="<?php echo base_url(); ?>js/jquery.smoothscroll.min.js"></script>

    <script src="<?php echo base_url();?>js/bootstrap-datepicker.js"></script>

    <!-- SNIPPET PCT006-003 : script -->
    <script>
        $body = $("body");
/*
        $(document).on({
            ajaxStart: function() { $body.addClass("loading");    },
             ajaxComplete: function() { $body.removeClass("loading"); }    
        });*/

       /* $(document).ajaxStart(function(){
            $( ".iconload" ).show();
        });*/
        
        $(window).scroll(function(){
            if ($(this).scrollTop() < 200) {
                $('#smoothup') .fadeOut();
            } else {
                $('#smoothup') .fadeIn();
            }
        });
        $('#smoothup').on('click', function(){
            $('html, body').animate({scrollTop:0}, 'slow');
            return false;
        });
    </script>

    

    <script>
    $('#datepickerincome').datepicker({ format: 'yyyy-mm-dd' });
    $('#datepickerproject').datepicker({ format: 'yyyy-mm-dd' });
    $('#datepickerexpense').datepicker({ format: 'yyyy-mm-dd' });
    $('#datepickerwithdrawal').datepicker({ format: 'yyyy-mm-dd' });
    $('#datepickerstart').datepicker({ format: 'yyyy-mm-dd' });
    $('#datepickerend').datepicker({ format: 'yyyy-mm-dd' });
    </script>
    <script src="<?php echo base_url();?>js/cbpHorizontalMenu.min.js"></script>
    <script>
        $(function() {
          cbpHorizontalMenu.init();
        });
    </script>


  
  </body>
</html>