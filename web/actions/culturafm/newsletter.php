<?php
//CULTURA FM - NEWSLETTER

function validaEmail($mail){
	if(preg_match("/^([[:alnum:]_.-]){3,}@([[:lower:][:digit:]_.-]{3,})(.[[:lower:]]{2,3})(.[[:lower:]]{2})?$/", $mail))
		return true;
	else
		return false;
}

if($_REQUEST["email_newsletter"] && $_REQUEST["site"]) {
	$email = strtolower($_REQUEST["email_newsletter"]);
	$site = $_REQUEST["site"];
	if(validaEmail($email) && $site == "culturafm" ){
		$filename = "newsletter_culturafm.csv";
		$content = $email . ", ";
		$fp = fopen($filename, 'a+');
		if(fwrite($fp, $content)){
			die("0");
		}else{
			die("1");
		}
	}else{
		die("1");
	}
}else {
	die("1");
}

?>