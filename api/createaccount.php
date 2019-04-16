<?php
include('../config/config.php');
$bdb = new db();

$data = file_get_contents('php://input');
$json_data = json_decode($data , true);

    $username = $json_data['username'];
    $firstname = $json_data['firstname'];
    $lastname = $json_data['lastname'];
    $email = $json_data['email'];
    $password = $json_data['password'];
    $role_id = 3;
    $createquery = "INSERT INTO users (firstname,lastname,username,email,password,role_id) values('$firstname','$lastname','$username','$email','$password','$role_id')";
           try
            {
            $response = $bdb->execute($createquery);	
            if($response==1){
                $response = array('status' => true,'message' => 'success');
            }else{
                $response = array('status' => false, 'message' => 'fail');  
            }

            echo json_encode($response);
           }catch(Exception $ex){

           }
?>