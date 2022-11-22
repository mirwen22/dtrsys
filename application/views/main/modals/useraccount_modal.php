
<form role="form" method="post" action="<?php echo base_url() ?>User_AccountValidation" id="modalform">
  

<div class="modal inmodal" id="modalEditUser" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content animated bounceInRight">
                                     
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <i class="fa fa-pencil modal-icon"></i>
                                                <h4 class="modal-title">Edit User Info</h4>
                                                
                                            </div>
                                        <div class="modal-body">

                                            <input type="text" name="m_ua_id" hidden>

                                            <div class="form-group">
                                                  <div class="row">
                                                    <div class="col-xs-12">
                                                      <label>Full Name:</label>
                                                    </div>

                                                  </div>
                                                  <div class="row">

                                                    <div class="col-xs-12">
                                                      <input type="text" name="m_txtFullName" class="form-control" required>
                                                    </div>

                                                  </div>
                                            </div>


                                            <div class="form-group">
                                                  <div class="row">
                                                    <div class="col-xs-6">
                                                      <label>Username:</label>
                                                    </div>
                                                    <div class="col-xs-6">
                                                      <label>User Type:</label>
                                                    </div>

                                                  </div>
                                                  <div class="row">
                                                    <div class="col-xs-6">
                                                        <input type="text" name="m_txtUserName" class="form-control">
                                                    </div>
                                                    <div class="col-xs-6">
                                                        <select class="select2_demo_3 form-control" name="m_selUSerTYpe" style="width:100%" required>
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


                                        </div>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary" data-style="slide-right" onclick="confirm()">Update</button>
                                        </div>

                    
                                    </div>
                                </div>
</div>

</form>

