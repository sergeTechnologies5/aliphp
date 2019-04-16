<?php

include_once("../config/config.php");
            $bdd = new db(); // create a new object, class db()
if(true)
{
    $id = $_POST['id'];
    $description = $_POST['description'];
    $servicetitle = $_POST['servicetitle'];
    $fee = $_POST['fee'];
    $serviceno = $_POST['serviceno'];
    $date = $_POST['date'];

   $createquery = "UPDATE services SET fee='$fee',servicetitle=' $servicetitle',serviceno='$serviceno',date='$date',description='$description' WHERE id='$id'";
   
    try 
    {
     $response = $bdd->execute($createquery);	
     if($response==1){
        header("location:/ali/dashboard/dashboard.php");
     }else{
         echo("Error Creating the Service Try Again");
     }
    }catch(Exception $ex){
    }   
         
}else{
   echo("FILL ALL FIELDS");
}
?>