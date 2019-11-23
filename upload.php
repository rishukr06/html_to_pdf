<?php 

if(isset($_POST['btn']))
{
	 $html =$_POST['html']; 

	 //Html data
	$name = $_POST['name'];
	$name = $name.time().'.pdf';//genrating File name
}
else{
exit("we are better then you! (*_*)");
}

class myException extends Exception{
	public function errorMessage(){
	$errorMsg = 'Error on line '.$this->getLine().' in '.$this->getFile()
    	.': <b>'.$this->getMessage().'</b> is not a valid file';
    	return $errorMsg;
	}
}

$file = "./mypython.py";


try
{
 $output=shell_exec("python $file $html $name"); //executing python script
 if(!$output)
 {
  throw new myException($file);
 }
 else
 {
   echo "<pre>".$output."</pre>";
 }
}

catch(myException $e) {
  echo $e->errorMessage();
}

?>
