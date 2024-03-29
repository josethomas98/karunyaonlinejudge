<?php

session_start();

require_once("config.php");

$_SESSION['url'] = $_SERVER['REQUEST_URI'];

if(!isset($_SESSION["un"]))
{
	header("Location:login.php");
}

if(isset($_SESSION['un']))
{
	$username=$_SESSION['un'];
}





?>


<!DOCTYPE html>
<html>
<head>
  
    
<style type="text/css" media="screen">
   

    #editor {
      font-weight: bold;
       width: 620px;
       height:250px;
       font-size: 15px;
       border-radius: 10px;
    }
  </style>

        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Home</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="icon" type="image/png" href="img/ruet.png">
        <script src="js/vendor/modernizr-2.8.3.min.js"></script>
        <script src="js/vendor/jquery-1.12.0.min.js"></script>
        <script src="bootstrap-3.3.7/js/bootstrap.min.js"> </script>
        <script src="bootstrap-3.3.7/js/bootstrap.js"> </script>






</head>
<body>
<div class="main">

  <div class="row">
  <div class="col-sm-12">
  <nav class="shadow navbar navbar-inverse navbar-fixed-top nbar">
    <div class="navbar-header">
      <a class="navbar-brand lspace" href="home.php">Karunya OJ</a>
       <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-menubuilder"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>
    </div>
    <div class="collapse navbar-collapse navbar-menubuilder">
    <ul class="nav navbar-nav">
      <li class="space"><a href="compiler.php"><i class="fa fa-code ispace"></i>Compiler</a></li>
      <li class="space"><a href="archive.php"><i class="fa fa-archive ispace"></i>Problem Archive</a></li>
      <li class="space"><a href="contest.php"><i class="fa fa-cogs ispace"></i>Contests</a></li>
      <li class="space"><a href="#"><i class="fa fa-check-square ispace"></i>Debug</a></li>
      <li class="lgspace space"><a href="profile.php?user=<?php echo("$username"); ?>"><i class="fa fa-user ispace"></i><?php echo("$username"); ?></a></li>
      <li class="space"><a href="logout.php"><i class="fa fa-power-off ispace"></i>Logout</a></li>
      
    </ul>
    </div>
</nav>
</div>
</div>


<div class="row log">
<div class="col-sm-10">
<div class=""><h3 style="text-align:center;">Online Compiler</h3></div>
</div>

<div class="col-sm-1">

</div>

<div class="col-sm-1">
  
</div>

</div>



<?php

echo"
<div class='row cspace'>
<div class='col-sm-8'>
<div class='form-group'>
<form action='compile.php' name='f2' method='POST'>
<label for='language'>Choose Language</label>

<select class='form-control' name='language'>
<option value='c'>C</option>
<option value='cpp'>C++</option>
<option value='cpp11'>C++11</option>
<option value='java'>Java</option>
<option value='Python2.7'>Python2.7</option>
<option value='Python3.2'>Python3.2</option>
  

</select><br><br>

<label for='ta'>Write Your Code</label><br>
<!--<textarea class='form-control' name='code' rows='10' cols='50'></textarea><br><br>-->
<div id='editor'></div>";
$script = file_get_contents('src-noconflict/ace.js');
echo "<script>".$script."</script>";
$script2 = file_get_contents('src-noconflict/theme-dracula.js');
echo "<script>".$script2."</script>";
$script1 = file_get_contents('src-noconflict/mode-python.js');
echo "<script>".$script1."</script>";
echo "<script>
    var editor = ace.edit('editor');
    editor.setTheme('ace/theme/dracula');
    editor.session.setMode('ace/mode/python');
    function foo()
    {
      document.getElementById('coder').value=editor.getValue();

    }
</script>

<input type=hidden name='code' id='coder'><br><br>
<label for='in'>Enter Your Input</label>
<textarea class='form-control' name='input' rows='10' cols='50'></textarea><br><br>
<input type='submit' class='btn btn-success' value='Run Code' onclick='foo()'><br><br><br>

";?>

</form>

<!--<script>
"use strict";
function submitForm(oFormElement)
{
  var xhr = new XMLHttpRequest();
  var display=document.getElementById('div');
  xhr.onload = function(){ display.innerHTML=xhr.responseText; }
  xhr.open (oFormElement.method, oFormElement.action, true);
  xhr.send (new FormData (oFormElement));
  return false;
}
</script>-->
<!--<label for="out">Output</label>
<textarea id='div' class="form-control" name="output" rows="10" cols="50"></textarea><br><br>-->




