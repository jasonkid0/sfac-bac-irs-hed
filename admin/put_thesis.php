<?php 
ob_start();
include('../include/dbcon.php');
include 'header.php';
$get_id=$_GET['thesis_id'];?>


    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1></h1>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <div class="x_title">
                        <h2><i class="fa fa-pencil"></i> Archive Book</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
<?php
  $query=mysqli_query($con,"select * from special_collection where thesis_id='$get_id'")or die(mysqli_error($con));
$row=mysqli_fetch_array($query);
  ?>                       
                        <div class="box">
                            <div class="box-body">
                        <center><h3><strong>You are about to send this lists into "INACTIVE STATUS" </h3></center><br>
                        
                                <form method="post" enctype="multipart/form-data" onsubmit="return confirm('Are you sure you want to mark this as INACTIVE?');" class="form-horizontal form-label-left">
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <input type="hidden" name="book_id" id="last-name2" value="<?php echo $row['thesis_id']; ?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-4" for="call_no">Code Number
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="accession_no" value="<?php echo htmlspecialchars($row['accession_no']); ?>" id="call_no" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="title">Name of Student/s
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="nameofstudent" value="<?php echo htmlspecialchars($row['nameofstudent']); ?>" id="title" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                 <?php
                                  $query1=mysqli_query($con,"SELECT * from special_collection 
        LEFT JOIN categories ON categories.category_id = special_collection.category_id
        LEFT JOIN courses ON courses.course_id = special_collection.course_id 
                                  where thesis_id='$get_id'")or die(mysqli_error($con));
                                $row=mysqli_fetch_assoc($query1);
                                  ?>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="pop_id">Course
                                    </label>
                                    <div class="col-md-4">
                                        <select name="course" class="select2_single form-control" tabindex="-1" >
                                            <option value="<?php echo htmlspecialchars($row['course_id']); ?>"><?php echo htmlspecialchars($row['course_name']); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="subject_id">Title
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" id="title" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="pop_id">Category
                                    </label>
                                    <div class="col-md-4">
                                        <select name="category" class="select2_single form-control" tabindex="-1" >
                                            <option value="<?php echo htmlspecialchars($row['category_id']); ?>"><?php echo htmlspecialchars($row['categories']); ?></option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <input type="hidden" name="quantity" value="<?php echo htmlspecialchars($row['quantity']); ?>" step="1" min="0" max="1000">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-4" for="date_of_publ">Date
                                    </label>
                                    <div class="col-md-4">
                                        <input type="text" name="deyt" id="deyt" value="<?php echo htmlspecialchars($row['deyt']); ?>"  class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-4" for="last-name">Reason:</label>
                                    <div class="col-md-4">
                                        <select name="remarks" class="select2_single form-control" required="required" tabindex="-1" >
                                            <option value="Transferred">Transferred</option>
                                            <option value="Donated">Donated</option>
                                            <option value="Weeded">Weeded</option>
                                            <option value="Archived">Archived</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="ln_solid"></div>
                                <div class="form-group">
                                    <div class="col-md-9 col-sm-9 col-xs-12 col-md-offset-3">
                                        <a href="javascript: history.go(-1)"><button type="button" class="btn btn-primary"><i class="fa fa-times-circle-o"></i> Cancel</button></a>
                                        <button type="submit" name="update" class="btn btn-success"><i class="glyphicon glyphicon-save"></i> Archive</button>
                                    </div>
                                </div>
                            </form>
                            

                                      
                            
<?php

if (isset($_POST['update'])) {
                               
$accession_no = $_POST['accession_no'];
$nameofstudent=$_POST['nameofstudent'];
$course=$_POST['course'];
$title=$_POST['title'];
$category=$_POST['category'];
$deyt=$_POST['deyt'];
$quantity=$_POST['quantity'];
$remarks=$_POST['remarks'];
$oras = date('Y-m-d');



{

mysqli_query($con,"delete from special_collection where thesis_id = '$get_id' ")or die(mysql_error());
mysqli_query($con," INSERT INTO arc_special_collection (accession_no,nameofstudent,course_id,title,quantity,deyt,category_id,remarks,oras) VALUES ('$accession_no','$nameofstudent','$course','$title','$quantity','$deyt','$category','$remarks','$oras') ") or die(mysqli_error($con));
echo "<script>alert('Archiving Successful!');history.go(-2);</script>";  
}
                                    
}
?>
                            </div>
                        </div>
                        <!-- content starts here -->

                        
                        <!-- content ends here -->
                    </div>
                </div>
            </div>
        </div>
        </section>
        <!-- /.Left col -->
        
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>


<?php include 'script.php'; ?>
?>