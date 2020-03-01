<?php
session_start();
error_reporting(0);
include('include/config.php');
include('include/checklogin.php');
check_login();
if(isset($_POST['submit']))
  {
    
    $vid=$_GET['viewid'];
    $height=$_POST['height'];
    $weight=$_POST['weight'];
    $anaemia=$_POST['anaemia'];
    $edema=$_POST['edema'];
    $blood=$_POST['blood'];
    $hiv=$_POST['hiv'];
    $fheight=$_POST['fheight'];
    $fheart=$_POST['fheart'];
   
 
      $query.=mysqli_query($con, "insert   tblmedicalhistory(PatientID,height,weight,anaemia,edema,bloodpressure,hiv,fheight,fheart)value('$vid','$height','$weight','$anaemia','$edema','$blood', '$hiv', '$fheight','$fheart')");
    if ($query) {
    echo '<script>alert("Medicle history has been added.")</script>';
    echo "<script>window.location.href ='book_appointment.php?patient_id=$vid;'</script>";
  }
  else
    {
      echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }

  
}

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Doctor | Manage Patients</title>
		
		<link href="http://fonts.googleapis.com/css?family=Lato:300,400,400italic,600,700|Raleway:300,400,500,600,700|Crete+Round:400italic" rel="stylesheet" type="text/css" />
		<link rel="stylesheet" href="vendor/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="vendor/fontawesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="vendor/themify-icons/themify-icons.min.css">
		<link href="vendor/animate.css/animate.min.css" rel="stylesheet" media="screen">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.min.css" rel="stylesheet" media="screen">
		<link href="vendor/switchery/switchery.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet" media="screen">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-datepicker/bootstrap-datepicker3.standalone.min.css" rel="stylesheet" media="screen">
		<link href="vendor/bootstrap-timepicker/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
		<link rel="stylesheet" href="assets/css/styles.css">
		<link rel="stylesheet" href="assets/css/plugins.css">
		<link rel="stylesheet" href="assets/css/themes/theme-1.css" id="skin_color" />
	</head>
	<body>
		<div id="app">		
<?php include('include/sidebar.php');?>
<div class="app-content">
<?php include('include/header.php');?>
<div class="main-content" >
<div class="wrap-content container" id="container">
						<!-- start: PAGE TITLE -->
<section id="page-title">
<div class="row">
<div class="col-sm-8">
<h1 class="mainTitle">Manage Patients</h1>
</div>
<ol class="breadcrumb">
<li>
<span>Doctor</span>
</li>
<li class="active">
<span>Manage Patients</span>
</li>
</ol>
</div>
</section>
<div class="container-fluid container-fullw bg-white">
<div class="row">
<div class="col-md-12">
<h5 class="over-title margin-bottom-15">Manage <span class="text-bold">Patients</span></h5>
<?php
                               $vid=$_GET['viewid'];
                               $ret=mysqli_query($con,"select * from patients where patients_id='$vid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
                               ?>
<table border="1" class="table table-bordered">
 <tr align="center">
<td colspan="4" style="font-size:20px;color:blue">
 Patient Details</td></tr>

    <tr>
    <th scope>Firstname</th>
    <td><?php  echo $row['firstname'];?></td>
    <th scope>Lastname</th>
    <td><?php  echo $row['lastname'];?></td>
  </tr>
  <tr>
    <th scope>Contact</th>
    <td><?php  echo $row['phone'];?></td>
    <th>National ID</th>
    <td><?php  echo $row['national_id'];?></td>
  </tr>
    <tr>
    <th>Gender</th>
    <td><?php  echo $row['gender'];?></td>
    <th>Patient Age</th>
    <td><?php  echo $row['patient_age'];?></td>
  </tr>
 
<?php }?>
</table>
<?php  

$ret=mysqli_query($con,"select * from tblmedicalhistory  where PatientID='$vid'");



 ?>
<table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
  <tr align="center">
   <th colspan="11" >Medical History</th> 
  </tr>
  <tr>
    <th>Visitations</th>
    <th>Patients ID</th>
<th>Height(cm)</th>
<th>Weight(kg)</th>
<th>Anaemia</th>
<th>Edema(mm)</th>
<th>Blood Pressure</th>
<th>HIV status</th>
<th>Fundal Height</th>
<th>Heart Sound</th>
<th>Visit Date</th>