</div>
</div>

<div class="col-sm-4">
    <div style="margin-left:20px" class="pb">Recent And Upcoming Contests</div>

<?php

require_once("connection.php");
date_default_timezone_set("Asia/Dhaka");

$q3="SELECT * FROM rapl_oj_contest ORDER BY date_on DESC LIMIT 0,2";
    $sq3=mysqli_query($con,$q3);

        $q4="SELECT TIME_FORMAT(end_at,'%H') end_at FROM rapl_oj_contest  ORDER BY date_on DESC";
       $q5="SELECT TIME_FORMAT(end_at,'%i') end_at FROM rapl_oj_contest  ORDER BY date_on DESC";
        $q6="SELECT TIME_FORMAT(end_at,'%s') end_at FROM rapl_oj_contest  ORDER BY date_on DESC";

      $sq4=mysqli_query($con,$q4);
      $sq5=mysqli_query($con,$q5);
      $sq6=mysqli_query($con,$q6);
      

      
   
  while($row=mysqli_fetch_array($sq3))
    {
      $d=date("Y-m-d");
      $t=date("H:i:s");
      $m=$row['start_at'];

      $nr=mysqli_fetch_array($sq4);
      $nm=mysqli_fetch_array($sq5);
      $ns=mysqli_fetch_array($sq6);
      
      $shr=$nr['end_at'];
      $shm=$nm['end_at'];
      $shs=$ns['end_at'];
      $cur=date('H');
      $curm=date('i');
      $curs=date('s');

      $h=$shr-$cur;
      $mt=$shm-$curm;
      $scnd=$shs-$curs;

      if($scnd<0)
      {
         $scnd=$scnd+60;
         $mt=$mt-1;
      }

      if($mt<0)
      {
        $mt=$mt+60;
        $h=$h-1;
      }

      if($h<0)
      {
        $h=$h+24;
      }
      
      $en=$row['end_at'];

      $seconds = strtotime($t) - strtotime($m);
      $ss= strtotime($en) - strtotime($t);
      $min=intval($seconds/60);
      $sec=intval($seconds%60);
      $hr=intval($min/60);
      $m=intval($min%60);

     


      

     
      


     
      /*echo(" <a href=\"save.php?name=$row[table_name]\">$row[table_name]</a><br><br>");*/
        if($row['date_on']==$d && $seconds>=0 && $ss>=0 )
        {
             echo("<div class=\"xmm\">Contest Name: <a href=\"contestproblem.php?name=$row[cname]\">$row[cname]</a><br><br>Contest Date: $row[date_on] <br><br>Start Time: $row[start_at]<br><br>End Time: $row[end_at] <br><br> Status: <b>Running</b> <br><br>Time Remaining:  $h hour $mt miniute $scnd second <br><br></div>");
         }
         else if($d>$row['date_on'] || ($d==$row['date_on'] && $t>$en))
         {
            echo("<div class=\"xmm\">Contest Name: <a href=\"contestproblem.php?name=$row[cname]\">$row[cname]</a><br><br>Contest Date:  $row[date_on] <br><br>Start Time: $row[start_at]<br><br>End Time: $row[end_at] <br><br>Status: <b>Finished</b><br><br></div>");
         }
         else
         {
            echo("<div class=\"xmm\">Contest Name: $row[cname]<br><br>Contest Date:  $row[date_on] <br><br>Start Time: $row[start_at]<br><br>End Time: $row[end_at] <br><br>Status: <b>Not Started Yet</b><br><br></div>");
         }
    }




?>
  
</div>
</div>
</div>
<br><br><br>
<div class="area">
<div class="well foot">
<div class="row area">
<div class="col-sm-3">
<!-- BEGIN: Powered by Supercounters.com -->
<center><script type="text/javascript" src="http://widget.supercounters.com/online_i.js"></script><script type="text/javascript">sc_online_i(1360839,"ffffff","e61c1c");</script><br><noscript><a href="http://www.supercounters.com/">Free Online Counter</a></noscript>
</center>
<!-- END: Powered by Supercounters.com -->

</div>

<div class="col-sm-5">


<div class="">

<b>Beta Version-2019</b><br>
<b>Developed By CTC</b>

</div>
</div>


<div class="col-sm-4">
<?php
//date_default_timezone_set("Asia/Dhaka");
 //$t=date("H:i:s");
//echo"<b>Server Time:  $t</b>";

require_once("time.php");


?>
</div>
</div>
</div>
</div>
</body>
</html>


