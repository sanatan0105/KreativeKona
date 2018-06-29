<div style="margin-top:-20px;" class="header-bot">
	<div class="container-fluid">
		<center><div class="col-md-3 header-left">
			<a href="index.php"><img style="margin-left:-20px;"  src="images/logo4.jpg" width="45" height="65"><h6 style="margin-left:46px;color:red;">Kreative Kona</h6>
		</a></div></center>
		<div style="margin-left:-40px;" class="col-md-6 header-middle">
			<form>
				<div class="search">
					<input type="search" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}" required="">
				</div>
				<div class="section_room">
					<select id="country" onchange="change_country(this.value)" class="frm-field required">
						<option value="null">All categories</option>
						<option value="null">Category 1</option>     
						<option value="AX">Category 2</option>
						<option value="AX">Category 3</option>
						<option value="AX">Category 4</option>
						<option value="AX">Category 5</option>
					</select>
				</div>
				<div class="sear-sub">
					<input type="submit" value=" ">
				</div>
				<div class="clearfix"></div>
			</form>
		</div>
		<div class="col-md-3 header-right footer-bottom">
			<ul>
				<?php 
				if(logged_in()==false)
				{
					echo '<li><a href="#" class="use1" data-toggle="modal" data-target="#myModal4"><span>Login</span></a></li>';
				}
				else
				{
					echo '<li><a href="myprofile.php" class="use1" ><span>Profile</span></a></li>';
				}
				?>
				
				<li><a class="fb" target="_blank" href="https://www.facebook.com/Kreative-Kona-1588384024744478/"></a></li>
				<li><a class="twi" href="#"></a></li>
				<li><a class="insta" href="#"></a></li>
				<li><a class="you" href="#"></a></li>
				
			</ul>
		</div>
		<div class="clearfix"></div>
	</div>
</div>