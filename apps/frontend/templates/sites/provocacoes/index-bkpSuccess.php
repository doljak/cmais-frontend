<script type="text/javascript" src="/portal/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script type="text/javascript" src="/portal/js/fancybox/jquery.easing-1.3.pack.js"></script>
<script type="text/javascript" src="/portal/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<link rel="stylesheet" href="/portal/js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />

<script type="text/javascript" src="/portal/js/mediaplayer/swfobject.js"></script>
<script type="text/javascript" src="/portal/js/jquery.nivo.slider.pack.js"></script>
<script type="text/javascript" src="/portal/js/validate/jquery.validate.js"></script>

<script type="text/javascript">
  $(function() {

    // acervo em destaque
    $('.carrossel').jcarousel({
      wrap : "both"
    });
    
    // charges caruso
    $('a.img').fancybox();
    //$('#gallery ul li:last').remove();

  });

</script>

<link rel="stylesheet" href="/portal/css/tvcultura/secoes/defaultPrograma.css" type="text/css" />
<link rel="stylesheet" href="/portal/css/tvcultura/sites/provocacoes.css" type="text/css" />


<?php use_helper('I18N', 'Date') ?>
<?php include_partial_from_folder('blocks', 'global/menu', array('site' => $site, 'mainSite' => $mainSite, 'section' => $section)) ?>

