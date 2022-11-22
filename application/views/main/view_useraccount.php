
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li class="active">
                            <strong>User Accounts</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <?php echo validation_errors(); ?>  

            <?php 
            if(isset($_GET['msg']) && $_GET['msg'] == 1)
            {
                echo '<div class="alert alert-success alert-dismissable">'.
                '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'.
                '<a class="alert-link" href="#">Successfuly Added</a>.'.
                '</div>';
            }
            else if(isset($_GET['msg']) && $_GET['msg'] == 2)
            {
                $errorMsg = "Something Went Wrong!";
                if(isset($_GET['errorMsg']))
                {
                    $errorMsg = $_GET['errorMsg'];
                }
                echo '<div class="alert alert-danger alert-dismissable">'.
                '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'.
                '<a class="alert-link" href="#">'.$errorMsg .'</a>.'.
                '</div>';
            }
            else if(isset($_GET['msg']) && $_GET['msg'] == 3)
            {
                echo '<div class="alert alert-success alert-dismissable">'.
                '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'.
                '<a class="alert-link" href="#">Successfuly Updated!</a>'.
                '</div>';
            }
             ?>

             <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins" id="ibox1">
                    <div class="ibox-title">
                        <h5></h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="#">Config option 1</a>
                                </li>
                                <li><a href="#">Config option 2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content">

                        <div class="sk-spinner sk-spinner-three-bounce">
                                    <div class="sk-bounce1"></div>
                                    <div class="sk-bounce2"></div>
                                    <div class="sk-bounce3"></div>
                        </div>


                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="post" action="" id="myform">
                                     <div class="form-group">
                                          <div class="row">
                                            <div class="col-xs-12">
                                              <label>Full Name:</label>
                                            </div>

                                          </div>
                                          <div class="row">

                                            <div class="col-xs-12">
                                              <input type="text" name="txtFullName" class="form-control" value="<?=set_value('txtFullName')?>" required>
                                            </div>

                                          </div>
                                    </div>


                                    <div class="form-group">
                                          <div class="row">
                                            <div class="col-xs-6">
                                              <label>Username:</label>
                                            </div>
                                            <div class="col-xs-6">
                                              <label>Password:</label>

                                            </div>

                                          </div>
                                          <div class="row">
                                            <div class="col-xs-6">
                                                <input type="text" name="txtUserName" value="<?=set_value('txtUserName')?>" class="form-control" value="">
                                            </div>
                                            <div class="col-xs-6">
                                                <input type="text" name="txtPassword" value="<?=set_value('txtPassword')?>" style="-webkit-text-security: disc;" class="form-control" id="idPassword" autocomplete="off" required>
                                                <input type="checkbox" onclick="func_showpass()">Show Password
                                                <div align="right">
                                                    <button type="button" class="btn btn-success btn-sm" data-style="slide-right" onclick="generaterandomPass()">Generate Random password</button>
                                                </div>

                                            </div>
                                
                                          </div>
                                    </div>


                                    <div class="form-group">
                                          <div class="row">
                                            <div class="col-xs-6">
                                              <label>User Type:</label>
                                            </div>

                                          </div>
                                          <div class="row">
                                            <div class="col-xs-6">
                                                <select class="select2_demo_3 form-control" name="selUSerTYpe" style="width:100%" required>
                                                    <option value="">- choose -</option>
                                                    <?php 
                                                    foreach($userType as $row)
                                                    {
                                                        echo "<option value='".$row['ut_id']."'>".$row['ut_desc']."</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                
                                          </div>
                                    </div>

 
                                    <div>
                                        <button type="submit" class="ladda-button ladda-button-submit btn btn-info" data-style="slide-right">Save</button>
                                    </div>

                                    <div class="ibox-content">

                                    <div class="hr-line-dashed"></div>
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                    <th>User ID</th>
                                                    <th>Full Name</th>
                                                    <th>Username</th>
                                                    <th>User Type</th>
                                                    <th>Action</th>
                                                </thead>
                                                <tbody>
                                                <?php 

                                                foreach($alldata as $row)
                                                {
                                                    echo "<tr>";
                                                        echo "<td>".$row['ua_id']."</td>";
                                                        echo "<td>".$row['ua_fullname']."</td>";
                                                        echo "<td>".$row['ua_username']."</td>";
                                                        echo "<td>".$row['ut_desc']."</td>";

                                                        echo '<td class="tooltip-demo">';

                                                                        echo "<div class='col-xs-12'>"
                                                                            . "<a onclick=\"func_showDetails(".$row['ua_id'].",'".$row['ua_fullname']."','".$row['ua_username']."','".$row['ut_id']."')\" data-toggle='tooltip' data-placement='top' title='Edit User'><i class='fa fa-pencil text-success fa-lg'></i></a>"
                                                                        ."</div>";

                                              
                                                        echo "</td>";

                                                    echo "</tr>";
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>


                                    </div>
                                </form>
                            </div>
                         
                        </div>
                    </div>
                </div>
            </div>

            </div>
           
        </div>
