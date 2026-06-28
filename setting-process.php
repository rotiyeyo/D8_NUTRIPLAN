<?php
session_start();

if (!empty($_POST))
{
  include('connection.php');

  $username    = $_SESSION['username_c'];
  $firstname   = $_POST['firstname'];
  $lastname    = $_POST['lastname'];
  $email       = $_POST['email'];
  $phonenumber = $_POST['phonenumber'];

  $sql = "UPDATE customer_data SET firstname_c = '".$firstname."', lastname_c = '".$lastname."', email_c = '".$email."', phonenum_c = '".$phonenumber."' WHERE username_c = '".$username."'";

  $do_query = mysqli_query($condb, $sql);

  if ($do_query)
  {
    echo "<script>alert('Your information has been updated!');
    window.location.href = 'setting.php';</script>";
  }
  else
  {
    die("<script>alert('Failed to update. Please try again.');
    window.location.href = 'setting.php';</script>");
  }
}
else
{
  echo "<script>window.location.href = 'setting.php';</script>";
}
?>