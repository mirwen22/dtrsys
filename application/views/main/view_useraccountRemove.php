
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2>User Account Remove</h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li class="active">
                            <strong>User Account Remove</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>

        <div class="wrapper wrapper-content animated fadeInRight">
            <?php 
            if(isset($_GET['msg']) && $_GET['msg'] == 1)
            {
                echo '<div class="alert alert-success alert-dismissable">'.
                '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>'.
                '<a class="alert-link" href="#">Successfuly Removed! Note: User is not allowed to remove his/her account</a>.'.
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

             ?>
            
            
            

             <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>User Account Remove</h5>
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
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="post" action="" id="myform">
                                     <div class="form-group">
                                        <select class="form-control dual_select" name="SelUserID[]" multiple>
                                            <?php 
                                            foreach($alldata as $row)
                                            {
                                                echo "<option value='".$row['ua_id']."'>".$row['ua_fullname']." (".$row['ua_username'].")"."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div>
                                        <button type="submit" name="btnUserRemove" class="ladda-button ladda-button-demo btn btn-info" data-style="slide-right">Remove</button>
                                    </div>

     
                                </form>
                            </div>
                         
                        </div>
                    </div>
                </div>
            </div>

            </div>
           
        </div>
