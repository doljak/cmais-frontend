<?php
//piada destaque da semana da sessao piadas
$displays = array();
                
$block = Doctrine_Query::create()
  ->select('b.*')
  ->from('Block b, Section s')
  ->where('b.section_id = s.id')
  ->andWhere('s.slug = "ideias"')
  ->andWhere('s.site_id = ?', $site->id)
  ->execute();
?>

<?php use_helper('I18N', 'Date') ?>
<?php include_partial_from_folder('blocks', 'global/menu', array('site' => $site, 'mainSite' => $mainSite, 'section' => $section)) ?>
<!--CSS-->
<link href="http://cmais.com.br/portal/tvratimbum/css/geral.css" type="text/css" rel="stylesheet">
<link href="http://cmais.com.br/portal/tvratimbum/css/novoLayout-2012.css" type="text/css" rel="stylesheet">
<link href="http://cmais.com.br/portal/tvratimbum/css/jquery.jcarousel.css" rel="stylesheet" type="text/css" />
<link href="http://cmais.com.br/portal/tvratimbum/css/ferias-especial.css" rel="stylesheet" type="text/css" />
<!--CSS-->

<!--SCRIPT-->
<script src="http://cmais.com.br/portal/tvratimbum/js/jquery-1.4.4.min.js" type="text/javascript"></script>
<!--script src="http://cmais.com.br/portal/tvratimbum/js/jquery-ui-1.8.9.min.js" type="text/javascript"></script-->
<script src="http://cmais.com.br/portal/tvratimbum/js/jquery.jcarousel.pack.js" type="text/javascript"></script>
<script src="http://cmais.com.br/portal/tvratimbum/js/jPlayer/js/jquery.jplayer.min.js" type="text/javascript"></script>
<script src="http://cmais.com.br/portal/tvratimbum/js/scroll.jquery.js" type="text/javascript"></script>
<script>
  $(document).ready(function(){
    //carrossel programas
    $('.carrossel').jcarousel({
      wrap: "both"
    });

  });
</script>
<!--SCRIPT-->
<script>
  
  function loadScroll(){
  	
  	var stop = false;

    $('#infinite_scroll').scrollLoad({
      url : 'http://app.cmais.com.br/ajax/infinitescroll',
      dataType: "jsonp",
      getData : function() {
        return "page="+$('#pag').val()+"&section_id=<?php echo $section->getId()?>&site_id=<?php echo $section->Site->getId()?>&piadas=1";
      },
      start : function() {
        $('.loading.inicial').hide();
        $('<div class="loading" style="width:220px;margin:20px auto;"><img src="http://cmais.com.br/portal/images/ajax-loader-especial.gif"/></div>').appendTo(this);
      },
      ScrollAfterHeight : 95,     //this is the height in percentage
      onload : function( data ) {
     		$('.loading').remove();
      	if(data != ""){
	        $(this).append( data );
	        $('#pag').val(parseInt($('#pag').val())+1);
      	}else{
      		stop = true;
      	}
      },
      continueWhile : function( resp ) {
      	if(!stop)
      		return true;
      	else
      		return false;
      	/*
        if( $(this).children('li').length >= 100 ) {
          return false;
        }
        return true;
        */
      }
    });
  }
  
  $(document).ready(function(){
    $.ajax({
      url: "http://app.cmais.com.br/ajax/infinitescroll",
      dataType: "jsonp",
      data: "page=1&section_id=<?php echo $section->getId()?>&site_id=<?php echo $section->Site->getId()?>&piadas=1",
      success: function(data){
        $('#infinite_scroll').html(data.data);
        loadScroll();
      }
    });
  });
</script>


<input type="text" name="pag" id="pag" value="2" />
<!--BODY WRAPPER-->
<div id="bodyWrapper">

  <!--CONTEUDO WRAPPER-->
  <div class="conteudoWrapper" align="center">
    
    <!--MENU RA-TIM-BUM-->
    <?php include_partial_from_folder('tvratimbum','global/top', array('site'=> $site,'section'=>$section)) ?>
    <!--/MENU RA-TIM-BUM-->
    
    <!--CONTEUDO INTERNAS-->
    <div id="ferias" class="conteudo internas listao">
      
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
        
            <!--PIADA DA SEMANA-->
            <div id="piada-da-semana">
            
                           <div id="listao-piada">
                <a class="btn-lista-piadas" href="/ideias-mirabolantes" title="vote para piada da semana">Aproveite para enviar sua ideia também!</a>
                
                <h2>LISTÃO DE IDEIAS MIRABOLANTES PARA MUDAR O MUNDO</h2>
                <!--LISTA-PIADA-->
                <div class="loading inicial" style="width:220px;margin:20px auto;">
                  <img src="http://cmais.com.br/portal/images/ajax-loader-especial.gif"/>
                </div>
                <ul class="lista-piadas" id="infinite_scroll">
                
                  <!--li>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        In iaculis diam eget enim porta id consectetur massa venenatis. 
                        Suspendisse elit lacus, sodales ac imperdiet sit amet, gravida sed dolor.
                         Suspendisse potenti. Vivamus non laoreet erat volutpat.
                      </p>
                      <span>(Nome da Criança - Cidade/UF)</span>
                      
                  </li>
                  <span class="picote"></span>
                  <li>
                      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                        In iaculis diam eget enim porta id consectetur massa venenatis. 
                        Suspendisse elit lacus, sodales ac imperdiet sit amet, gravida sed dolor.
                         Suspendisse potenti. Vivamus non laoreet erat volutpat.
                      </p>
                      <span>(Nome da Criança - Cidade/UF)</span>
                      
                  </li>
                  <span class="picote"></span-->
                </ul>
                               
                <!--/LISTA-PIADA-->

              </div>  
              <!--/LISTA PIADA-->
              
              
              
            </div>
            
            <hr />
            
            <span class="picote"></span>
            
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

