<!-- Dual Listbox -->
<script src="<?php echo base_url() ?>template/js/plugins/dualListbox/jquery.bootstrap-duallistbox.js"></script>

<script type="text/javascript">
	
	$('.dual_select').bootstrapDualListbox({
                selectorMinimalHeight: 160
            });


	function func_showDetails(ua_id,fullname,username,ut_id)
	{
		$('[name="m_ua_id"]').val(ua_id);
		$('[name="m_txtFullName"]').val(fullname);
		$('[name="m_txtUserName"]').val(username);
		$('[name="m_selUSerTYpe"]').val(ut_id);

		$(`#modalEditUser`).modal(`show`);
	}


	function confirm()
	{

	swal({ 				
							title: "Are you sure Edit this Useraccount?",
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

	function func_showpass()
	{
		if($('#idPassword').attr('style') == "-webkit-text-security: disc;")
		{
			$('#idPassword').attr('style','')
		}
		else
		{
			$('#idPassword').attr('style','-webkit-text-security: disc;')
		}

		
	}

	function generaterandomPass()
	{
		$('#ibox1').children('.ibox-content').toggleClass('sk-loading');

		$.ajax
            ({
                url: 'GeneratePass', 
                type: 'POST',  
                data: 
                {  
                }, 
                dataType: 'json', 
                success: function (data)
                { 
					$('#idPassword').val(data);
					$('#ibox1').children('.ibox-content').toggleClass('sk-loading');
                }
            });
					    

		

      

	}


</script>