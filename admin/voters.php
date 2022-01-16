<?php include 'includes/session.php'; ?>

<?php include 'includes/header.php'; ?>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <?php include 'includes/navbar.php'; ?>
        <?php include 'includes/menubar.php'; ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Voters List
                </h1>
                <ol class="breadcrumb">
                    <li><a href="home.php"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Voters</li>
                </ol>
            </section>
            <!-- Main content -->
            <section class="content">



            <?php include 'import.php'; ?>

                  <?php


                  if(!empty($_GET['status'])){
                      switch($_GET['status']){
                        case 'succ':
                            $statusType = 'alert-success';
                            $statusmsg = 'Voters data has been imported Successfully';
                            break;
                        case 'err':
                            $statusType = 'alert-danger';
                            $statusmsg = 'Some problem occured, please try again later';
                            break;
                        case 'invalid_file':
                            $statusType = 'alert-danger';
                            $statusmsg = 'Please Upload a valid CSV file';
                            break;
                        default:
                            $statusType = '';
                            $statusmsg = '';
                      }
                  }
                  ?>



                <?php
                if (isset($_SESSION['error'])) {
                  echo "
            <div class='alert alert-danger alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-warning'></i> Error!</h4>
              " . $_SESSION['error'] . "
            </div>
          ";
                  unset($_SESSION['error']);
                }
                if (isset($_SESSION['success'])) {
                  echo "
            <div class='alert alert-success alert-dismissible'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
              <h4><i class='icon fa fa-check'></i> Success!</h4>
              " . $_SESSION['success'] . "
            </div>
          ";
                  unset($_SESSION['success']);
                }
                ?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class = "col"
                        <div class="box">
                            <div style="display: flex" class="box-header with-border">
                                <a href="#addnew" data-toggle="modal" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-plus"></i> New</a>
                                <div class = "col-xs-12">
                                <button style = "float:right;" type = "button" data-toggle="modal" data-target = "#import" class = "btn btn-info btn-sm btn-flat"><i class  = "glyphicon glyphicon-import"></i> Import</button>
                                </div>
                            </div>
                           
                            <div class="box-body">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <th>Lastname</th>
                                        <th>Firstname</th>
                                        <th>Course&Year</th>
                                        <th>Photo</th>
                                        <th>Student ID</th>
                                        <th>Tools</th>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM voters";
                                        $query = $conn->query($sql);
                                        while ($row = $query->fetch_assoc()) {
                                          $image = (!empty($row['photo'])) ? '../images/' . $row['photo'] : '../images/profile.jpg';
                                          echo "
                        <tr>
                          <td>" . $row['lastname'] . "</td>
                          <td>" . $row['firstname'] . "</td>
                          <td>" . $row['cy'] . "</td>
                          <td>
                            <img src='" . $image . "' width='30px' height='30px'>
                            <a href='#edit_photo' data-toggle='modal' class='pull-right photo' data-id='" . $row['id'] . "'><span class='fa fa-edit'></span></a>
                          </td>
                          <td>" . $row['voters_id'] . "</td>
                          <td>
                            <button class='btn btn-success btn-sm edit btn-flat' data-id='" . $row['id'] . "'><i class='fa fa-edit'></i> Edit</button>
                           



                            <button class='btn btn-danger btn-sm delete btn-flat' data-id='" . $row['id'] . "'><i class='fa fa-trash'></i> Delete</button>
                          </td>
                        </tr>
                      ";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <footer class="main-footer">
    <div class="container">
        <div class="pull-right hidden-xs">
        </div>
        <strong> &copy; Developed & Modified by: Augustin Maputol</strong>
    </div>
    <!-- /.container -->
</footer> 
        <?php include 'includes/voters_modal.php'; ?>
    </div>
    <?php include 'includes/scripts.php'; ?>
    <script>
        $(function() {
            $(document).on('click', '.edit', function(e) {
                e.preventDefault();
                $('#edit').modal('show');
                var id = $(this).data('id');
                getRow(id);
            });

            $(document).on('click', '.delete', function(e) {
                e.preventDefault();
                $('#delete').modal('show');
                var id = $(this).data('id');
                getRow(id);
            });

            $(document).on('click', '.photo', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                getRow(id);
            });

        });

        function getRow(id) {
            $.ajax({
                type: 'POST',
                url: 'voters_row.php',
                data: {
                    id: id
                }, 
                dataType: 'json',
                success: function(response) {
                    $('.id').val(response.id);
                    $('#edit_student').val(response.voters_id);
                    $('#edit_firstname').val(response.firstname);
                    $('#edit_lastname').val(response.lastname);
                    $('#edit_password').val(response.password);
                    $('#edit_course').val(response.cy);
                    $('.fullname').html(response.firstname + ' ' + response.lastname);
                }
            });
        }
    </script>
</body>

</html> 