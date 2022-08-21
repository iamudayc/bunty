<html>
   
   <head>
      <title>Sending HTML email </title>
	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
   </head>
   
   <body>
      
      <?php
         //$to = "ayan.chakraborty@ushamartintech.com, chatterjee.uday@gmail.com";
         $to = "chatterjee.uday@gmail.com";
         $subject = "This is subject";
         
         $message = "<div style=\"width:600px; background-color:#f7f7f7; padding:2px; line-height:24px; font-size:15px; border-color:#CCC\">   
    <div style=\"text-align: left;display: block;padding:2px 8px;\">Hi Demo,</div>
    <div style=\"text-align: left;display: block;padding:2px 8px;\">This is a demo email .</div>
    <div style=\"text-align: left;display: block;padding:2px 8px;\">
        <div>
			To complete  click on <a onclick=\"return confirm('Are you sure?')\" class='btn btn-primary' href=\"https://www.google.com/\">Activation Link</a>.</div>
        <div>If the above link does not work correctly, go to</div>
</div>

";
         
         
         $header = "From:haripal.uday@gmail.com \r\n";
         $header .= "MIME-Version: 1.0\r\n";
         $header .= "Content-type: text/html\r\n";
         
         $retval = mail ($to,$subject,$message,$header);
         
         if( $retval == true ) {
            echo "Message sent successfully...";
         }else {
            echo "Message could not be sent...";
         }
      ?>
      
   </body>
</html>