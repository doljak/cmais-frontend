<?php
  header("Content-Type: text/html;charset=utf8");
  include_once("wsTrabalheConosco.class.php");
	
  if(isset($_GET['callback']) && !empty($_GET['qg_curric']) && !empty($_GET['ql_funcao']) && !empty($_GET['ql_dtadmis']) && !empty($_GET['ql_dtdemis']) && !empty($_GET['ql_experiencia']) && !empty($_GET['ql_empresa']) && !empty($_GET['ql_funcini'])){
     $service = "insere_historico";    
     $arguments = array('insere_historico' 
                    => array( 'cod_curriculo'  => $_GET['qg_curric'],
                              'data_admissao'  => $_GET['ql_dtadmis'],
                              'data_demissao'  => $_GET['ql_dtdemis'],
                              'experiencia'		 => urldecode($_GET['ql_experiencia']),
                              'empresa' 			 => urldecode($_GET['ql_empresa']),
                              'funcao' 				 => $_GET['ql_funcao'], 
                              'funcao_inicial' => $_GET['ql_funcini'], 
                          ));
  
		foreach($arguments["insere_historico"] as $key=>$value){
			//$arguments["insere_historico"][$key] = urldecode($value);
		}  	
  	
  	$result = new wsTrabalheConosco();
  	$result->executeWebService($service, $arguments);
  	$resultado = $result->result->insere_historicoResult;

  	$output = json_encode(array("data" => $resultado));
		$callback = $_GET['callback'];
		echo $callback.'('. $output . ');';	
   }
?>