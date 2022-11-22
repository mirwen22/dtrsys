<!-- Dual Listbox -->
<script src="<?php echo base_url() ?>template/js/plugins/dualListbox/jquery.bootstrap-duallistbox.js"></script>

<script type="text/javascript">
	
	$('.dual_select').bootstrapDualListbox({
                selectorMinimalHeight: 160
            });



	function func_editEmp(empid,emp_lname,emp_fname)
	{
		$('[name="m_emp_id"]').val(empid);
		$('[name="m_txtLname"]').val(emp_lname);
		$('[name="m_txtFname"]').val(emp_fname);

		$(`#modalEdit`).modal(`show`);
	}

	function confirm()
	{

	swal({ 				
							title: "Are you sure Edit this Employee?",
	                        text: "Please double check the data",
	                        icon: "warning",
	                        buttons: ["No, Cancel!", "Proceed"],

	})
	.then((isConfirm) => {
							if (isConfirm) 
	                        {   
	                            swal({title: "Submitting...", text: "please wait",showCancelButton: false, showConfirmButton: false});
	                        	$( "#modalform" ).submit();
	                        } 
	                        else 
	                        {
	                            window.onkeydown = null;
	                            window.onfocus = null;
	                            swal("Cancelled", ":)", "error");
	                            
	                        }

						});


	}

</script>