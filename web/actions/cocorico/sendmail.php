<?php
include("../includes/functions.php");

if($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(strpos($_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME']) > 0) {
    
    //$to = "maiscriancatvcultura@gmail.com, cristovamruizjr@gmail.com";
    $to = "maiscriancatvcultura@gmail.com";
    $email = strip_tags($_REQUEST['email']);
    $name = strip_tags($_REQUEST['nome']);
    $from = "{$name} <{$email}>";
    $subject = '[Cocoricó][TV Cocoricó] '.$name.' <'.$email.'>';
    
    $message = "Formulário Preenchido em " . date("d/m/Y") . " as " . date("H:i:s") . ", seguem abaixo os dados:<br><br>";
    while(list($field, $value) = each($_REQUEST)) {
      if(!in_array(ucwords($field), array('Form_action', 'X', 'Y', 'Enviar', 'Undefinedform_action')))
        $message .= "<b>" . ucwords($field) . ":</b> " . strip_tags($value) . "<br>";
    }
    
    $file_name = basename($_FILES['datafile']['name']);
    $data = file_get_contents($_FILES['datafile']['tmp_name']); 
    $file_contents = chunk_split(base64_encode($data));
    $file_size = $_FILES['datafile']['size'];
    $file_mime_type = getMimeType($_FILES['datafile']['name']);
    $attach = array();
    $attach[] = array($_FILES['datafile']['tmp_name'], $file_mime_type);

        
    if (!in_array($file_mime_type, array("image/gif", "image/png", "image/jpg"))) {
      header("Location: http://tvcultura.cmais.com.br/cocorico/tvcocorico?error=2");
      die();
    }
    else if ($file_size > 15728640) { // 15MB
      header("Location: http://tvcultura.cmais.com.br/cocorico/tvcocorico?error=3");
      die();
    }
    else {
      
      if(sendMailAtt($to, $from, $subject, $message, $attach)) {
        header("Location: http://tvcultura.cmais.com.br/cocorico/tvcocorico?success=1");
        die();
      }
      else{
        header("Location: http://tvcultura.cmais.com.br/cocorico/tvcocorico?error=1");
        die();
      }
    }
  }
}

?>                