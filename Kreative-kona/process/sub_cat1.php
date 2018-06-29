<select id="country1" name="sub_cat1" onchange="change_sub_cat(this.value)" class="frm-field required sect form-control">
<?PHP 
include ('../php/connect.php');
include('../php/functions.php');
$cat=sanitize($_POST['cat']);
$sql=mysqli_query($con,"SELECT DISTINCT(`subcategory`) FROM `cat_subcat` WHERE `category`='$cat'");
while($row=mysqli_fetch_assoc($sql))
{
	$sub_cat1=$row['subcategory'];
	?>
	<option value="<?php echo $sub_cat1; ?>"><?php echo $sub_cat1; ?></option>
	<?php 
}
?>
						
						
</select>



<div id="sub_cat2"></div>

<script>
function change_sub_cat(sub_cat2){
	
	
	
	if(sub_cat2){
		$.ajax({
			type:'POST',
			url:'process/sub_cat2.php',
			data:'sub_cat2='+sub_cat2,
			success:function(html){
				$('#sub_cat2').html(html);
			}
		}); 
	}
        
}
</script>
