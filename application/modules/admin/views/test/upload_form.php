<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo isset($error)?$error:'';?>

<?php echo form_open_multipart();?>

<input type="text" name="name" size="20" />
<input type="file" name="userfile" size="20" />

<br /><br />

<input type="submit" value="upload" name="submit" />

</form>

</body>
</html>