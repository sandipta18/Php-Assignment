<html>
<head>
<title>PHP File Upload example</title>
</head>
<body>

<form action="upload.php" enctype="multipart/form-data" method="post">
Select image :
<input type="file" name="file"><br/>
<input type="submit" value="Upload" name="Submit1"> <br/>
</form>

<?php
if(isset($_POST['Submit1']))
{
$filepath = "images/" . $_FILES["file"]["name"].$file;

if(move_uploaded_file($_FILES["file"]["tmp_name"], $filepath)) //this function ensures that the image ie uploaded via PHP's HTTP POST
                                                               //upload mechanism .
{
echo "<img src=".$filepath." height=200 width=300 />";
        echo $file;
        echo "succes";
}
else
{
echo "Error !!";
}
}
?>

</body>
</html>