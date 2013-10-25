<?php
function sendMailAtt($to, $from, $sub, $msg, $attach=array())
{
  $headers = "From: ".$from;

  $rand_hash = md5(time());
  $mime_boundary = "==Multipart_Boundary_x".$rand_hash."x";

  $headers .= "\nMIME-Version: 1.0\n".
    "Content-Type: multipart/mixed;\n".
    ' boundary="'.$mime_boundary.'"';

  $msg .= "Multi-part message in MIME format.\n\n".
    '--'.$mime_boundary."\n".
    "Content-Type:text/html; charset=\"iso-8859-1\"\n".
    "Content-Transfer-Encoding: 7bit\n\n".$msg."\n\n";

  if (count($attach)>=1) {
    for($i=0; $i<count($attach); $i++) {
      if ($file = fopen($attach[$i][0],'rb')) {
        $data = fread($file, filesize($attach[$i][0]));
        fclose($file);
      }

      $data = chunk_split(base64_encode($data));

      $msg .= '--'.$mime_boundary."\n".
      'Content-Type: '.$attach[$i][1].";\n".
      ' name="'.basename($attach[$i][0])."\"\n".
      "Content-Transfer-Encoding: base64\n\n".$data ."\n\n".
      '--'.$mime_boundary."\n";
    }
  }

  if(mail($to, $sub, $msg, $headers))
    return true;
  else
    return false;
}

function getMimeType($file)
{
  $mime_types = array(
    "pdf"=>"application/pdf",
    "exe"=>"application/octet-stream",
    "zip"=>"application/zip",
    "docx"=>"application/msword",
    "doc"=>"application/msword",
    "xls"=>"application/vnd.ms-excel",
    "ppt"=>"application/vnd.ms-powerpoint",
    "gif"=>"image/gif",
    "png"=>"image/png",
    "jpeg"=>"image/jpg",
    "jpg"=>"image/jpg",
    "mp3"=>"audio/mpeg",
    "wav"=>"audio/x-wav",
    "mpeg"=>"video/mpeg",
    "mpg"=>"video/mpeg",
    "mpe"=>"video/mpeg",
    "mov"=>"video/quicktime",
    "avi"=>"video/x-msvideo",
    "3gp"=>"video/3gpp",
    "css"=>"text/css",
    "jsc"=>"application/javascript",
    "js"=>"application/javascript",
    "php"=>"text/html",
    "htm"=>"text/html",
    "html"=>"text/html"
  );

  $extension = strtolower(end(explode('.',$file)));

  return $mime_types[$extension];
}

function mimeTypeDenied ($fileMimeType,$mimeTypesAllowed) {
  foreach($fileMimeType as $f) {
    if(!in_array($f, $mimeTypesAllowed))
      return true;
  }
  return false;
}

function fileSizeDenied ($fileSize,$maxFileSize) {
  foreach($fileSize as $f) {
    if($f > $maxFileSize)
      return true;
  }
  return false;
}


function deleteAllFiles ($inputName,$qty) {
  for($i=1; $i <= $qty; $i++) {
    if(!unlink($_FILES[$inputName.$i]['tmp_name']))
      return false;
  }
  return true;
}



if($_SERVER['REQUEST_METHOD'] == 'POST') {
  if(strpos($_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME']) > 0) {
    $to = "cristovamruizjr@gmail.com";
    $email = strip_tags($_REQUEST['email']);
    $name = strip_tags($_REQUEST['nome']);
    $campaign = strip_tags($_REQUEST['campanha']);
    $from = "{$name} <{$email}>";
    $subject = '[Vila Sésamo][' . $campaign . '] '.$name.' <'.$email.'>';
    
    $message = "Formulário Preenchido em " . date("d/m/Y") . " as " . date("H:i:s") . ", seguem abaixo os dados:<br><br>";
    while(list($field, $value) = each($_REQUEST)) {
      if(!in_array(ucwords($field), array('Form_action', 'X', 'Y', 'Enviar', 'Undefinedform_action')))
        $message .= "<b>" . ucwords($field) . ":</b> " . strip_tags($value) . "<br>";
    }
    
    $file_name = basename($_FILES['datafile']['name']);
    $data = file_get_contents($_FILES['datafile']['tmp_name']); 
    $file_contents = chunk_split(base64_encode($data));
    $file_size = $_FILES['datafile']['size'];
    //die($_FILES['datafile']['name']);
    $file_mime_type = getMimeType($_FILES['datafile']['name']);
    //$file_mime_type = "image/jpg";
    $attach = array();
    $attach[] = array($_FILES['datafile']['tmp_name'], $file_mime_type);
    
    if (!in_array($file_mime_type, array("image/gif", "image/png", "image/jpg"))) {
      if (unlink($_FILES['datafile']['tmp_name'])) {
        //header("Location: http://tvcultura.cmais.com.br/cocorico/receitinhas?error=2");
        die("1");
      }
    }
    else if ($file_size > 15728640) { // 15MB
      if (unlink($_FILES['datafile']['tmp_name'])) {
        //header("Location: http://tvcultura.cmais.com.br/cocorico/receitinhas?error=3");
        die("2");
      }
    }
    else {
      
      if(sendMailAtt($to, $from, $subject, $message, $attach)) {
        if (unlink($_FILES['datafile']['tmp_name'])) {
          //header("Location: http://tvcultura.cmais.com.br/cocorico/receitinhas?success=2");
          die("0");
        }
      }
      else{
        if (unlink($_FILES['datafile']['tmp_name'])) {
          //header("Location: http://tvcultura.cmais.com.br/cocorico/receitinhas?error=1");
          die("3");
        }
      }
    }
  }
}

?>                