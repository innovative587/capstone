<!DOCTYPE html>
<html>
<head>
	<title>Confirmation Email</title>
</head>
<body>
	<tr><td>Dear {{ $name }}!</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>Please click on below link to activate your account:</td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td><a href="{{ url('confirm/'.$code) }}">Confirm Account</a></td></tr>
	<tr><td>&nbsp;</td></tr>
	<tr><td>Thanks and Regards,</td></tr>
	<tr><td>Edu-Trip Website</td></tr>
</body>
</html>