<?php
session_start();


include'../db.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
		<link rel="stylesheet" type="text/css" href="jquery.rateyo.css">
</head>
<body style="background-color: #cfcfcf;">
<div class="container">
            <h1 class="text-center text-info">Hotel Rating System   </h1>

<form action="rs.php" method="post">
        <div style="margin: 100px auto;width: 500px;height: 300px;background-color: #fafafa; border-radius: 10px;padding: 20px;border:2px solid #000;">
        <h1 class="text-center text-info">rate Hotel   </h1>
        <hr>
    <div class="rateyo"
         data-rateyo-rating="0"
         data-rateyo-num-stars="5"
         data-rateyo-score="4"></div>
         
         <span class='result'>0</span>
         <input id="s" type="hidden" class="r" name="r">
         <hr>

         <input type="submit" name="rate" class="btn btn-primary btn-block" value="rate student">

         <a href="../ourapp.php">go back</a>
</div> 





</div>
<div class="container" >
  <div class="panel panel-primary" style="text-align: center;">
    <div class="panel-heading">
      <h2>leave some words to us</h2>
    </div>
    <div class="panel-body">
      <input type="text" class="form-control" placeholder="user name " name="n"><br>
      <textarea type="text" placeholder="write some words to give us feedback" class="form-control" name="com"></textarea><br>
      <input type="submit" name="addcom" class="btn btn-primary btn-lg" value="add comment">
    </div>
  </div>
</div>

</form>
<?php




$trt=mysqli_query($con,"select * from comment");
if(mysqli_num_rows($trt)>0)
{
  while($row=mysqli_fetch_array($trt))
{
  echo'
<div class="container">
<div class="well">

<h1>'.$row['uname'].'</h1>

<h2>'.$row['com'].'</h2>

<p>'.$row['dt'].'</p>
</div>
</div>

  ';
}
}

else{
echo'<div class="container">
<div class="alert alert-danger">
<h2>no comment now</h2></div></div>
';
}

















$x=isset($_POST['r'])?$_POST['r']:'';
$n=isset($_POST['n'])?$_POST['n']:'';
$com=isset($_POST['com'])?$_POST['com']:'';
$dt=date("Y-m-d H:i:s");
$x=floatval(str_replace(',', '.', $x));

if(isset($_POST['rate']))
{


       $z=mysqli_query($con,"insert into rate(rate)values
    ('$x')");

if (isset($z)) {
   echo'<script> alert("rate App done...!");</script>';
}

 


}



if(isset($_POST['addcom']))
{


       $z=mysqli_query($con,"insert into comment(uname,com,dt)values
    ('$n','$com','$dt')");

if (isset($z)) {
   echo'<script> alert("add comment done...!");</script>';

   header("Location: rs.php");
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