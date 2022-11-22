<script type="text/javascript">
	$('[name=QRcodeSCan]').focus();
	refreshlogs();
	var logtype = "1";

	function func_captureQR(val)
	{
		if(val == '1')
		{
			$('[id=biggerLogType]').html('TIME IN');
			logtype = "1";
			$('[name=QRcodeSCan]').val('');
		}
		else if(val == '0')
		{
			$('[id=biggerLogType]').html('TIME OUT');
			logtype = "0";
			$('[name=QRcodeSCan]').val('');
		}
		else
		{
			$.post('DTRCaptureLogs',{val:val,logtype:logtype}, function(data)
            {
            	let dataObj = jQuery.parseJSON(data);
                if(dataObj.status == '1')
                {

                   displayLogs(dataObj.name,dataObj.datetimer,dataObj.logtype);

                   setTimeout(function(){
					    displayDefault();
					}, 3000);

                   refreshlogs();
                }
                else
                {
                	alert(dataObj.msg);
                }
                $('[name=QRcodeSCan]').val('');
            });
		}
		
	}

	function displayLogs(name,datetimer,logtype)
	{
		let logtypeDesc="TIME IN";
		if(logtype == 0)
		{
			logtypeDesc = "TIME OUT";
		}

		let displayhtml = "<h1 style='font-family: Century Gothic, CenturyGothic, AppleGothic, sans-serif;font-size: 30px;'>"+name+"</h1>"+
                          "<h1 style='font-family: Century Gothic, CenturyGothic, AppleGothic, sans-serif;font-size: 30px;'>"+datetimer+"</h1>"+
                          "<h1 style='font-family: Century Gothic, CenturyGothic, AppleGothic, sans-serif;font-size: 30px;'>"+logtypeDesc+"</h1>";
		$('div#divDisplayerID').html(displayhtml);
	}

	function displayDefault()
	{
		let displayhtml = '<img src="<?php echo base_url(); ?>images/qrcode.jpg"> ';
		$('div#divDisplayerID').html(displayhtml);
	}

	function refreshlogs()
	{

		$.post('DTRRefreshLogs',{}, function(data)
        {
        	let dataObj = jQuery.parseJSON(data);

        	$('tbody#tbodyID').html(dataObj.data);
        });
	}
</script>