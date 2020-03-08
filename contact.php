<?php
if(isset($_POST['email'])){
	$to 		= 'venshaestates@gmail.com'; 
	$send_date 	= date('d-m-Y H:i:s');
	$subject 	= 'Customer Contact';
	$message 	= '
	<p>Data &amp; Time: '.$send_date.'</p>
	<table>
	<tr>
	<td><strong>Name:</strong> '.$_POST['name'].'</td>
	</tr>
	<tr>
	<td><strong>E-Mail:</strong> <a href="mailto:'.$_POST['email'].'">'.$_POST['email'].'</a></td>
	</tr>
	<tr>
	<td><strong>Phone:</strong>  '.$_POST['phone'].'</td>
	</tr>
	<tr>
	<td><strong>Message:</strong>  '.$_POST['msg'].'</td>
	</tr>
	</table>
	';
	
	$headere  = "MIME-Version: 1.0\r\n";
	$headere .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headere .= "From: " . $_POST['name'] . "<" . $_POST['email'] . ">\r\n";
	
	mail($to, $subject, $message, $headere);
	
	header('Location: thankyou.html');
	
	$mailback = $_POST['email'];
	$message2 = "Thank you for your interest. We will get back to you as soon as possible.<br /><br /><br />
	
				  Thanks,<br /><br />
				  
				  Best Regards,<br />
				  <strong>Vensha Estates</strong><br />
				  http://www.venshaestates.com";
				  
	$subject2 = "Confirmation from Vensha Estates";
	
	$headers2 = "From: $to\r\n";
	$headers2 .= "Content-type:  text/html\r\n";
	mail($mailback, $subject2, $message2, $headers2);
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Vensha Estates</title>
<!-- Form Validation -->
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.validate.min.js"></script>
<script>
$(document).ready(function(){
    jQuery.validator.addMethod("notEqual", function(value, element, param) {
  return this.optional(element) || value != param;}, "Please write your name");
    
    $("#contact").validate({
      rules: {
		 name: {
			required: "required",
			minlength: 3,
			notEqual: "Name"
		 },
		email: "required email",
		phone: {
			required: true,
			number: true,
			minlength: 10
		}
	},
	messages: {
		 name: {
			required: "Please write your name",
			minlength: jQuery.format("At least {0} characters required!"),
			name: "Please write your name"
		},
		email: {
			required: "We need your email address to contact you",
			email: "Your email should be name@domain.com"
		},
		phone: {
			required: "Please write your Phone No",
			minlength: jQuery.format("At least {0} characters required!")
		}
	}
	});
});
</script>
<!--[if IE]>
	<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<link rel="stylesheet" href="css/styles.css" />
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>
</head>
<body>
<div class="wrapper">
  <div class="page">
    <div class="left-side">
      <div class="logo"><a href="index.html"><img src="images/logo.jpg" /></a></div>
      <div class="navigation">
        <ul class="nav">
          <li><a href="index.html">Home</a></li>
          <li><a href="aboutus.html">About Us</a></li>
          <li><a href="project.html">Projects</a></li>
          <li><a href="gallery.html">Gallery</a></li>
          <li><a href="faq.html">FAQs</a></li>
          <li><a href="#" class="active">Contact Us</a></li>
        </ul>
      </div>
    </div>
    <div class="right-side">
      <div class="banner"><img src="images/page-banner5.jpg" /></div>
      <div class="content">
        <h1>Contact Us</h1>
        <div class="map">
          <div class="map-wrapper">
            <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
            <div style="overflow:hidden;height:250px;">
              <div id="gmap_canvas" style="height:250px;"></div>
              <style>#gmap_canvas img{max-width:none!important;background:none!important}</style>
              <a class="google-map-code" href="http://goertz-gutschein-map.com" id="get-map-data">goertz-gutschein-map.com</a></div>
            <script type="text/javascript"> function init_map(){var myOptions = {zoom:14,center:new google.maps.LatLng(17.4817501,78.53653669999994),mapTypeId: google.maps.MapTypeId.ROADMAP};map = new google.maps.Map(document.getElementById("gmap_canvas"), myOptions);marker = new google.maps.Marker({map: map,position: new google.maps.LatLng(17.4817501, 78.53653669999994)});infowindow = new google.maps.InfoWindow({content:"<b>Vensha Estates</b><br/>Fat No. 203, Brindavan Towers<br/>Brindavan Colony, A.S. Rao Nagar<br/>Hyderabad-500062" });google.maps.event.addListener(marker, "click", function(){infowindow.open(map,marker);});infowindow.open(map,marker);}google.maps.event.addDomListener(window, 'load', init_map);</script>
          </div>
        </div>
        <div class="contact-form">
          <h2>Send us a Message </h2>
          <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="contact">
            <label for="name">Your Name</label>
            <input type="text" required="" id="name" name="name">
            <label for="email">Email</label>
            <input type="text" required="" id="email" name="email">
            <label for="phone">Phone No.</label>
            <input type="text" required="" id="phone" name="phone">
            <label for="message">Message</label>
            <textarea required="" id="msg" name="msg"></textarea>
            <input type="submit" value="Send a Message" id="submit" class="btn btn-color-primary">
          </form>
          <!-- /.footer-form -->
          <script type="text/javascript">
			$('.default-value').each(function(i){
				var defaultValue = $(this).val();
			
				$(this).focus(function(){
					if($(this).val() == defaultValue)
					{
						$(this).val('');
					}
				});
			
				$(this).blur(function(){
					if($(this).val().length == 0)
					{
						$(this).val(defaultValue);
					}
				});
			});
		</script>
        </div>
        
        <div class="proj-location">
          <h2>Location of the Project </h2>
          
         <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d243557.58592966257!2d78.25907772946273!3d17.479457184106302!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bcbef4c08175649%3A0x5c7450a47218506b!2sAsian+Township!5e0!3m2!1sen!2s!4v1425150122017" width="370" height="400" frameborder="0" style="border:0"></iframe>
        </div>
        
      </div>
    </div>
  </div>
  <!-- Page Tag Closing Here -->
  <br class="clear" />
</div>
<!-- Footer HTML Starts Here -->
<div class="footer">
  <div class="footer-wrapper">
    <div class="right-side"> <span class="address"><strong>Vensha Estates</strong><br />
      Flat No. 203, Brindavan Towers, <br />
      Brindavan Colony, Dr. A.S. Rao Nagar, <br />
      Hyderabad - 500062</span> <span class="phone"> +1 9177556655, +1 9010237137</span> <span class="mail">venshaestates@gmail.com</span> </div>
    <div class="left-side">
      <p>&copy; 2015 www.venshaestates.com. All Rights Reserved.</p>
      <a href="#">Privacy Policy</a>
      <ul class="social-footer">
        <li><a href="#" class="facebook">&nbsp;</a></li>
        <li><a href="#" class="twitter">&nbsp;</a></li>
        <li><a href="#" class="linkedin">&nbsp;</a></li>
        <li><a href="#" class="googleplus">&nbsp;</a></li>
      </ul>
    </div>
  </div>
</div>
<!-- Footer HTML Ends Here -->
</body>
</html>
