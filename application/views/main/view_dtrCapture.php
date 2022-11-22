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
                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5></h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>

                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="form-group">
                                  <div class="row">
                                    <div class="col-xs-12">
                                      <label>Short cut keys:</label> <br>
                                      1 = Time IN <br>
                                      0 = Time Out <br>
                                      
                                      PS: (Enter the shortcut key then press ENTER)
                                    </div>


                                  </div>
                                  
                            </div>

                            <div class="hr-line-dashed"></div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-xs-12">
                                        <input type="text" name="QRcodeSCan" class="form-control" placeholder="Scan Your QR Code Here" onkeyup="if(event.keyCode == 13){func_captureQR(this.value)}">
                                    </div>

                                </div>

                                <div class="row">
                                    <h1 style='font-family: Century Gothic, CenturyGothic, AppleGothic, sans-serif;font-size: 80px;' id="biggerLogType">TIME IN</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>QR Code Scan</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                         
                            </div>
                        </div>
                        <div class="ibox-content">

                            

                            <div class="row" align="center" id="divDisplayerID">
                                    <img src="<?php echo base_url(); ?>images/qrcode.jpg"> 
                            </div>

                            
                        </div>
                    </div>
                </div>


                <div class="col-lg-4">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Log List (Top 10)</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                          
                            </div>
                        </div>
                        <div class="ibox-content">
                   
                                <table class="table table-hover no-margins">
                                            <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>TIME IN</th>
                                                <th>TIME OUT</th>
                                                <th>Employee</th>
                                            </tr>
                                            </thead>
                                            <tbody id="tbodyID">
                                            
                                            </tbody>
                                </table>
                         
                        </div>
                    </div>
                </div>
    </div>
           
</div>