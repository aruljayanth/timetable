<?php
session_start();
ob_start();
//echo "<h2>One step away to enter the world ---Stay Connected</h2>";
$conn = new mysqli("localhost:3306","root","","timetable");
    if($conn->connect_error)
    die("not connected:".$conn->connect_error);

  

if (isset($_POST['submit'])){
    

    $teacher_id = mysqli_real_escape_string($conn, $_REQUEST['t_num']);
    $_SESSION['teacher_id']=$teacher_id;
    $course_id = mysqli_real_escape_string($conn, $_REQUEST['c_id']);
    $_SESSION['course_id']=$course_id;
    //$sections = mysqli_real_escape_string($conn, $_REQUEST['section']);
    $year = mysqli_real_escape_string($conn, $_REQUEST['year']);
    $_SESSION['year']=$year;
    $department_name = mysqli_real_escape_string($conn, $_REQUEST['d_name']);
    $_SESSION['department_name']=$department_name;
    header("Location:select_section.php");

    
    
}
$akash="SELECT distinct teacher_name,teacher_id FROM teacher order by teacher_name";
$get=mysqli_query($conn, $akash);
$options = '';
while($row = mysqli_fetch_assoc($get))
{
  $options .= '<option value = "'.$row['teacher_id'].'">'.$row['teacher_name']." (".$row['teacher_id'].")".'</option>';
}
$akash="SELECT distinct course_name,course_id FROM course order by course_name";
$get=mysqli_query($conn, $akash);
$options1 = '';
while($row = mysqli_fetch_assoc($get))
{
  $options1 .= '<option value = "'.$row['course_id'].'">'.$row['course_name']." (".$row['course_id'].")".'</option>';
}



$get_department_name="SELECT department_name FROM department";
$get=mysqli_query($conn, $get_department_name);
$option = '';
while($row = mysqli_fetch_assoc($get))
{
$option .= '<option value = "'.$row['department_name'].'" type="submit" name="submit3">'.$row['department_name'].'</option>';
}



/*if(isset($department_name)){
  if(isset($year)){
    $section="SELECT distinct  section FROM student where department_name='$department_name' and year='$year'";
if($get=mysqli_query($conn, $section)){
$options = '';
while($row = mysqli_fetch_assoc($get))
{
  $options .= '<option value = "'.$row['section'].'">'.$row['section'].'</option>';
}
}
else { 
    echo "ERROR: Could not able to execute $sql. "
                                .mysqli_error($conn); 
} 
}
}*/


mysqli_close($conn);



ob_flush();
?>



<!DOCTYPE html>
<html lang="en">
<head>
	<title>Faculty</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="faculty.css">
    <style type="text/css">
    body{

background-color: #01579B;
  background-repeat: no-repeat;
  background-size:cover;
  
}
.container{
  background-color: #B3E5FC;
}
.bg1-image {
  /* The image used */
  background-image: url("images/c2.jpg");
  
      /* Add the blur effect */
 
  
  
  /* Full height */
  padding-bottom: 7%;
  height: 50%; 
  width: 100%;
  position:relative;
  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  }
  .s{
    margin-left: 40%;
    margin-right: 8%;
    align-content: center;
    font-style: bold;
    font-size: 60px;
    color: black;
  }
  .t1{
    margin-left: 4%;
    margin-right: 8%;
    font-style: bold;
    font-size: 30px;
    color: black;
  }
  .si{
    margin-left: 8%;
    margin-right: 10%;
    align-content: center;
    font-style: bold;
    font-size: 15px;
    color: white;
  }
        .bg-image {
  /* The image used */
  background-image: url("images/b.png");
  border-radius: 50px;
  margin-bottom: 50px;
      /* Add the blur effect */
 
  
  
  /* Full height */
  height: 10%; 
  width: 90%;
  margin-left: 5%;
  padding-top: 1%;
  margin-top: 5%;
  padding-bottom: 10%;
  position:relative;
  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
  }
  </style>
</head>
<body class="bg1-image">
<div class="bg-image">
		<h1 class="s" > Add  Details </h1>
		<hr size="20" width="75%" align="center" color="green">
		<label class="t1"for="type"  ><strong>Enter the Particulars :</strong></label>
		<form name="forms" action="" method="POST">
		<div class="form-row">
			<div class="si col-md-10">
				<label for="dname">Teacher Name</label>
                <select class="form-control" id="d_name" name="t_num" placeholder="choose" required >
                  <option value="" disabled selected>Choose</option>
                  <?php echo $options; ?>
                </select>
                <br>
				</div> 
				<div class="si col-md-10">
				<label for="dname">Course Name</label>
                <select class="form-control" id="d_name" name="c_id" placeholder="choose" required >
                  <option value="" disabled selected>Choose</option>
                  <?php echo $options1; ?>
                </select>
                <br>
				</div> 


            <div class="si col-md-10">
                <label for="dname">Department Name</label>
                <select class="form-control" id="d_name" name="d_name" placeholder="choose" required>
                	<option value="" disabled selected>Choose</option>
                	<?php echo $option; ?>
                </select>
                <br>

                
            </div>
            <div class="si col-md-10">
                <label for="years">Year</label>
                <select class="form-control" id="year" name="year" placeholder="choose" required>
                  <option value="" disabled selected>Choose</option>
                  <option value="1">first</option>
                  <option value="2">second</option>
                  <option value="3">third</option>
                  <option value="4">fourth</option>
                </select>
                
                <br>
                
            </div>
            <div class="form-group col-md-12">
      <div class=" modal-footer d-flex center-block justify-content-center ">
        <button class="btn btn-default" type="submit1" name="submit">Next</button>
      </div>
  </div>
            
            
         
         </div>
        </div>
    </form>
    </div>
</body>
</html>