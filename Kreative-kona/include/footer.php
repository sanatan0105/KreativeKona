<div class="footer">
	<div class="container">
		<div class="col-md-3 footer-left">
			<h2><a href="index.php"><center><img src="images/logo5.jpg" alt=" " max-width="100" max-height="100" /></center></a></h2>
			<p>Some details about your website. Like why one should choose you, blabla Some details about your website. Like why one should choose you, blabla Some details about your website. Like why one should choose you, blabla Some details about your website. Like why one should choose you, blabla</p>
		</div>
		<div class="col-md-9 footer-right">
			<div class="col-sm-6 newsleft">
				<h3>SIGN UP FOR NEWSLETTER !</h3>
			</div>
			<div class="col-sm-6 newsright">
				<form>
					<input type="text" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
					<input type="submit" value="Submit">
				</form>
			</div>
			<div class="clearfix"></div>
			<div class="sign-grds">
				<div class="col-md-4 sign-gd">
					<h4>Information</h4>
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="">Link1</a></li>
						<li><a href="">Link 2</a></li>
						<li><a href="">Link 3</a></li>
						<li><a href="">Link 4</a></li>
						<li><a href="">Link 5</a></li>
					</ul>
				</div>
				
				<div class="col-md-4 sign-gd-two">
					<h4>Store Information</h4>
					<ul>
						<li><i class="glyphicon glyphicon-map-marker" aria-hidden="true"></i>Address : Bla Bla Address, <span>Bangalor.</span></li>
						<li><i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>Email : <a href="mailto:info@example.com">info@example.com</a></li>
						<li><i class="glyphicon glyphicon-earphone" aria-hidden="true"></i>Phone : +1234 567 567</li>
					</ul>
				</div>
				<div class="col-md-4 sign-gd flickr-post">
					<h4>Flickr Posts</h4>
					<ul>
						<li><a href="single.php"><img src="images/b15.jpg" alt=" " class="img-responsive" /></a></li>
						<li><a href="single.php"><img src="images/b16.jpg" alt=" " class="img-responsive" /></a></li>
						<li><a href="single.php"><img src="images/b17.jpg" alt=" " class="img-responsive" /></a></li>
						<li><a href="single.php"><img src="images/b18.jpg" alt=" " class="img-responsive" /></a></li>
						<li><a href="single.php"><img src="images/b15.jpg" alt=" " class="img-responsive" /></a></li>
						<li><a href="single.php"><img src="images/b16.jpg" alt=" " class="img-responsive" /></a></li>
						<li><a href="single.php"><img src="images/b17.jpg" alt=" " class="img-responsive" /></a></li>
						<li><a href="single.php"><img src="images/b18.jpg" alt=" " class="img-responsive" /></a></li>
						<li><a href="single.php"><img src="images/b15.jpg" alt=" " class="img-responsive" /></a></li>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="clearfix"></div>
		<p class="copy-right">&copy 2016 Kreative Kona. All rights reserved | Developed by <a href="http://www.kezinking.com/">Sanatan Singh Rajput (Kezin King)</a></p>
	</div>
</div>

   <script>
   $(document).ready(function(){
	   $("#add_to_cart").click(function(){
		   
		   var p_id=$("#get_p_id").val();
		   

				 $.ajax({
					url: 'process/add_to_cart.php',
					type: 'POST',
					data: {p_id:p_id},
           
					success: function (msg) {
						$("#cart_result").html(msg);
					},
					error: function(){
						alert("error in ajax form submission");
					}
				});
				$("#cart_result").html("<i class='fa fa-spinner fa-spin'></i><br/><small>Please Wait! Processing your Data..</small>");
			
		});
		$("#head_select").html('Update address');
			$("#email_form").hide();
			$("#con_num_form").hide();
			$("#order_history_form").hide();
			$("#logout_form").hide();
			$("#address_form").show();
		$("#addr").click(function(){
			$("#head_select").html('Update address');
			$("#email_form").hide();
			$("#con_num_form").hide();
			$("#order_history_form").hide();
			$("#logout_form").hide();
			$("#address_form").show();
		});
		$("#email").click(function(){
			$("#head_select").html('Update email');
			$("#email_form").show();
			$("#con_num_form").hide();
			$("#order_history_form").hide();
			$("#logout_form").hide();
			$("#address_form").hide();
		});
		$("#con_num").click(function(){
			$("#head_select").html('Update contact number');
			$("#email_form").hide();
			$("#con_num_form").show();
			$("#order_history_form").hide();
			$("#logout_form").hide();
			$("#address_form").hide();
		});
		$("#order_history").click(function(){
			$("#head_select").html('Order history');
			$("#email_form").hide();
			$("#con_num_form").hide();
			$("#order_history_form").show();
			$("#logout_form").hide();
			$("#address_form").hide();
		});
		$("#logout").click(function(){
			$("#head_select").html('Logout');
			$("#email_form").hide();
			$("#con_num_form").hide();
			$("#order_history_form").hide();
			$("#logout_form").show();
			$("#address_form").hide();
		});
		
		$("#vendor_profile").click(function(){
			window.location.href='vendor-profile.php';
		});
		
   });
   
   
   
   </script>
   
  