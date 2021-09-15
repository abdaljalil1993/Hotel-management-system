<?php
session_start();


include'../conn.php';
$x1='';
$x2='';
if (isset($_GET['id']) ) 
  {$x1=$_GET['id'];

  } 

$r1=mysqli_query($conn,"select * from product where productid='$x1'");
$dd=mysqli_fetch_array($r1);
#if(isset($_GET['course']))
   # $co=$_GET['course'];


?>

<!DOCTYPE html>
<html>
<head>
	<title></title>

	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="jquery.rateyo.css">
</head>
<body style="background-color: #cfcfcf;">
<div class="container">
            <h1 class="text-center text-info" style="color: red">Product  Rating    </h1>

<form action="rc.php?c=<?php echo $x2; ?>&id=<?php echo $x1; ?>" method="post">
        <div style="margin: 100px auto;width: 500px;height: 400px;background-color: #fafafa; border-radius: 20px;padding: 20px;border:2px solid #000;">
        <h1 class="text-center text-info">rate Product : <?php echo $dd['product_name']; ?> </h1>
        <hr>
    <div class="rateyo"
         data-rateyo-rating="0"
         data-rateyo-num-stars="5"
         data-rateyo-score="4"></div>
         
         <span class='result'>0</span>
         <input id="s" type="hidden" class="r" name="r">
         <hr>

         <input type="submit" name="rate" class="btn btn-primary btn-block" value="rate Course">

         <a href="../student/EvaluationTeacher.php">go back</a>
</div> 
</form>

</div>
<?php
$x=isset($_POST['r'])?$_POST['r']:'';
#$sname=$dd['name'];
#$sid=$dd['uid'];
#$un=$dd['uname'];
#$tname=$_SESSION['name'];
#$tuid=$_SESSION['uid'];
#$tuname=$_SESSION['uname'];


$custid=$_SESSION['id'];


$x=floatval(str_replace(',', '.', $x));



if(isset($_POST['rate']))
{

$t=mysqli_query($conn,"select * from buyrate where uid='".$_SESSION['id']."' and pname='".$dd['product_name']."'");
if(mysqli_num_rows($t)>0)
{

$t=mysqli_query($conn,"select * from ratepro where pname='".$dd['product_name']."' and uid='".$_SESSION['id']."'");
if(mysqli_num_rows($t)>0)
{
echo'<script> alert("you have rated the product befor");</script>';
}
else{
  $f=mysqli_num_rows($t);
  echo $f;
       $z=mysqli_query($conn,"insert into ratepro(uid,pid,pname,rt)values
    ('".$_SESSION['id']."','".$dd['productid']."','".$dd['product_name']."','$x')");

if (isset($z)) {
   echo'<script> alert("rate product done...!");</script>';
}
 
}

}

else{
  echo'<script> alert("you can not rate this product because you are not buying  it");</script>';
}





}

?>


<script type="text/javascript" src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/jQuery.js"></script>
<script type="text/javascript" src="jquery.rateyo.js"></script>

<script type="text/javascript">
	

	$(function () {
  $(".rateyo").rateYo().on("rateyo.change", function (e, data) {
    var rating = data.rating;
  
    $(this).parent().find('.result').text('rating :'+ rating);
 
     $(this).parent().find('.r').attr('value',rating);
   });
});
</script>
</body>
</html>