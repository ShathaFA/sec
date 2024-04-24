<?php
include_once('heade.php');
$key = 'qkwjdiw239&&jdafweihbrhnan&"%Sggdnawhd4njshjwuuO';
function encryptthis($data, $key) {
$encryption_key = base64_decode($key);
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
$encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
return base64_encode($encrypted . '::' . $iv);
}
function decryptthis($data, $key) {
$encryption_key = base64_decode($key);
list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);}

if(isset($_POST['name'])){
$name=$_POST['name'];
$name=encryptthis($name, $key);
$email=$_POST['email'];
$email=encryptthis($email, $key);
echo'<p>Name:'.$name.'</p>';
echo'<p>Email:'.$email.'</p>';

mysqli_query($con,"INSERT INTO people(`name`, `email`)
VALUES ('$name','$email')");
echo'<div class="alert alert-success">You enter suESSFULY</div>';

}
?>

<form method="post">
  
<div class="form-group">
  <label for="name">Type name </label>
<input type="text" class="form-control" name="name">
</div>
<div class="form-group">
  <label for="email">Type email </label>
<input type="text" class="form-control" name="email">
</div>
<button type="submit" name="submit" class="btn btn.success btn-lg">Submit</button>
</form>