<!-- CAPA SITE -->
<div class="bg-provocacoes" id="home">
  <div id="capa-site">
    <!-- BREAKING NEWS -->
    <?php if(isset($displays["alerta"])) include_partial_from_folder('blocks','global/breakingnews', array('displays' => $displays["alerta"]))
    ?>
    <!-- /BREAKING NEWS -->
    <!-- BARRA SITE -->
    <div id="barra-site">
      <div class="topo-programa">
        <?php if(isset($program) && $program->id > 0):
        ?>
        <h2><a href="<?php echo $program->retriveUrl() ?>" title="<?php echo $program->getTitle() ?>"> <img title="<?php echo $program->getTitle() ?>" alt="<?php echo $program->getTitle() ?>" src="/portal/images/capaPrograma/provocacoes/logo.png"> </a></h2>
        <?php endif;?>

        <?php if(isset($program) && $program->id > 0):
        ?>
        <?php include_partial_from_folder('blocks','global/like', array('site' => $site, 'uri' => $uri, 'program' => $program))
        ?>
        <?php endif;?>

        <?php if(isset($program) && $program->id > 0):
        ?>
        <!-- horario -->
          <div id="horario">
            <p><?php echo html_entity_decode($program->getSchedule()) ?></p>
          </div>
          <!-- /horario -->
        <?php endif;?>
      </div>
      <!-- box-topo -->
      <div class="box-topo grid3">
        <?php if(count($siteSections) > 0):
        ?>
        <ul class="menu">
          <?php foreach($siteSections as $s):
          ?>
          <li><a href="<?php echo $s->retriveUrl() ?>" title="<?php echo $s->getTitle() ?>" <?php if($s->getId() == $section->getId()):?>class="ativo"<?php endif;?>><span><?php echo $s->getTitle()
          ?></span></a></li>
          <?php endforeach;?>
        </ul>
        <?php endif;?>
      </div>
      <!-- /box-topo -->
    </div>
    <!-- /BARRA SITE -->
    <!-- MIOLO -->
    <div id="miolo">
      <!-- BOX LATERAL -->
      <?php include_partial_from_folder('blocks','global/shortcuts')
      ?>
      <!-- BOX LATERAL -->
      <!-- CONTEUDO PAGINA -->
      <div id="conteudo-pagina exceptionn">
      
        <!-- CAPA -->
        <!-- destaque principal e barra compartilhar -->
        <div class="capa grid3 exceptionn">
        
          <div class="tudo-provocacoes">
            <span class="bordaTopRV"></span>
            <div class="centroRV">
              
              <div class="video-interna">
                <div class="boxVideo">
               <div class="">
                   <?php include_partial_from_folder('blocks','global/display-2c', array('displays' => $displays["destaque-principal"])) ?>
                    <?php include_partial_from_folder('blocks','global/share-2c-close', array('site' => $site, 'uri' => $uri)) ?>
             </div>
                    
        <!-- /destaque principal e barra compartilhar-->
                
                  <div class="acervoDestaque" style="display: block;">
                    <h3>acervo em destaque</h3>
                    <div class="carrossel jcarousel-container jcarousel-container-horizontal" style="position: relative; display: block;">
                      <div class="jcarousel-clip jcarousel-clip-horizontal" style="overflow: hidden; position: relative;">
                    <?php include_partial_from_folder('blocks','global/display-2c-playlist', array('displays' => $displays["destaque-playlist"])) ?>
                      </div><div class="jcarousel-prev jcarousel-prev-horizontal" style="display: block;"></div><div class="jcarousel-next jcarousel-next-horizontal" style="display: block;"></div>
                    </div>
                    <a href="/rodaviva/programas" class="acervoCompleto"><span>+ Acervo completo</span></a>
                  
                  </div>
                       
                  <div class="grid1" style="margin-right:20px; ">
                    <?php if(isset($displays["destaque-padrao-1"])) include_partial_from_folder('sites/provocacoes','global/display1c-news', array('displays' => $displays["destaque-padrao-1"])) ?>
                  </div>
                  <div class="grid1">
                    <?php if(isset($displays["destaque-padrao-2"])) include_partial_from_folder('sites/provocacoes','global/display1c-news', array('displays' => $displays["destaque-padrao-2"])) ?>
                  </div>
                  <div class="grid1" style="margin-right:20px; ">
                    <?php if(isset($displays["destaque-padrao-3"])) include_partial_from_folder('sites/provocacoes','global/display1c-news', array('displays' => $displays["destaque-padrao-3"])) ?>
                  </div>
                  <div class="grid1">
                    <?php if(isset($displays["destaque-padrao-4"])) include_partial_from_folder('sites/provocacoes','global/display1c-news', array('displays' => $displays["destaque-padrao-4"])) ?>
                  </div>
            
                 
               
                  
                  
                  </div>
                   <div class="veja">
                     <?php include_partial_from_folder('blocks','global/display-1c-vertical-multiple', array('displays' => $displays["destaque-secundario"])) ?>
                     
                  <div class="box-publicidade">
                    
                    <!-- tvcultura-homepage-300x250 -->
                    <script type="text/javascript">
            GA_googleFillSlot("cmais-assets-300x250");

                    </script>
                  </div>
                  <div class="boxRedes">
                    <ul>
                      <li><a target="_blank" href="http://twitter.com/provocacoes" class="twitter"><span class="ico"></span><span class="borda"></span><span class="nome">Siga o @provocacoes</span></a></li>
                      <li><a target="_blank" href="http://www.facebook.com/provocacoes" class="facebook"><span class="ico"></span><span class="borda"></span><span class="nome">Curta a página no facebook</span></a></li>
                      <li><a target="_blank" href="http://www.youtube.com/provocacoes" class="youtube"><span class="ico"></span><span class="borda"></span><span class="nome">Veja os vídeos no YouTube</span></a></li>
                      
                      
                    </ul>
                    
                  </div>
               
                <?php
                     $episode = Doctrine_Query::create()
                    ->select('a.*')
                    ->from('Asset a, AssetEpisode ae')
                    ->where('a.id = ae.asset_id')
                    ->andWhere('a.site_id = ?', (int)$site->id)
                    ->andWhere('a.asset_type_id = 15')
                    ->andWhere("(a.date_start IS NULL OR a.date_start <= CURRENT_TIMESTAMP)")
                    ->limit(1)
                    ->orderBy('a.id desc')
                    ->fetchOne();
                    if($episode){
                      $galeria = $episode->retriveRelatedAssetsByAssetTypeId(3);
                      if($galeria) {
                        $images = $galeria[0]->retriveRelatedAssetsByAssetTypeId(2);
                        
                      };
                    }
                 ?> 
                   
                  <?php if($images): ?>
                  <div class="charges">
                    <h3>Galeria de Fotos</h3>
                    <div class="box-charges">
                      <div id="gallery">
                    <ul>
                      <?php foreach($images as $k=>$d): ?>
                        <li>
                            <a class="img" href="<?php echo $d->retriveImageUrlByImageUsage("image-6-b") ?>" title="<?php echo $d->getTitle() ?>" rel="charges_caruso">
                                <img src="<?php echo $d->retriveImageUrlByImageUsage("image-1-b") ?>" alt="<?php echo $d->getTitle() ?>" />
                            </a>
                        </li>
                      <?php endforeach; ?>
                    </ul>
                </div>
                    </div>
                  </div>
                  <?php endif; ?>
                       
                       
                        <a href="../provocacoes/programas" class="sugestoes"><span>outros programas</span></a>
                    </div>
                       </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          <span class="bordaBottomRV"></span>
          </div>
          
          
        </div>
        
      </div>
      <!-- /CONTEUDO PAGINA -->
    </div>
    <!-- /MIOLO -->
  </div>
  <!-- /capa site-->
</div>
<!-- /bg provocacoes-->
