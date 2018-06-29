<div class="modal fade" id="myModal4" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
				<div class="modal-dialog" role="document">
					<div class="modal-content modal-info">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>						
						</div>
						<div class="modal-body modal-spa">
							<div class="login-grids">
								<div class="login">
									<div class="login-bottom">
										<h3>Sign up for free</h3>
										<form method="post" action="register.php">
											<div class="sign-up">
												<h4>Email :</h4>
												<input type="text" name="email" value="Type here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">	
											</div>
											
											<div class="sign-up">
												<h4>Type :</h4>
												<select name="type">
													<option value="user">User</option>
													<option value="vendor">Vendor</option>
												</select>
											</div>
											
											</br>
											<div style="margin-top:10px;" class="sign-up">
												<input type="submit" value="REGISTER NOW" >
											</div>
										</form>
									</div>
									<div class="login-right">
										<h3>Sign in with your account</h3>
										<form method="post" action="login.php">
											<div class="sign-in">
												<h4>Email :</h4>
												<input name="login_email" type="text" value="Type here" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Type here';}" required="">	
											</div>
											<div class="sign-in">
												<h4>Password :</h4>
												<input name="login_pass" type="password" value="Password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}" required="">
											</div>
											<!--<div class="single-bottom">
												<input type="checkbox"  id="brand" value="">
												<label for="brand"><span></span>Remember Me.</label>
											</div>-->
											
											<div style="margin-top:10px;" class="sign-in">
												<input type="submit" value="SIGNIN" >
											</div>
										</form>
									</div>
									<div class="clearfix"></div>
								</div>
								<p >By logging in you agree to our <a href="#">Terms and Conditions</a> and <a href="#">Privacy Policy</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>