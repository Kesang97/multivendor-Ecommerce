
<?php

@session_start();

if(!isset($_SESSION['customer_email'])){

echo "<script>window.open('../checkout.php','_self')</script>";

}

?>

<h1 align="center">Change Password </h1>

<form action="" method="post"><!-- form Starts -->

<div class="form-group"><!-- form-group Starts -->

<label>Enter Your Current Password</label>

<input type="text" name="old_pass" class="form-control" required>

</div><!-- form-group Ends -->


<div class="form-group"><!-- form-group Starts -->

<label>Enter Your New Password</label>

<input type="text" name="new_pass" class="form-control" required>

</div><!-- form-group Ends -->


<div class="form-group"><!-- form-group Starts -->

<label>Enter Your New Password Again</label>

<input type="text" name="new_pass_again" class="form-control" required>

</div><!-- form-group Ends -->

<div class="text-center"><!-- text-center Starts -->

<button type="submit" name="submit" class="btn btn-primary">

<i class="fa fa-user-md"> </i> Change Password

</button>

</div><!-- text-center Ends -->

</form><!-- form Ends -->
<?php

if(isset($_POST['submit'])){

$c_email = $_SESSION['customer_email'];

$old_pass = $_POST['old_pass'];

$new_pass = $_POST['new_pass'];

$new_pass_again = $_POST['new_pass_again'];

$encrypted_password = password_hash($new_pass_again, PASSWORD_DEFAULT);	

$select_customer = "select * from customers where customer_email='$c_email'";

$run_customer = mysqli_query($con,$select_customer);

$check_customer = mysqli_num_rows($run_customer);

$row_customer = mysqli_fetch_array($run_customer);

$hash_password = $row_customer["customer_pass"];

$check_old_pass = password_verify($old_pass, $hash_password);

if($check_old_pass == 0){
	
echo "<script>alert('Your Current Password is not valid try again')</script>";

exit();
	
}

if($new_pass!=$new_pass_again){

echo "<script>alert('Your New Password dose not match')</script>";

exit();

}

$update_pass = "update customers set customer_pass='$encrypted_password' where customer_email='$c_email'";

$run_pass = mysqli_query($con,$update_pass);

if($run_pass){

echo "<script>alert('Your Password Has been Changed Successfully')</script>";

echo "<script>window.open('my_account.php?my_orders','_self')</script>";

}

}

?>