</tr>
<?php  
while ($row=mysqli_fetch_array($ret)) { 
  ?>
<tr>
  <td><?php echo $cnt;?></td>
  <td><?php  echo $row['PatientID'];?></td>
 <td><?php  echo $row['height'];?></td>
 <td><?php  echo $row['weight'];?></td>
 <td><?php  echo $row['anaemia'];?></td> 
  <td><?php  echo $row['edema'];?></td>
  <td><?php  echo $row['bloodpressure'];?></td>
  <td><?php  echo $row['hiv'];?></td> 
  <td><?php  echo $row['fheight'];?></td>
  <td><?php  echo $row['fheart'];?></td>
  <td><?php  echo $row['CreationDate'];?></td> 
</tr>
<?php $cnt=$cnt+1;} ?>
</table>

<p align="center">                            
 <button class="btn btn-primary waves-effect waves-light w-lg" data-toggle="modal" data-target="#myModal">Add Medical History</button></p>  

<?php  ?>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
     <div class="modal-content">
      <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add Medical History</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                <table class="table table-bordered table-hover data-tables">

                                 <form method="post" name="submit">

      <tr>
    <th>Height :</th>
    <td>
    <input name="height" placeholder="Height" class="form-control wd-450" required="true"></td>
  </tr>                          
     <tr>
    <th>Weight :</th>
    <td>
    <input name="weight" placeholder="weight" class="form-control wd-450" required="true"></td>
  </tr> 
  <tr>
    <th>Anaemia :</th>
    <td>
    <input name="anaemia" placeholder="Anaemia" class="form-control wd-450" required="true"></td>
  </tr>
  <tr>
    <th>Edema :</th>
    <td>
    <input name="edema" placeholder="Edema" class="form-control wd-450" required="true"></td>
  </tr>
  <tr>
    <th>Blood Pressure :</th>
    <td>
    <input name="blood" placeholder="Blood Pressure" class="form-control wd-450" required="true"></td>
  </tr>
  <tr>
    <th>HIV status :</th>
    <td>
<select class="form-control" name="hiv">
  <option value="positive">Positive</option>
  <option value="negative">Negative</option>
</select></td>
  </tr>
     <tr>
    <th>Fundal height :</th>
    <td>
    <input name="fheight" placeholder="Fundal Height" class="form-control wd-450" required="true"></td>
  </tr>
  <tr>
    <th>Fetal Heart Sound  :</th>
    <td>
    <input name="fheart" placeholder="Fetal heart sound" class="form-control wd-450" required="true"></td>
  </tr>                 
   
</table>
</div>
<div class="modal-footer">
 <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 <button type="submit" name="submit" class="btn btn-primary">Submit</button>
  
  </form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
			<!-- start: FOOTER -->
	<?php include('include/footer.php');?>
			<!-- end: FOOTER -->
		
			<!-- start: SETTINGS -->
	<?php include('include/setting.php');?>
			
			<!-- end: SETTINGS -->
		</div>
		<!-- start: MAIN JAVASCRIPTS -->
		<script src="vendor/jquery/jquery.min.js"></script>
		<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
		<script src="vendor/modernizr/modernizr.js"></script>
		<script src="vendor/jquery-cookie/jquery.cookie.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script src="vendor/switchery/switchery.min.js"></script>
		<!-- end: MAIN JAVASCRIPTS -->
		<!-- start: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<script src="vendor/maskedinput/jquery.maskedinput.min.js"></script>
		<script src="vendor/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
		<script src="vendor/autosize/autosize.min.js"></script>
		<script src="vendor/selectFx/classie.js"></script>
		<script src="vendor/selectFx/selectFx.js"></script>
		<script src="vendor/select2/select2.min.js"></script>
		<script src="vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
		<script src="vendor/bootstrap-timepicker/bootstrap-timepicker.min.js"></script>
		<!-- end: JAVASCRIPTS REQUIRED FOR THIS PAGE ONLY -->
		<!-- start: CLIP-TWO JAVASCRIPTS -->
		<script src="assets/js/main.js"></script>
		<!-- start: JavaScript Event Handlers for this page -->
		<script src="assets/js/form-elements.js"></script>
		<script>
			jQuery(document).ready(function() {
				Main.init();
				FormElements.init();
			});
		</script>
		<!-- end: JavaScript Event Handlers for this page -->
		<!-- end: CLIP-TWO JAVASCRIPTS -->
	</body>
</html>
