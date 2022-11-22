
<?php 
$nav_minimize = "";

if($this->uri->segment(1) == "DTR_Capture") $nav_minimize="mini-navbar";
?>


<body class='no-skin-config <?php echo $nav_minimize ?>'>

    <div id="wrapper">

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
                <li class="nav-header">
                    <div class="dropdown profile-element"> <span>
                            <img alt="image" class="img-circle" src="<?php echo base_url() ?>images/profile.jpg" width="50px" height="50px" />
                             </span>
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <span class="clear"> <span class="block m-t-xs"> <strong class="font-bold"><?php echo $name ?></strong>
                             </span> <span class="text-muted text-xs block"><?php echo $userlevel_desc ?> <b></b></span> </span> </a>
                    </div>
                    <div class="logo-element">
                        DTR
                    </div>
                </li>
                

                <li <?php if($this->router->fetch_class() == "ctrlr_useraccount") echo " class='active'"; ?>>
                    <a href="index.html"><i class="fa fa-user"></i> <span class="nav-label">User Accounts</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li <?php if($this->uri->segment(1) == "User_Account") echo " class='active'"; ?>><a href="User_Account">Add/Edit</a></li>
                        <li <?php if($this->uri->segment(1) == "User_AccountRemove") echo " class='active'"; ?>><a href="User_AccountRemove">Remove</a></li>
                    </ul>
                </li>


                <li <?php if($this->router->fetch_class() == "ctrlr_employees") echo " class='active'"; ?>>
                    <a href="index.html"><i class="fa fa-users"></i> <span class="nav-label">Employees</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li <?php if($this->uri->segment(1) == "Employee_List") echo " class='active'"; ?>><a href="Employee_List">Add/Edit</a></li>
                        <li <?php if($this->uri->segment(1) == "Employee_Remove") echo " class='active'"; ?>><a href="Employee_Remove">Remove</a></li>
                    </ul>
                </li>

       
                <li <?php if($this->router->fetch_class() == "ctrlr_empTimeRecord") echo " class='active'"; ?>>
                    <a href="DTR_Capture"><i class="fa fa-table"></i> <span class="nav-label">DTR</span></a>
                </li>

            </ul>

        </div>
    </nav>