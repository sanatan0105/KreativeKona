<?php 
include ('../php/connect.php');
include('../php/functions.php');
$cat=sanitize($_POST['sub_cat2']);
$sql=mysqli_query($con,"SELECT `sub_cat2` FROM `cat_subcat` WHERE `subcategory`='$cat'");
$cou=mysqli_num_rows($sql);
if($cou>1)
{
	?>
	</br>
	<div class="sign-in">
		<h4>Sub Category 2</h4>
		<select id="country1" name="sub_cat2" class="frm-field required sect form-control">
		<option></option>
	<?php 
	while($row=mysqli_fetch_assoc($sql))
	{
		$sub_cat2=$row['sub_cat2'];
		?>
		<option value="<?php echo $sub_cat2;?>" ><?php echo $sub_cat2; ?></option>
		<?php
	}
	?>
		</select>
	</div>
	
	<?php 
	 
}
else
{
	echo '<input type="hidden" name="sub_cat2" value="">';
}
?>


			
