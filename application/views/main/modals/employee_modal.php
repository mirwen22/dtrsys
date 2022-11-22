
<form role="form" method="post" action="<?php echo base_url() ?>Employee_Update" id="modalform">
  

<div class="modal inmodal" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content animated bounceInRight">
                                     
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                <i class="fa fa-pencil modal-icon"></i>
                                                <h4 class="modal-title">Edit Employee</h4>
                                                
                                            </div>
                                        <div class="modal-body">

                                            <input type="text" name="m_emp_id" hidden>

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
                                                      <input type="text" name="m_txtFname" class="form-control" required>
                                                    </div>
                                                    
                                                    <div class="col-xs-6">
                                                      <input type="text" name="m_txtLname" class="form-control" required>
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

