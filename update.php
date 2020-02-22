<?php
session_start();
if (($_SESSION['email'] == '') ){ 
   header("Location: index.php");
}
 include 'conn.php';

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

   $id = $_GET['id'];
   $title   = $_POST['title']; 
   $startdate = $_POST['startdate'];
   $enddate = $_POST['enddate'];
   $category = $_POST['category'];
   $location = $_POST['location'];
   $description = $_POST['description'];


 $q = "update insertevent set title='$title', startdate='$startdate' , enddate='$enddate' , category='$category' , location='$location' , attachment = '$fileName' , description='$description' where id=$id  ";

 $query = mysqli_query($conn,$q);

 header('location:display.php');
 }

?>

<?php
if(isset($_POST['done'])){

// if in present id (attachment is empty then fill attachment with current filename)
$curr_fileName = $_POST['current_attachment'];
$eid = $_POST['id'];
$q = "update insertevent set  attachment = '$curr_fileName' where id='$eid' and attachment='' ";
$query = mysqli_query($conn,$q);
 header('location:display.php');
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
 <?php
 $id = $_GET['id'];
 $q ="select * from insertevent where id=$id";


 $query = mysqli_query($conn,$q);

 while($res = mysqli_fetch_array($query)){
	 ?>
 <form  method="post" enctype="multipart/form-data">
 
 <br><br><div class="card">
 
 <div class="card-header bg-dark">
 <h1 class="text-white text-center"> Update Upcoming Events </h1>
 </div><br>

 <label> Title</label>
 <input required placeholder="Enter Title" type="text" name="title"  value="<?php echo $res['title']; ?>" class="form-control"> <br>

 <label>Enter Start Date</label>
 <input required placeholder="Enter start Date" type="date" name="startdate" value="<?php echo $res['startdate']; ?>" class="form-control"> <br>
 
 <label>Enter End Date</label>
 <input required placeholder="Enter End Date" type="date" name="enddate" value="<?php echo $res['enddate']; ?>" class="form-control"> <br>
 
 <label>Enter Category</label>
 <input required placeholder="Enter Category" type="text" name="category" value="<?php echo $res['category']; ?>" class="form-control"> <br>

<label>Enter Location</label>
 <input required placeholder="Enter Location" type="text" name="location" value="<?php echo $res['location']; ?>" class="form-control"> <br> 
 
  <label>Attachment</label>
  <input type="hidden" name="id" value="<?php echo $res['id']; ?>">
  <input type="hidden" name="current_attachment" value="<?php echo $res['attachment']; ?>">
  <input type="file" name="attachment" class="form-control" value="<?php echo $res['attachment']; ?>" class="form-control"><br>

 <label>Enter Description</label>
 <input required placeholder="Enter Description" type="text" name="description" value="<?php echo $res['description']; ?>" class="form-control"> <br>  

 <button class="btn btn-success" type="submit" name="done"> Submit </button><br>
 <?php } ?>
 </div>
 </form>
 </div>
</body>
</html>



<?php
include 'includes/footer.php';
?>