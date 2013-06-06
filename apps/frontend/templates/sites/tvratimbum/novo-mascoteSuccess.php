<?php
/*
  $now = date('YmdHis');
  $schedule = '20121012000000';
  
  if($now > $schedule) {
    header('Location: http://tvratimbum.cmais.com.br/vencedores-seu-pedido-e-uma-ordem');
    die();
  }
  else {
    header('Location: http://tvratimbum.cmais.com.br/aguarde-ja-ja-voce-sabera-quem-foi-o-mais-votado');
    die();
  }
 * 
 */
?>
<?php
$a = Doctrine_Query::create()
  ->select('aa.*')
  ->from('AssetAnswer aa')
  ->where('aa.asset_question_id = ?', (int)$displays["enquete"][0]->Asset->AssetQuestion->id)
  ->execute();
?>
<?php use_helper('I18N', 'Date') ?>
<?php include_partial_from_folder('blocks', 'global/menu', array('site' => $site, 'mainSite' => $mainSite, 'section' => $section)) ?>
<!--CSS-->
<link rel="stylesheet" href="/portal/js/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="/portal/js/bootstrap/css/bootstrap-responsive.min.css">
<link href="/portal/tvratimbum/css/geral.css" type="text/css" rel="stylesheet">
<link href="/portal/tvratimbum/css/novoLayout-2012.css" type="text/css" rel="stylesheet">
<link href="/portal/tvratimbum/css/jquery.jcarousel.css" rel="stylesheet" type="text/css" />
<link href="/portal/tvratimbum/css/ferias-especial.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="/portal/css/tvcultura/secoes/contato.css" type="text/css" />
<!--CSS-->

<!--SCRIPT-->
<script src="/portal/tvratimbum/js/jquery-1.4.4.min.js" type="text/javascript"></script>
<!--script src="/portal/tvratimbum/js/jquery-ui-1.8.9.min.js" type="text/javascript"></script-->
<script src="/portal/tvratimbum/js/jquery.jcarousel.pack.js" type="text/javascript"></script>
<script type="text/javascript" src="/portal/js/validate/jquery.validate.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  //carrossel programas
  $('.carrossel').jcarousel({
    wrap: "both"
  });
});
</script>
<!--SCRIPT-->

