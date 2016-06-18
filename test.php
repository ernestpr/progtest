<?php

include "dbaccess.php"; //configure database and API key

//built function to pull out element from object

function finditem($obj,$type)
{
	$returnval="";
	foreach ($obj->result->address_component as $objdata)
	{
     //  print_r($objdata);
		if($objdata->type == $type)$returnval=$objdata->long_name;
	}
	return $returnval;
}
//this code returns status ok if address verifies. Returns formatted address with zipcode in JSON format. 
$user_address=$_GET["address"];

$curl = curl_init();
curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://maps.googleapis.com/maps/api/geocode/xml?address='.urlencode($user_address).'&key='.API_KEY
    
));
//echo 'https://maps.googleapis.com/maps/api/geocode/xml?address='.urlencode($user_address).'&key='.API_KEY;
$x= curl_exec($curl);

$xm1l = simplexml_load_string($x);

//create JSON object from Google address object
if ($xm1l->status=="OK") {

	$valid_address=$xm1l->result->formatted_address;
	$zipcode=finditem($xm1l,"postal_code");

	$sql='INSERT INTO addresses (valid_address, zipcode, user_address) VALUES ("'.$valid_address.'","'.$zipcode.'","'.$user_address.'") ';
	$myconnection->query($sql);
	$myconnection->close();
	

	
	
	$json= '{"status":"'. $xml->status. '","formatted_address":"'.$valid_address.'", "zipcode":"'.$zipcode.'"}';
	
echo $json;
} else
{
	$json= '{"status":"BAD"}';
//	echo $json;
}

?>