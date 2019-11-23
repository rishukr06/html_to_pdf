<?php 

echo $a = '<h1>HELLO THERE!</h1>';

?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<form onsubmit='return loadicon();' action="./upload.php" method="post">
<br>
File Name: <input type="text" name="name" placeholder="Enter File Name" autocomplete="off" required/>
<br>
<textarea style="display:none" name="html" cols=60 rows=40><?php echo "&#034;".$a."&#034;"; ?> </textarea>
<br>
<input type="submit" name="btn" value="upload invoice">&nbsp;&nbsp;&nbsp;
<span id="loadingIcon"><i class="fa fa-refresh fa-spin" style="font-size:24px"></i> uploading...</span>

</form>

<script>

document.getElementById('loadingIcon').style.display="none";

function loadicon(){
	document.getElementById('loadingIcon').style.display="inline-flex";
	return true;
}
</script>
