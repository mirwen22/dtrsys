<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>QR Code</title>
</head>
<body>
	<div align="center">
		<img src="<?php echo base_url() ?>qr_image/<?php echo $res[0]['emp_qrCode'] ?>.png" width="50%">
	</div>
<p align="center"><?php echo $res[0]['emp_fname'] ?> <?php echo $res[0]['emp_lname'] ?></p>
</body>
</html>