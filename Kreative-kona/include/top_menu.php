<div style="margin-top:-20px;" class="ban-top">
	<div class="container">
		<div class="top_nav_left">
			<nav class="navbar navbar-default">
			  <div class="container-fluid">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
				  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				  </button>
				</div>
				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse menu--shylock" id="bs-example-navbar-collapse-1">
				  <ul class="nav navbar-nav menu__list">
					<li class="active menu__item menu__item--current"><a class="menu__link" href="index.php">Home <span class="sr-only">(current)</span></a></li>
					<li class="dropdown menu__item">
						<a href="#" class="dropdown-toggle menu__link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">HOME AND LIVING<span class="caret"></span></a>
							<ul class="dropdown-menu multi-column columns-3">
								<div class="row">
									<div class="col-sm-6 multi-gd-img1 multi-gd-text ">
										<a href=""><img src="images/home_and_living.jpg.jpg" alt=" "/></a>
									</div>
									<div class="col-sm-3 multi-gd-img">
										<ul class="multi-column-dropdown">
										<?php 
										$sql_get_sub_cat_tab1=mysqli_query($con,"SELECT DISTINCT(`subcategory`) FROM `cat_subcat` WHERE `category`='HOME AND LIVING' LIMIT 6");
										while($row_get_sub_cat_tab1=mysqli_fetch_assoc($sql_get_sub_cat_tab1))
										{
											
											$subcategory=$row_get_sub_cat_tab1['subcategory'];
											echo '<li><a href="product.php?sub_cat1='.$subcategory.'">'.$subcategory.'</a></li>';
										}
										?>
											
											
										</ul>
									</div>
									<div class="col-sm-3 multi-gd-img">
										<ul class="multi-column-dropdown">
										<?php 
										$sql_get_sub_cat2_tab1=mysqli_query($con,"SELECT DISTINCT(`sub_cat2`) FROM `cat_subcat` WHERE `category`='HOME AND LIVING' LIMIT 6");
										while($row_get_sub_cat2_tab1=mysqli_fetch_assoc($sql_get_sub_cat2_tab1))
										{
											
											$sub_cat2=$row_get_sub_cat2_tab1['sub_cat2'];
											echo '<li><a href="product.php?category=HOME AND LIVING&sub_cat2='.$sub_cat2.'">'.$sub_cat2.'</a></li>';
										}
										?>
										</ul>
									</div>
									<div class="clearfix"></div>
								</div>
							</ul>
					</li>
					<li class="dropdown menu__item">
						<a href="#" class="dropdown-toggle menu__link" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">FASHION <span class="caret"></span></a>
							<ul class="dropdown-menu multi-column columns-3">
								<div class="row">
									<div class="col-sm-3 multi-gd-img">
										<ul class="multi-column-dropdown">
										<?php 
										$sql_get_sub_cat_tab1=mysqli_query($con,"SELECT DISTINCT(`subcategory`) FROM `cat_subcat` WHERE `category`='FASHION' LIMIT 6");
										while($row_get_sub_cat_tab1=mysqli_fetch_assoc($sql_get_sub_cat_tab1))
										{
											
											$subcategory=$row_get_sub_cat_tab1['subcategory'];
											echo '<li><a href="product.php?sub_cat1='.$subcategory.'">'.$subcategory.'</a></li>';
										}
										?>
											
											
										</ul>
									</div>
									<div class="col-sm-3 multi-gd-img">
										<ul class="multi-column-dropdown">
										<?php 
										$sql_get_sub_cat2_tab1=mysqli_query($con,"SELECT DISTINCT(`sub_cat2`) FROM `cat_subcat` WHERE `category`='FASHION' LIMIT 6");
										while($row_get_sub_cat2_tab1=mysqli_fetch_assoc($sql_get_sub_cat2_tab1))
										{
											
											$sub_cat2=$row_get_sub_cat2_tab1['sub_cat2'];
											echo '<li><a href="product.php?category=FASHION&sub_cat2='.$sub_cat2.'">'.$sub_cat2.'</a></li>';
										}
										?>
										</ul>
									</div>
									<div class="col-sm-6 multi-gd-img multi-gd-text ">
										<a href=""><img src="images/woo.jpg" alt=" "/></a>
									</div>
									<div class="clearfix"></div>
								</div>
							</ul>
					</li>
					<li class=" menu__item"><a class="menu__link" href="product.php?category=HANDICRAFTS">HANDICRAFTS</a></li>
					<li class=" menu__item"><a class="menu__link" href="product.php">COMPLETE</a></li>
					<li class=" menu__item"><a class="menu__link" href="contact.php">CONTACT</a></li>
				  </ul>
				</div>
			  </div>
			</nav>	
		</div>
		<?php 
		$user_id=$_COOKIE['user_id'];
		
		if(logged_in()==true)
		{
			$total_mrp=0;
			$sql_get_cart=mysqli_query($con,"SELECT * FROM `cart` WHERE `user_id`=$user_id AND `status`=0");
			$count=mysqli_num_rows($sql_get_cart);
			if($count>0)
			{
				while($row_get_cart=mysqli_fetch_assoc($sql_get_cart))
				{
					$p_id=$row_get_cart['p_id'];
					$sql_get_mrp=mysqli_query($con,"SELECT `mrp` FROM `product` WHERE `p_id`=$p_id");
					$row_get_mrp=mysqli_fetch_assoc($sql_get_mrp);
					$mrp=$row_get_mrp['mrp'];
					$total_mrp=$total_mrp+$mrp;
				}
			}
			else
			{
				$total_mrp=0;
				$count=0;
			}
			
		}
		else
		{
			$random_code=$_COOKIE['random_user_code'];
			$total_mrp=0;
			$sql_get_cart=mysqli_query($con,"SELECT `p_id` FROM `cart_without_login` WHERE `random_user_id`=(SELECT `random_user_id` FROM `random_code_user` WHERE `random_number`='$random_code')");
			$count=mysqli_num_rows($sql_get_cart);
			if($count>0)
			{
				while($row_get_cart=mysqli_fetch_assoc($sql_get_cart))
				{
					$p_id=$row_get_cart['p_id'];
					$sql_get_mrp=mysqli_query($con,"SELECT `mrp` FROM `product` WHERE `p_id`=$p_id");
					$row_get_mrp=mysqli_fetch_assoc($sql_get_mrp);
					$mrp=$row_get_mrp['mrp'];
					$total_mrp=$total_mrp+$mrp;
					$count=$count;
				}
			}
			else
			{
				$total_mrp=0;
				$count=0;
			}
		}
		?>
		<div class="top_nav_right">
			<a href="checkout.php">
				<div class="cart box_1">
					<a href="checkout.php">
						<h3> 
							<i class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></i> <?php echo $count; if($count>1) echo 'items'; else ?> item
						</h3>
					</a>
					<h4 style="color:#fff;" ><?php 
					if($count==0)
						echo 'Empty';
					else
						echo 'Rs.'.$total_mrp;
					?></h4>
				</div>	
			</a>	
		</div>
		<div class="clearfix"></div>
	</div>
</div>