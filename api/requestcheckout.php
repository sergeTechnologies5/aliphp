<?php


$ENDPOINT = "https://safaricom.co.ke/mpesa_online/lnmo_checkout_server.php?wsdl";

$CALLBACK_URL = "http://crackthecode.co.ke/MPESA/processcheckout.php";
$CALL_BACK_METHOD = "POST";

$PAYBILL_NO = "898998";
$PRODUCT_ID = "1717171717171";

$MERCHENTS_ID = $PAYBILL_NO;

$MERCHANT_TRANSACTION_ID = generateRandomString();
$INFO = $PAYBILL_NO;
$TIMESTAMP = "20160510161908";//MUST BE THE ONE USED IN CREATING THE PASSWORD

//$TIMESTAMP = date("YmdHis",time());
//$PASSKEY = "your SAG password"
/*NB : PASSWORD MUST BE OBTAIN FROM THE BELOW FORMAT
 $PASSWORD = base64_encode(hash("sha256", $MERCHENTS_ID.$PASSKEY.$TIMESTAMP ,True));*/

$PASSWORD ='ZmRmZDYwYzIzZDQxZDc5ODYwMTIzYjUxNzNkZDMwMDRjNGRkZTY2ZDQ3ZTI0YjVjODc4ZTExNTNjMDA1YTcwNw==';

$AMOUNT = $_POST['amount'];
$NUMBER = $_POST['number']; //format 254700000000
$user_id = $_POST['user_id'];
$service_id = $_POST['service_id'];

include('../config/config.php');

$body = '<soapenv:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:tns="tns:ns" xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/"xmlns:soapenc="http://schemas.xmlsoap.org/soap/encoding/"><soapenv:Header><tns:CheckOutHeader><MERCHANT_ID>'.$PAYBILL_NO.'</MERCHANT_ID><PASSWORD>'.$PASSWORD.'</PASSWORD><TIMESTAMP>'.$TIMESTAMP.'</TIMESTAMP></tns:CheckOutHeader></soapenv:Header><soapenv:Body><tns:processCheckOutRequest><MERCHANT_TRANSACTION_ID>'.$MERCHANT_TRANSACTION_ID.'</MERCHANT_TRANSACTION_ID><REFERENCE_ID>'.$PRODUCT_ID.'</REFERENCE_ID><AMOUNT>'.$AMOUNT.'</AMOUNT><MSISDN>'.$NUMBER.'</MSISDN><ENC_PARAMS></ENC_PARAMS><CALL_BACK_URL>'.$CALLBACK_URL.'</CALL_BACK_URL><CALL_BACK_METHOD>'.$CALL_BACK_METHOD.'</CALL_BACK_METHOD><TIMESTAMP>'.$TIMESTAMP.'</TIMESTAMP></tns:processCheckOutRequest></soapenv:Body></soapenv:Envelope>'; /// Your SOAP XML needs to be in this variable
$query = "INSERT INTO `transations` (`id`, `amount`, `service_id`, `user_id`, `phonenumber`, `date_created`, `date_modified`) VALUES (NULL, '$AMOUNT', '$service_id', '$user_id', '$NUMBER', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
$bdd = new db(); // create a new object, class db()
			$transations = 'CREATE TABLE IF NOT EXISTS transations (
			  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
			  amount INT NOT NULL,
			  service_id INT NOT NULL,
              user_id INT NOT NULL,
			  phonenumber VARCHAR(100) NOT NULL,
              FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
			  FOREIGN KEY (service_id) REFERENCES services(id) ON DELETE CASCADE,
			  date_created TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
			  date_modified DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP)';
			  try{
               $response = $bdd->execute($transations); 
                } catch (Exception $e) 
                {
			       // echo 'Caught exception: ',  $e->getMessage(), "\n";
                }
            $response = $bdd->execute($query);  

            $result = array('user_id'=>$user_id,'number'=>$NUMBER,'amount'=>$AMOUNT,'service_id'=>$service_id);
            echo json_encode($result);
            
                        if($response==1){
                 var_dump(json_encode(array('status'=>200,'message'=>"success"))) ;
            }
            
try{
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $ENDPOINT); 
    curl_setopt($ch, CURLOPT_HEADER, 0); 

    curl_setopt($ch, CURLOPT_VERBOSE, '0');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body); 

    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, '0');
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, '0');

    $output = curl_exec($ch);
    curl_close($ch);

// Check if any error occured
// if(curl_errno($ch))
// {
//     //echo 'Error no : '.curl_errno($ch).' Curl error: ' . curl_error($ch);
// }
//print_r("To complete this transaction, enter your Bonga PIN on your handset. if you don't have one dial *126*5# for instructions ");
//now process the checkout;
include ('processcheckout.php');
processcheckout($MERCHANT_TRANSACTION_ID, $ENDPOINT,$PASSWORD,$TIMESTAMP);

}catch(Exception $ex){
//echo $ex;
}

function generateRandomString() {
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>
