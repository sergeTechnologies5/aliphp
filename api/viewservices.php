<?php

        include_once("../config/config.php");
        $bdd = new db();
		// //build query
		$query = "SELECT id,fee,servicetitle,serviceno,description,date_created FROM services";
		//Execute query
			$user = $bdd->getAll($query); // select ALL from allrecoards	
			$count = count($user);
			
			if($count>=1){
				echo json_encode($user);
			}else{
                $message = "no service found";
                var_dump(json_encode(array($message)));
				
			}

?>