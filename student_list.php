<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
  </head>
  <body>

<?php
session_start();

include('include/header.php');
include('include/navbar.php');
include('include/scripts.php');
?>

<!-- MODAL -->
<div class="modal fade" id="studentprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Student</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="code_student.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> ID # </label>
                <input type="text" name="id_num" class="form-control" placeholder="Enter ID #">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" name="last_name" class="form-control" placeholder="Enter Last Name">
            </div>
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="first_name" class="form-control" placeholder="Enter First Name">
            </div>
            <div class="form-group">
                <label>Middle Name</label>
                <input type="text" name="middle_name" class="form-control" placeholder="Enter Middle Name">
            </div>
            <div class="form-group">
                <label>Class</label>
                <input type="text" name="class" class="form-control" placeholder="Enter Class">
            </div>

        </div>
        <div class="modal-footer">
            <button type="submit" name="registerbtn" class="btn btn-primary">Save</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">

<!-- DataTales Example -->
<div class="card shadow mb-4">

  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">List of Student
            <button type="button" class="btn btn-primary btn-block btn-sm col-sm-2 float-right" data-toggle="modal" data-target="#studentprofile">
              <i class="fa fa-plus"></i> New Student
            </button>
    </h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">

    <?php
      $connection = mysqli_connect("localhost","root","","project_db");

      $query = "SELECT * FROM student_list";
      @$query_run = mysqli_query($connection, $query);
    ?>

      <table id="datatableid" class="table table-bordered table-dark" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>#</th>
            <th>ID #</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th>Class</th>
            <th class="text-center">Action</th>
            
          </tr>
        </thead>
        <tbody>

        <?php
          $i = 1;
          if(mysqli_num_rows($query_run) > 0){
            while($row = mysqli_fetch_assoc($query_run)){
              ?>
          <tr>
            <td>
              <?php echo $i++ ?>
            </td>
            <td>
              <p><?php echo $row['id_num']; ?></p>
            </td>
            <td>
              <p><?php echo $row['last_name']; ?></p>
            </td>
            <td>
              <p><?php echo $row['first_name']; ?></p>
            </td>
            <td>
              <p><?php echo $row['middle_name']; ?></p>
            </td>
            <td>
              <p><?php echo $row['class']; ?></p>
            </td>

            <td class="text-center">
              <form action="manage_student.php" class="btn btn-sm" method="post">
                <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                <button  type="submit" name="edit_btn" class="btn btn-success"> EDIT</button>
              </form>
              
              <form action="code_student.php" class="btn btn-sm" method="post">
                <a href="javascript:void(0)"></a>
                <input type="hidden" class="delete_id_value" name="delete_id" value="<?php echo $row['id']; ?>">
                <button type="submit" name="delete_btn" class="delete_btn_ajax btn btn-danger"> DELETE</button>
              </form>
            </td>
           

          </tr>
          <?php
        }
      }else{
        echo "No Record Found";
      }
    ?>


        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script>

$(document).ready(function() {

    $('#datatableid').DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [
        [10, 25, 50, -1],
        [10, 25, 50, "ALL"]
      ],
      responsive: true,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Search records",
      }
    });

} );

</script>

</body>
</html>