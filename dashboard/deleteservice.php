<?php
        if(isset($_GET['id']))
        {
            $id = $_GET['id'];
            include_once("../config/config.php");
            $bdd = new db(); // create a new object, class db()
            //header('location:cancle.php');
            $id = $_GET['id'];
            $query = "DELETE FROM services WHERE id='$id'";
            $result = $bdd->execute($query);

            if($result>=1){
                header('location:/ali/dashboard/dashboard.php');
                }else{
                echo('Service Deletion Failed');
            }
        }
?>