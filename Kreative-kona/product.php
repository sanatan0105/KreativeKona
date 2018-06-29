<?php 
include ('php/connect.php');
include('php/functions.php');
include('include/header.php');
include('include/headerB4Login.php');
include('include/top_menu.php');
?>



<!-- banner -->
<div class="page-head">
	<div class="container">
		<h3>Some header</h3>
	</div>
</div>
<!-- //banner -->
<!-- mens -->
<div class="men-wear">
	<div class="container">
		<div class="col-md-4 products-left">
			<div class="filter-price">
				<h3>Filter By Price</h3>
					<ul class="dropdown-menu6">
						<li>                
							<div id="slider-range"></div>							
							<input name="price_rance" type="text" id="amount" style="border: 0; color: #ffffff; font-weight: normal;" />
						</li>			
					</ul>
							<!---->
							<script type='text/javascript'>//<![CDATA[ 
							$(window).load(function(){
							 $( "#slider-range" ).slider({
										range: true,
										min: 0,
										max: 9000,
										values: [ 1000, 7000 ],
										slide: function( event, ui ) {  $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
										}
							 });
							$( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );

							});//]]>  

							</script>
						<script type="text/javascript" src="js/jquery-ui.js"></script>
					 <!---->
			</div>
			<div class="css-treeview">
				<h4>Categories</h4>
			
				
			
				<ul class="tree-list-pad">
				
				<?php 
				$sql1=mysqli_query($con,"SELECT DISTINCT(`category`) FROM `cat_subcat`");
				while($row1=mysqli_fetch_assoc($sql1))
				{
					$cat=$row1['category'];
					?>
					<li><input type="checkbox" checked="checked" id="item-0" /><label for="item-0"><span></span><?php echo $cat; ?></label>
						<ul>
							<?php 
							$sql2=mysqli_query($con,"SELECT DISTINCT(`subcategory`) FROM `cat_subcat` WHERE `category`='$cat'");
							while($row2=mysqli_fetch_assoc($sql2))
							{
								$sub_cat1=$row2['subcategory'];
								$sub_cat1 = ($sub_cat1=='') ? 'No Sub Category' : $sub_cat1; 
								?>
								<li><input type="checkbox" id="item-0-0" /><label for="item-0-0"><?php echo $sub_cat1; ?></label>
									<ul>
									<?php 
									$sql3=mysqli_query($con,"SELECT `sub_cat2` FROM `cat_subcat` WHERE `subcategory`='$sub_cat1'");
									while($row3=mysqli_fetch_assoc($sql3))
									{
										$sub_cat2=$row3['sub_cat2'];
										?>
										<li><a href="mens.html"><?php echo $sub_cat2; ?> </a></li>
										<?php 
									}
									?>
									</ul>
								</li>
								<?php 
								
							}
							?>
							
							
						</ul>
					
					</li>
					<?php 
				}
				?>
				
				</ul>
				<!--<ul class="tree-list-pad">
					<li><input type="checkbox" checked="checked" id="item-0" /><label for="item-0"><span></span>Category 1</label>
						<ul>
							<li><input type="checkbox" id="item-0-0" /><label for="item-0-0">Sub Category 1</label>
								<ul>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
								</ul>
							</li>
							<li><input type="checkbox" id="item-0-0" /><label for="item-0-0">Sub Category 2</label>
								<ul>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
								</ul>
							</li>
							<li><input type="checkbox" id="item-0-0" /><label for="item-0-0">Sub Category 3</label>
								<ul>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
								</ul>
							</li>
						</ul>
					</li>
					<li><input type="checkbox" id="item-1" checked="checked" /><label for="item-1">Category 2</label>
						<ul>
							<li><input type="checkbox" id="item-0-0" /><label for="item-0-0">Sub Category 1</label>
								<ul>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
								</ul>
							</li>
							
						</ul>
					</li>
					<li><input type="checkbox" checked="checked" id="item-2" /><label for="item-2">Category 3</label>
						<ul>
							<li><input type="checkbox"  id="item-2-0" /><label for="item-2-0">Sub Category 1</label>
								<ul>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
								</ul>
							</li>
							<li><input type="checkbox"  id="item-2-0" /><label for="item-2-0">Sub Category 2</label>
								<ul>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
								</ul>
							</li>
							<li><input type="checkbox"  id="item-2-0" /><label for="item-2-0">Sub Category 3</label>
								<ul>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
									<li><a href="mens.html">Sub cat </a></li>
								</ul>
							</li>
						</ul>
					</li>
				</ul>-->
			</div>
			<div class="community-poll">
				<h4>Community Poll</h4>
				<div class="swit form">	
					<form>
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio" checked=""><i></i>More convenient for shipping and delivery</label> </div></div>
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>Lower Price</label> </div></div>
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>Track your item</label> </div></div>
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>Bigger Choice</label> </div></div>
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>More colors to choose</label> </div></div>	
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>Secured Payment</label> </div></div>
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>Money back guaranteed</label> </div></div>	
					<div class="check_box"> <div class="radio"> <label><input type="radio" name="radio"><i></i>Others</label> </div></div>		
					<input type="submit" value="SEND">
					</form>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="col-md-8 products-right">
			<h5>Product (0)</h5>
			<div class="sort-grid">
				<div class="sorting">
					<h6>Sort By</h6>
					<select id="country1" onchange="change_country(this.value)" class="frm-field required sect">
						<option value="null">Default</option>
						<option value="null">Name(A - Z)</option> 
						<option value="null">Name(Z - A)</option>
						<option value="null">Price(High - Low)</option>
						<option value="null">Price(Low - High)</option>	
						<option value="null">Model(A - Z)</option>
						<option value="null">Model(Z - A)</option>					
					</select>
					<div class="clearfix"></div>
				</div>
				<div class="sorting">
					<h6>Showing</h6>
					<select id="country2" onchange="change_country(this.value)" class="frm-field required sect">
						<option value="null">7</option>
						<option value="null">14</option> 
						<option value="null">28</option>					
						<option value="null">35</option>								
					</select>
					<div class="clearfix"></div>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="men-wear-top">
				<script src="js/responsiveslides.min.js"></script>
				<script>
						// You can also use "$(window).load(function() {"
						$(function () {
						 // Slideshow 4
						$("#slider3").responsiveSlides({
							auto: true,
							pager: true,
							nav: false,
							speed: 500,
							namespace: "callbacks",
							before: function () {
						$('.events').append("<li>before event fired.</li>");
						},
						after: function () {
							$('.events').append("<li>after event fired.</li>");
							}
							});
						});
				</script>
				<div  id="top" class="callbacks_container">
					<ul class="rslides" id="slider3">
						<li>
							<img class="img-responsive" src="images/men1.jpg" alt=" "/>
						</li>
						<li>
							<img class="img-responsive" src="images/men2.jpg" alt=" "/>
						</li>
						<li>
							<img class="img-responsive" src="images/men1.jpg" alt=" "/>
						</li>
						<li>
							<img class="img-responsive" src="images/men2.jpg" alt=" "/>
						</li>
					</ul>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="men-wear-bottom">
				<div class="col-sm-4 men-wear-left">
					<img class="img-responsive" src="images/productimage.PNG" alt=" " />
				</div>
				<div class="col-sm-8 men-wear-right">
					<h4>Exclusive XYZ Collections</h4>
					<p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem 
					accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae 
					ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt
					explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut
					odit aut fugit. </p>
				</div>
				<div class="clearfix"></div>
			</div>
				<div class="col-md-4 product-men no-pad-men">
					<div class="men-pro-item simpleCart_shelfItem">
						<div class="men-thumb-item">
							<img src="images/productimage.PNG" alt="" class="pro-image-front">
							<img src="images/productimage.PNG" alt="" class="pro-image-back">
							<div class="men-cart-pro">
								<div class="inner-men-cart-pro">
									<a href="single.html" class="link-product-add-cart">Quick View</a>
								</div>
							</div>
							<span class="product-new-top">New</span>
						</div>
						<div class="item-info-product ">
							<h4><a href="single.html">Sample name</a></h4>
							<div class="info-product-price">
								<span class="item_price">Rs 45.99</span>
								<del>Rs 69.71</del>
							</div>
							<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
						</div>
					</div>
				</div>
				<div class="col-md-4 product-men no-pad-men">
					<div class="men-pro-item simpleCart_shelfItem">
						<div class="men-thumb-item">
							<img src="images/productimage.PNG" alt="" class="pro-image-front">
							<img src="images/productimage.PNG" alt="" class="pro-image-back">
							<div class="men-cart-pro">
								<div class="inner-men-cart-pro">
									<a href="single.html" class="link-product-add-cart">Quick View</a>
								</div>
							</div>
							<span class="product-new-top">New</span>
						</div>
						<div class="item-info-product ">
							<h4><a href="single.html">Sample Name</a></h4>
							<div class="info-product-price">
								<span class="item_price">Rs 45.99</span>
								<del>Rs 69.71</del>
							</div>
							<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
						</div>
					</div>
				</div>
				<div class="col-md-4 product-men no-pad-men">
					<div class="men-pro-item simpleCart_shelfItem">
						<div class="men-thumb-item">
							<img src="images/productimage.PNG" alt="" class="pro-image-front">
							<img src="images/productimage.PNG" alt="" class="pro-image-back">
							<div class="men-cart-pro">
								<div class="inner-men-cart-pro">
									<a href="single.html" class="link-product-add-cart">Quick View</a>
								</div>
							</div>
							<span class="product-new-top">New</span>
						</div>
						<div class="item-info-product ">
							<h4><a href="single.html">Sample name</a></h4>
							<div class="info-product-price">
								<span class="item_price">Rs 45.99</span>
								<del>Rs 69.71</del>
							</div>
							<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
						</div>
					</div>
				</div>
				<div class="clearfix"></div>
		</div>
		<div class="clearfix"></div>
		<div class="single-pro">
			
			<div class="col-md-3 product-men">
				<div class="men-pro-item simpleCart_shelfItem">
					<div class="men-thumb-item">
						<img src="images/productimage.PNG" alt="" class="pro-image-front">
						<img src="images/productimage.PNG" alt="" class="pro-image-back">
							<div class="men-cart-pro">
								<div class="inner-men-cart-pro">
									<a href="single.html" class="link-product-add-cart">Quick View</a>
								</div>
							</div>
							<span class="product-new-top">New</span>				
					</div>
					<div class="item-info-product ">
						<h4><a href="single.html">Sample name</a></h4>
						<div class="info-product-price">
							<span class="item_price">Rs 45.99</span>
							<del>Rs 69.71</del>
						</div>
						<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
					</div>
				</div>
			</div>
			<div class="col-md-3 product-men">
				<div class="men-pro-item simpleCart_shelfItem">
					<div class="men-thumb-item">
						<img src="images/productimage.PNG" alt="" class="pro-image-front">
						<img src="images/productimage.PNG" alt="" class="pro-image-back">
							<div class="men-cart-pro">
								<div class="inner-men-cart-pro">
									<a href="single.html" class="link-product-add-cart">Quick View</a>
								</div>
							</div>
							<span class="product-new-top">New</span>				
					</div>
					<div class="item-info-product ">
						<h4><a href="single.html">Sample name</a></h4>
						<div class="info-product-price">
							<span class="item_price">Rs 45.99</span>
							<del>Rs 69.71</del>
						</div>
						<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
					</div>
				</div>
			</div>
			<div class="col-md-3 product-men">
				<div class="men-pro-item simpleCart_shelfItem">
					<div class="men-thumb-item">
						<img src="images/productimage.PNG" alt="" class="pro-image-front">
						<img src="images/productimage.PNG" alt="" class="pro-image-back">
							<div class="men-cart-pro">
								<div class="inner-men-cart-pro">
									<a href="single.html" class="link-product-add-cart">Quick View</a>
								</div>
							</div>
							<span class="product-new-top">New</span>				
					</div>
					<div class="item-info-product ">
						<h4><a href="single.html">Sample name</a></h4>
						<div class="info-product-price">
							<span class="item_price">Rs 45.99</span>
							<del>Rs 69.71</del>
						</div>
						<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
					</div>
				</div>
			</div>
			<div class="col-md-3 product-men">
				<div class="men-pro-item simpleCart_shelfItem">
					<div class="men-thumb-item">
						<img src="images/productimage.PNG" alt="" class="pro-image-front">
						<img src="images/productimage.PNG" alt="" class="pro-image-back">
							<div class="men-cart-pro">
								<div class="inner-men-cart-pro">
									<a href="single.html" class="link-product-add-cart">Quick View</a>
								</div>
							</div>
							<span class="product-new-top">New</span>				
					</div>
					<div class="item-info-product ">
						<h4><a href="single.html">Sample name</a></h4>
						<div class="info-product-price">
							<span class="item_price">Rs 45.99</span>
							<del>Rs 69.71</del>
						</div>
						<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
			<div class="col-md-3 product-men">
				<div class="men-pro-item simpleCart_shelfItem">
					<div class="men-thumb-item">
						<img src="images/productimage.PNG" alt="" class="pro-image-front">
						<img src="images/productimage.PNG" alt="" class="pro-image-back">
							<div class="men-cart-pro">
								<div class="inner-men-cart-pro">
									<a href="single.html" class="link-product-add-cart">Quick View</a>
								</div>
							</div>
							<span class="product-new-top">New</span>				
					</div>
					<div class="item-info-product ">
						<h4><a href="single.html">Sample name</a></h4>
						<div class="info-product-price">
							<span class="item_price">Rs 45.99</span>
							<del>Rs 69.71</del>
						</div>
						<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
					</div>
				</div>
			</div>
						<div class="col-md-3 product-men">
				<div class="men-pro-item simpleCart_shelfItem">
					<div class="men-thumb-item">
						<img src="images/productimage.PNG" alt="" class="pro-image-front">
						<img src="images/productimage.PNG" alt="" class="pro-image-back">
							<div class="men-cart-pro">
								<div class="inner-men-cart-pro">
									<a href="single.html" class="link-product-add-cart">Quick View</a>
								</div>
							</div>
							<span class="product-new-top">New</span>				
					</div>
					<div class="item-info-product ">
						<h4><a href="single.html">Sample name</a></h4>
						<div class="info-product-price">
							<span class="item_price">Rs 45.99</span>
							<del>Rs 69.71</del>
						</div>
						<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
					</div>
				</div>
			</div>
			<div class="col-md-3 product-men">
				<div class="men-pro-item simpleCart_shelfItem">
					<div class="men-thumb-item">
						<img src="images/productimage.PNG" alt="" class="pro-image-front">
						<img src="images/productimage.PNG" alt="" class="pro-image-back">
							<div class="men-cart-pro">
								<div class="inner-men-cart-pro">
									<a href="single.html" class="link-product-add-cart">Quick View</a>
								</div>
							</div>
							<span class="product-new-top">New</span>				
					</div>
					<div class="item-info-product ">
						<h4><a href="single.html">Sample name</a></h4>
						<div class="info-product-price">
							<span class="item_price">Rs 45.99</span>
							<del>Rs 69.71</del>
						</div>
						<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
					</div>
				</div>
			</div>
		<div class="col-md-3 product-men">
				<div class="men-pro-item simpleCart_shelfItem">
					<div class="men-thumb-item">
						<img src="images/productimage.PNG" alt="" class="pro-image-front">
						<img src="images/productimage.PNG" alt="" class="pro-image-back">
							<div class="men-cart-pro">
								<div class="inner-men-cart-pro">
									<a href="single.html" class="link-product-add-cart">Quick View</a>
								</div>
							</div>
							<span class="product-new-top">New</span>				
					</div>
					<div class="item-info-product ">
						<h4><a href="single.html">Sample name</a></h4>
						<div class="info-product-price">
							<span class="item_price">Rs 45.99</span>
							<del>Rs 69.71</del>
						</div>
						<a href="#" class="item_add single-item hvr-outline-out button2">Add to cart</a>									
					</div>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
		<div class="pagination-grid text-right">
			<ul class="pagination paging">
				<li><a href="#" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
				<li class="active"><a href="#">1<span class="sr-only">(current)</span></a></li>
				<li><a href="#">2</a></li>
				<li><a href="#">3</a></li>
				<li><a href="#">4</a></li>
				<li><a href="#">5</a></li>
				<li><a href="#" aria-label="Next"><span aria-hidden="true">»</span></a></li>
			</ul>
		</div>
	</div>
</div>	
<!-- //mens -->
<!-- //product-nav -->
<?php 
include('include/purchase_des.php');
include('include/footer.php');
include('include/loginInclude.php');
?>

</body>
</html>
