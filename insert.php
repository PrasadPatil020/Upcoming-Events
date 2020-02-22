<?php
session_start();
include 'conn.php';

if (($_SESSION['email'] != 'admin@admin.com') )
{
 header("Location:login.php");
}
 
 // date_default_timezone_set('Asia/Calcutta'); 

if(isset($_POST['done'])){
  $fileName = $_FILES['attachment']['name'];
  $tempName = $_FILES['attachment']['tmp_name'];
    
  if(isset($fileName))
     {
       if(!empty($fileName))
       {
             $location = "img/";
             if(move_uploaded_file($tempName, $location.$fileName))
             {
                  header("Location:display.php");
				
           }
        }
  }
 
   $title   = $_POST['title']; 
   $startdate = $_POST['startdate'];
   $enddate = $_POST['enddate'];
   $category = $_POST['category'];
   $location = $_POST['location'];
   $description = $_POST['description'];

 $q = "INSERT INTO insertevent"."(title,startdate,enddate,category,location,attachment,description)"."VALUES"."( '$title','$startdate','$enddate','$category','$location','$fileName','$description')";
 
 $result=$conn->query($q);

  if ($result==true) 
  {
    # code...
    $message = "Data Inserted Successfully...!";
echo "<script type='text/javascript'>alert('$message');</script>";
  }
  else
  {
    echo "Error".$q."<br>".$conn->error;
  }
  $conn->close();
  }
?>

<!DOCTYPE html>
<html>
<head>
 <title></title>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<?php 
include 'includes/header.php';
include 'includes/navbar.php';

?>
<body>

 <div class="col-lg-6 m-auto">
 
 <form method="post" enctype="multipart/form-data">
 
 <br><br><div class="card">
 
 <div class="card-header bg-dark">
 <h4 class="text-white text-center">Upcoming Events</h4>
 </div><br>
 
   <label>Title</label>
 <input required placeholder="Enter Title" type="text" name="title"  class="form-control"> <br>
 
 <label>Enter Start Date</label>
 <input required placeholder="Enter start Date" type="date" name="startdate"  class="form-control"> <br>
 
 <label>Enter End Date</label>
 <input required placeholder="Enter End Date" type="date" name="enddate"  class="form-control"> <br>
 
 <label>Enter Category</label>
 <input required placeholder="Enter Category" type="text" name="category"  class="form-control"> <br>

<label>Enter Location</label>
 <input required placeholder="Enter Location" type="text" name="location"  class="form-control"> <br> 
 
  <label>Attachment</label>
  <input type="file" name="attachment" required class="form-control"><br>

 <label>Enter Description</label>
 <input required placeholder="Enter Description" type="text" name="description"  class="form-control"> <br>  

 <button class="btn btn-success" type="submit" name="done"> Submit </button><br>

 </div>
 </form>
 </div>
</body>
</html>
<?php
include 'includes/footer.php';
?>