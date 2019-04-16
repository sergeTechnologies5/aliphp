<?php

		$data = file_get_contents('php://input');
		$json_data = json_decode($data , true);

if(isset($json_data['email'])&&isset($json_data['password']))
	{
		include_once("../config/config.php");
		
        $bdd = new db();
		$username = $json_data['email'];
		$password = $json_data['password'];
		// //build query
		$query = "SELECT * FROM users WHERE email='$username' AND password='$password'";
		//Execute query
			$user = $bdd->getOne($query); // select ALL from allrecoards	
			$count = count($user);
			
			if($count>=1){
				$response = array('status' => "true",'message' => 'success','data'=>$user);
				
			}else{
                $message = "Try with Different Username or Password";
                $response = array('status'=>'200','message'=>$message,'data'=>'not found');
				
			}

			echo json_encode($response);
	}


?>