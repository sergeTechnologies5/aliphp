<?php
include_once("../config/config.php");
session_start();
session_unset();
session_destroy();
$bdd = new db(); // create a new object, class db()


     //admins
$admins = 'CREATE TABLE IF NOT EXISTS users (
   id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
   firstname VARCHAR(100) NOT NULL,
   username VARCHAR(100) NOT NULL,
   role_id INT NOT NULL,
         password VARCHAR(100) NOT NULL,
         email VARCHAR(100) NOT NULL,
         aboutme VARCHAR(100) DEFAULT "",
         lastname VARCHAR(100) DEFAULT "",
   date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
   date_modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
   )';
   try{
    $response = $bdd->execute($admins);  
 } catch (Exception $e) {
 echo 'Caught exception: ',  $e->getMessage(), "\n";
 }
   
   
 

   if(isset($_POST['firstname'])&&isset($_POST['lastname'])&&isset($_POST['email'])&&isset($_POST['password'])&&isset($_POST['signup'])&&isset($_POST['username']))
   {
		
	   $username = $_POST['username'];
       $firstname = $_POST['firstname'];
       $lastname = $_POST['lastname'];
       $email = $_POST['email'];
       $password = $_POST['password'];
	   $role_id = 1;
       
       $query = "INSERT INTO users (firstname,lastname,username,email,password,role_id) values('$firstname','$lastname','$username','$email','$password','$role_id')";
           try {
            
            $response = $bdd->execute($query);	
            if($response ==1){
                $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
		//Execute query
			$user = $bdd->getAll($query); // select ALL from allrecoards	
			$count = count($user);
			echo($count);
			if($count>=1){
				if(session_id() == '' || !isset($_SESSION)){session_start();}
				foreach($user as $value){
					$id =$value['id'];
				}
				$_SESSION['username'] = $username;
				$_SESSION['id'] = $id;
				header("location:dashboard.php");
			
			}else{
				$message = "Try with Different Username or Password";
				header("location:login.php");
         }}
      } catch (Exception $e) {
              echo"The error is : ",$e->getMessage();
           }    
   }else{
      echo("FILL ALL FIELDS");
   }
?>