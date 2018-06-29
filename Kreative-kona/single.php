<?php 

include ('php/connect.php');
include('php/functions.php');
include('include/header.php');

include('include/headerB4Login.php');

include('include/top_menu.php');

if(isset($_GET['value']))
{
	$p_id=base64_decode(sanitize($_GET['value']));
	
	$p_id= ($p_id=='') ? 1 : $p_id ;
	
	$sql_check_product=mysqli_query($con,"SELECT * FROM `product` WHERE `p_id`=$p_id");
	$count_p=mysqli_num_rows($sql_check_product);
	if($count_p==0)
	{
		echo ' <div class="container-fluid"><div class="alert alert-"><center><strong>Invalid product...<strong></center></div></div>';
	}
	else
	{
		$row=mysqli_fetch_assoc($sql_check_product);
		$name=$row['name'];
		$cat=$row['cat'];
		$sub_cat=$row['subcat'];
		$mrp=$row['mrp'];
		$descr=$row['descr'];
		$doa=$row['doa'];
		$uploader=$row['uploader'];
		
		$sql_get_uploader_details=mysqli_query($con,"SELECT * FROM `vendor` WHERE `vendor_id`=$uploader");
		$row_get_uploader_details=mysqli_fetch_assoc($sql_get_uploader_details);
		$ven_name=$row_get_uploader_details['name'];
		$con_num=$row_get_uploader_details['con_num'];
		$web=$row_get_uploader_details['website'];
		$email=$row_get_uploader_details['email'];
		$about=$row_get_uploader_details['about_you'];
		$doj=$row_get_uploader_details['doj'];
		
		
		$image_a=array();
		$sql_get_image=mysqli_query($con,"SELECT * FROM `product_image` WHERE `p_id`=$p_id");
		while($row_get_image=mysqli_fetch_assoc($sql_get_image))
		{
			$image=$row_get_image['image'];
			array_push($image_a,$image);
		}
		?>
		<div class="page-head">
	<div class="container">
		<h3><?php echo $name; ?></h3>
	</div>
</div>
<!-- //banner -->
<!-- single -->
<div class="single">
	<div class="container">
		<div class="col-md-6 single-right-left animated wow slideInUp animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInUp;">
			<div class="grid images_3_of_2">
				<div class="flexslider">
					<!-- FlexSlider -->
						<script>
						// Can also be used with $(document).ready()
							$(window).load(function() {
								$('.flexslider').flexslider({
								animation: "slide",
								controlNav: "thumbnails"
								});
							});
						</script>
					<!-- //FlexSlider-->
					<ul class="slides">
						<?php 
						for($i=0;$i<4;$i++)
						{
							$p_i=$image_a[$i];
							echo '<li data-thumb="'.$p_i.'">
							<div class="thumb-image"> <img src="'.$p_i.'" data-imagezoom="true" class="img-responsive"> </div>
						</li>';
						}
						?>
						<!--<li data-thumb="images/productimage.PNG">
							<div class="thumb-image"> <img src="images/productimage.PNG" data-imagezoom="true" class="img-responsive"> </div>
						</li>
						<li data-thumb="images/productimage.PNG">
							<div class="thumb-image"> <img src="images/productimage.PNG" data-imagezoom="true" class="img-responsive"> </div>
						</li>	
						<li data-thumb="images/productimage.PNG">
							<div class="thumb-image"> <img src="images/productimage.PNG" data-imagezoom="true" class="img-responsive"> </div>
						</li>
						<li data-thumb="images/productimage.PNG">
							<div class="thumb-image"> <img src="images/productimage.PNG" data-imagezoom="true" class="img-responsive"> </div>
						</li>-->	
					</ul>
					<div class="clearfix"></div>
				</div>	
			</div>
		</div>
		<div class="col-md-6 single-right-left simpleCart_shelfItem animated wow slideInRight animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInRight;">
					<h3><?php echo $name; ?></h3>
					<p><span class="item_price"><?php echo $mrp; ?></span> <del>- Rs 900</del></p>
					<div class="rating1">
						<span class="starRating">
							<input id="rating5" type="radio" name="rating" value="5">
							<label for="rating5">5</label>
							<input id="rating4" type="radio" name="rating" value="4">
							<label for="rating4">4</label>
							<input id="rating3" type="radio" name="rating" value="3" checked="">
							<label for="rating3">3</label>
							<input id="rating2" type="radio" name="rating" value="2">
							<label for="rating2">2</label>
							<input id="rating1" type="radio" name="rating" value="1">
							<label for="rating1">1</label>
						</span>
					</div>
					<div class="description">
						<h5>Check delivery, payment options and charges at your location</h5>
						<input type="text" value="Enter pincode" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter pincode';}" required="">
						<input type="submit" value="Check">
					</div>
					<div class="color-quality">
						<div class="color-quality-right">
							<h5>Quality :</h5>
							<select id="country1" onchange="change_country(this.value)" class="frm-field required sect">
								<option value="null">5 Qty</option>
								<option value="null">6 Qty</option> 
								<option value="null">7 Qty</option>					
								<option value="null">10 Qty</option>								
							</select>
						</div>
					</div>
					<div class="occasional">
						<h5>Types :</h5>
						<div class="colr ert">
							<label class="radio"><input type="radio" name="radio" checked=""><i></i>Type 1</label>
						</div>
						<div class="colr">
							<label class="radio"><input type="radio" name="radio"><i></i>Type 2</label>
						</div>
						<div class="colr">
							<label class="radio"><input type="radio" name="radio"><i></i>Type 3</label>
						</div>
						<div class="clearfix"> </div>
					</div>
					<div  class="occasion-cart">
						<input type="hidden" id="get_p_id" value="<?php echo $p_id; ?>">
						<a style="cursor:pointer;" id="add_to_cart" class="item_add hvr-outline-out button2">Add to cart</a>
					</div>
					<p id="cart_result"></p>
					
		</div>
				<div class="clearfix"> </div>

				<div class="bootstrap-tab animated wow slideInUp animated" data-wow-delay=".5s" style="visibility: visible; animation-delay: 0.5s; animation-name: slideInUp;">
					<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
						<ul id="myTab" class="nav nav-tabs" role="tablist">
							<li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Description</a></li>
							<li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Reviews(1)</a></li>
							<!--<li role="presentation" class="dropdown">
								<a href="#" id="myTabDrop1" class="dropdown-toggle" data-toggle="dropdown" aria-controls="myTabDrop1-contents">Information <span class="caret"></span></a>
								<ul class="dropdown-menu" role="menu" aria-labelledby="myTabDrop1" id="myTabDrop1-contents">
									<li><a href="#dropdown1" tabindex="-1" role="tab" id="dropdown1-tab" data-toggle="tab" aria-controls="dropdown1">cleanse</a></li>
									<li><a href="#dropdown2" tabindex="-1" role="tab" id="dropdown2-tab" data-toggle="tab" aria-controls="dropdown2">fanny</a></li>
								</ul>
							</li>-->
						</ul>
						<div id="myTabContent" class="tab-content">
							<div role="tabpanel" class="tab-pane fade in active bootstrap-tab-text" id="home" aria-labelledby="home-tab">
								<h5>Product Brief Description</h5>
								<p>Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua, retro synth master cleanse. Mustache cliche tempor, williamsburg carles vegan helvetica. Reprehenderit butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terry richardson ex squid. Aliquip placeat salvia cillum iphone. Seitan aliquip quis cardigan american apparel, butcher voluptate nisi qui.
									<span>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span></p>
							</div>
							<div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="profile" aria-labelledby="profile-tab">
								<div class="bootstrap-tab-text-grids">
									<div class="bootstrap-tab-text-grid">
										<div class="bootstrap-tab-text-grid-left">
											<img src="images/men3.jpg" alt=" " class="img-responsive">
										</div>
										<div class="bootstrap-tab-text-grid-right">
											<ul>
												<li><a href="#">Admin</a></li>
												<li><a href="#"><span class="glyphicon glyphicon-share" aria-hidden="true"></span>Reply</a></li>
											</ul>
											<p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis 
												suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem 
												vel eum iure reprehenderit.</p>
										</div>
										<div class="clearfix"> </div>
									</div>
									
									<div class="add-review">
										<h4>add a review</h4>
										<form>
											<input type="text" value="Name" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Name';}" required="">
											<input type="email" value="Email" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
											
											<textarea type="text" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Message...';}" required="">Message...</textarea>
											<input type="submit" value="SEND">
										</form>
									</div>
								</div>
							</div>
							<div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="dropdown1" aria-labelledby="dropdown1-tab">
								<p>Etsy mixtape wayfarers, ethical wes anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack lo-fi farm-to-table readymade. Messenger bag gentrify pitchfork tattooed craft beer, iphone skateboard locavore carles etsy salvia banksy hoodie helvetica. DIY synth PBR banksy irony. Leggings gentrify squid 8-bit cred pitchfork. Williamsburg banh mi whatever gluten-free, carles pitchfork biodiesel fixie etsy retro mlkshk vice blog. Scenester cred you probably haven't heard of them, vinyl craft beer blog stumptown. Pitchfork sustainable tofu synth chambray yr.</p>
							</div>
							<div role="tabpanel" class="tab-pane fade bootstrap-tab-text" id="dropdown2" aria-labelledby="dropdown2-tab">
								<p>Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master cleanse gluten-free squid scenester freegan cosby sweater. Fanny pack portland seitan DIY, art party locavore wolf cliche high life echo park Austin. Cred vinyl keffiyeh DIY salvia PBR, banh mi before they sold out farm-to-table VHS viral locavore cosby sweater. Lomo wolf viral, mustache readymade thundercats keffiyeh craft beer marfa ethical. Wolf salvia freegan, sartorial keffiyeh echo park vegan.</p>
							</div>
						</div>
					</div>
				</div>
	</div>
</div>
		<?php 
		
		
		
		
		
	}
}
else
{
	echo '</br></br><div class="container-fluid"><div class="alert alert-danger"><center><strong>No product selected...<strong></center></div></div></br>';
}
?>

<!-- //banner-top -->
<!-- banner -->

<?php 
include('include/purchase_des.php');
?>
<?php 
include('include/footer.php');
?>

<?php 
include('include/loginInclude.php');
?>
</body>
</html>