<!--BODY WRAPPER-->
<div id="bodyWrapper">

  <!--CONTEUDO WRAPPER-->
  <div class="conteudoWrapper" align="center">
    
    <!--MENU RA-TIM-BUM-->
    <?php include_partial_from_folder('tvratimbum','global/top', array('site'=> $site,'section'=>$section)) ?>
    <!--/MENU RA-TIM-BUM-->
    
    <!--CONTEUDO INTERNAS-->
    <div id="ferias" class="conteudo internas">
      
      <!--COLUNA MAIOR-->
      <div class="colunaMaior">
        
        <!--TRILHA-->
        <div class="trilha">
          <p><a href="/" title="TV Rá tim Bum">TV Rá Tim Bum</a></p><span>&gt;&gt;</span><a href="/especial" title="Especial">Especial</a></p><span>&gt;&gt;</span><a href="#" title="<?php echo $section->getTitle() ?>"><?php echo $section->getTitle() ?></a>
        </div>
        <!--/TRILHA-->
        
        <!--BOX-ESPECIAL-INTERNA-->
        <div id="box-especial-interna">
          <!--WRAPPER-->
          <div class="wrapper">
            
            <div class="topo-esq"></div>
            <!--TOPO-->
            <div class="topo">
              <a href="/especial" class="enunciado">Especial</a>
            </div>
            <!--/TOPO-->
            
            <!--TITULO-->
            <div class="tarja-titulo">
              <p><?php echo $section->getTitle() ?></p>
            </div>  
            <!--/TITULO-->
            
            <!--DESTAQUE PRINCIPAL-->
            <div id="destaque-principal">
                             
              <!--CONTEUDO-->  
              <div id="container-destaque-principal">
                 Venha conhecer o Bolhota, Borbulha, Bubble, Ploc e Pug! Eles são os candidatos a mascote oficial da TV Rá Tim Bum! e vieram diretamente do Planeta Bolha para trazer ainda mais diversão para você.
				 <br>Vote no seu candidato predileto, eles estão contando com seu click! 
              </div>    
              <!--/CONTEUDO-->
           
            </div> 
            <!--/DESTAQUE PRINCIPAL-->

            <!--VOTACAO Video-->
            <div id="votacao-video">
              
              <!--LISTA-Videos-->
              <form method="post" id="e<?php echo $a[0]->Asset->getId()?>" class="form-votacao">
                <h2><?php echo $displays["enquete"][0]->Asset->AssetQuestion->getQuestion();?></h2>
                <ul id="lista-videos">
                  <?php 
                  for($i=0; $i<count($a); $i++):
                    $v = $a[$i]->Asset->retriveRelatedAssetsByAssetTypeId(6);
                    $opcao = $a[$i]->Asset->AssetAnswer->getAnswer();
                  ?>
                  <li style="float:<?php if(($i%2 == 0) == 0): echo "right;"; else: echo "left;"; endif;?>">
                     <!--<input type="radio" name="opcao" id="opcao-<?php echo $i; ?>" class="form-contato" value="<?php echo $a[$i]->Asset->AssetAnswer->id; ?>"  />
                    <label for="opcao-<?php echo $i; ?>">
                      <?php echo ($i+1)." - ". $opcao?>
                    </label>-->
                    <a href="javascript:computavoto('<?php echo $a[$i]->Asset->AssetAnswer->id; ?>');"><?php echo ($i+1)." - ". $opcao?></a>
                    <iframe title="<?php echo $opcao ?>" width="310" height="210" src="http://www.youtube.com/embed/<?php echo $v[0]->AssetVideo->getYoutubeId(); ?>?wmode=transparent#t=0m0s" frameborder="0" allowfullscreen></iframe>                    
                  </li>
                  
                  <?php endfor;?>
                </ul>

				<input type="hidden" id="opcao" name="opcao" value="" />

                                
              </form>
              <!--/LISTA-Videos-->
            
                
              <!--RESULTADO PARCIAL-->
              <div id="resultado-video" style="display:none;">
               
                <h2>Resultado Parcial: </h2>
                
                <!--LISTA-RESULTADO-->
               
                <?php
                for($i=0; $i<count($a); $i++):
					$v = $a[$i]->Asset->retriveRelatedAssetsByAssetTypeId(6);
                ?>
                
                <ul class="parcial-<?php echo $i?> classificacao <?php if($i%2==0):?> right <?php else:?> left<?php endif;?>">
                  <li>
                    <p><?php $a[$i]->Asset->AssetAnswer->getAnswer(); ?></p> 
                    <p><img src="http://i1.ytimg.com/vi/<?php echo $v[0]->AssetVideo->getYoutubeId(); ?>/mqdefault.jpg"></p> 
                    <span>00%</span>
                    <div class="progress progress-success">
                       <div class="bar" style="width: 40%"></div>
                    </div>
                  </li>
                </ul>
                <?php
                endfor;
                ?>
                <!--/LISTA-RESULTADO-->  
                
                <h2>Agradecemos seu voto! ;) </h2>
  
              </div>  
              <!--/RESULTADO PARCIAL-->
  
              <span class="picote"></span>
            
            </div>  
            <!--/VOTACAO Video-->
                                
          </div>
          <!--/WRAPPER-->

        </div>
        <!--/BOX-ESPECIAL-INTERNA-->
                
      </div>
      <!--/COLUNA MAIOR-->
    
  </div>
  <!--/ CONTEUDO INTERNAS-->
  
  <!--FOOTER RA TIM BUM-->
  <?php include_partial_from_folder('tvratimbum','global/footer') ?>
  <!--/FOOTER RA TIM BUM-->
  
  <hr />
  </div>
  <!--/CONTEUDO WRAPPER-->

</div>
<!--/BODY WRAPPER-->
<script>
//valida form votacao
$(document).ready(function(){
    var validator = $('.form-votacao').validate({
    submitHandler: function(form){
      sendAnswer()
    },
    rules:{
        opcao:{
          required: true
        }
      },
      messages:{
        opcao: "Escolha uma opção para votar."
      }
    });
});
<?php
              
echo "var nome = new Array();\n";
foreach($a as $key=>$value){
  $c = $value->Asset->AssetAnswer->getAnswer();
  echo "nome[".$key."]= '".$c."';\n";
}
 
?>
function computavoto(opcao){
	$('#opcao').val(opcao);
	sendAnswer();
}

function sendAnswer(){
  $.ajax({
    type: "POST",
    dataType: "json",
    data: $('.form-votacao').serialize(),
    url: "<?php echo url_for('homepage')?>ajax/enquetes",
    beforeSend: function(){
      $('.btn-barra.votacao').hide();
      $('#ajax-loader-b').show();
    },
    
    success: function(data){
      $(".form-votacao, #ajax-loader-b").hide();
      $("#resultado-video").fadeIn("fast");
      var i=0;
      $.each(data, function(key, val) {
        $('.parcial-'+i).html("<li><p>"+(i+1)+" - "+nome[i]+"</p><span>"+val.votes+"</span><div class='progress progress-success'><div class='bar' style='width:"+val.votes+"'></div></div></li>")
        i++;
      });      
    }
  });
  
}
</script>