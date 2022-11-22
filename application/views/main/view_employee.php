
<div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-10">
                    <h2></h2>
                    <ol class="breadcrumb">
                        <li>
                            <a href="index.html">Home</a>
                        </li>
                        <li class="active">
                            <strong>DTR Capture</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
</div>

        <div class="wrapper wrapper-content animated fadeInRight">


             <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
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
                        <div class="row">
                            <div class="col-sm-12">
                                <form role="form" method="post" action="" id="myform">
                                     <div class="form-group">
                                          <div class="row">
                                            <div class="col-xs-6">
                                              <label>First Name:</label>
                                            </div>

                                            <div class="col-xs-6">
                                              <label>Last Name:</label>
                                            </div>

                                          </div>
                                          <div class="row">

                                            <div class="col-xs-6">
                                              <input type="text" name="txtFname" class="form-control" value="<?=set_value('txtFname')?>" required>
                                            </div>

                                            <div class="col-xs-6">
                                              <input type="text" name="txtLname" class="form-control" value="<?=set_value('txtLname')?>" required>
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
                                                    <th>Employee ID</th>
                                                    <th>QR Code</th>
                                                    <th>First Name</th>
                                                    <th>Last Name</th>
                                                    <th>Created By</th>
                                                    <th>Date Time Created</th>
                                                    <th>Date Time Updated</th>
                                                    <th>Action</th>
                                                </thead>
                                                <tbody>
                                                <?php 
                                                foreach($alldata as $row)
                                                {
                                                    echo "<tr>";
                                                        echo "<td>".$row['emp_id']."</td>";
                                                        echo "<td>".$row['emp_qrCode']."</td>";
                                                        echo "<td>".$row['emp_fname']."</td>";
                                                        echo "<td>".$row['emp_lname']."</td>";
                                                        echo "<td>".$row['ua_fullname']."</td>";
                                                        echo "<td>".$row['emp_datetimeAdded']."</td>";
                                                        echo "<td>".$row['emp_datetimeUpdated']."</td>";
                                                        
                                                        echo '<td class="tooltip-demo">';

                                                                        echo "<div class='col-xs-4'>"
                                                                            . "<a onclick=window.open('".base_url()."Employee_ShowQR/?id=".$row['emp_id']."','Ratting','width=500,height=500,left=350,top=200,toolbar=0,status=0,') data-toggle='tooltip' data-placement='top' title='Generate QR code'><i class='fa fa-qrcode text-success fa-lg'></i></a>"
                                                                        ."</div>";

                                                                        echo "<div class='col-xs-4'>"
                                                                            . "<a onclick=\"func_editEmp(".$row['emp_id'].",'".$row['emp_lname']."','".$row['emp_fname']."')\" data-toggle='tooltip' data-placement='top' title='Edit Employee'><i class='fa fa-pencil text-success fa-lg'></i></a>"
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
