<link rel="stylesheet" href="/portal/css/geral.css" type="text/css" />
<link rel="stylesheet" href="/portal/css/tvcultura/geral.css" type="text/css" />
<link rel="stylesheet" href="/portal/css/tvcultura/sites/<?php echo $section->Site->getSlug() ?>.css" type="text/css" />
<script type="text/javascript" src="http://cmais.com.br/portal/js/mediaplayer/swfobject.js"></script> 
<script type="text/javascript" src="/portal/js/mediaplayer/swfobject.js"></script>
      
<script>

  // Update Twitter Statuses
  function updateTweets(){
    $.ajax({
      url: "/ajax/tweetmonitor",
      data: "monitor_id=5",
      success: function(data) {
        $('#twitter').html(data);
      }
    });
  }
 
  $(function(){ //onready
    updateTweets();
    var t=setInterval("updateTweets()",60000);
  });
</script>

<?php use_helper('I18N', 'Date') ?>

<?php include_partial_from_folder('blocks', 'global/menu', array('site' => $site, 'mainSite' => $mainSite, 'asset' => $asset, 'section' => $section)) ?>

    <!-- CAPA SITE -->
    <div id="capa-site">

      <?php if(isset($displays["alerta"])) include_partial_from_folder('blocks','global/breakingnews', array('displays' => $displays["alerta"])) ?>

      <!-- BARRA SITE -->
      <div id="barra-site">

        <div class="topo-programa">
          
          <h2><img src="/portal/images/capaPrograma/teleton/logo.png" /></h2>
          <a href="http://teleton.org.br/welcome.html" title="Teleton" target="_blank" class="numeros"></a>          
              
        </div>

       

      </div>
      <!-- /BARRA SITE -->

      <!-- MIOLO -->
      <div id="miolo">
        <!-- CONTEUDO PAGINA -->
        <div id="conteudo-pagina">

          <!-- CAPA -->
          <div class="capa grid3">

            <!-- ESQUERDA -->
            <div id="esquerda" class="grid2">

              <!-- NOTICIA INTERNA -->
              <div class="box-interna grid2">
                <h3><?php echo $displays['destaque-principal'][0]->getTitle() ?></h3>
                <div class="assinatura grid2">
                  <p class="sup"></p>
                  <div class="box-compartilhar cp-sembg grid2">                  
            <div class="btn-compartilhar">
              <p class="compartilhar">Compartilhar</p>
              <!--a class="print" href="JavaScript:window.print();"></a-->      
              <a class="twt" href="http://twitter.com/TeletonOficial" target="_blank"></a>
              <a class="fb" href="https://www.facebook.com/tvcultura" target="_blank"></a>
              <div class="gplus">
              <!-- Place this tag where you want the +1 button to render. -->
              <div class="g-plusone" data-size="small" ></div>
              
             
              </div>
            </div>        
          </div>
                </div>
                
                <div class="texto">
            <?php if(isset($displays['destaque-principal'])): ?>
              <!-- DESTAQUE 2 COLUNAS -->
              <div class="duas-colunas destaque grid2"> 
                  <iframe width="640" height="360" src="http://www.youtube.com/embed/9hgSRNhKPlY?rel=0&wmode=transparent#t=0m0s?version=3&amp;hl=en_US&amp;fs=1" frameborder="0" allowfullscreen></iframe>
                  <!--
                  <?php if($displays['destaque-principal'][0]->Asset->AssetType->getSlug() == "image"): ?>
                  <a class="" href="<?php echo $displays[0]->retriveUrl() ?>" title="<?php echo $displays['destaque-principal'][0]->getTitle() ?>">
                  <img src="<?php echo $displays['destaque-principal'][0]->retriveImageUrlByImageUsage('image-6') ?>" alt="<?php echo $displays['destaque-principal'][0]->Asset->getTitle() ?>" name="<?php echo $displays['destaque-principal'][0]->Asset->getTitle() ?>" />
                  
                  <?php elseif($displays['destaque-principal'][0]->Asset->AssetType->getSlug() == "content" || $displays['destaque-principal'][0]->Asset->AssetType->getSlug() == "image-gallery"): ?>
                    <?php $imgs = $displays['destaque-principal'][0]->Asset->retriveRelatedAssetsByAssetTypeId(2); ?>
                    <?php if(count($imgs) > 0): ?>
                      <img src="http://midia.cmais.com.br/assets/image/image-6/<?php echo $imgs[0]->AssetImage->getFile() ?>.jpg" alt="<?php echo $displays['destaque-principal'][0]->Asset->getTitle() ?>" name="<?php echo $displays['destaque-principal'][0]->Asset->getTitle() ?>" />
                    <?php endif; ?>
                  </a>
                  <?php elseif($displays['destaque-principal'][0]->Asset->AssetType->getSlug() == "video"): ?>
                    <iframe title="<?php echo $displays['destaque-principal'][0]->getTitle() ?>" width="640" height="384" src="http://www.youtube.com/embed/<?php echo $displays['destaque-principal'][0]->Asset->AssetVideo->getYoutubeId(); ?>?rel=0&wmode=transparent#t=0m0s" frameborder="0" allowfullscreen></iframe>
                  <?php elseif($displays['destaque-principal'][0]->Asset->AssetType->getSlug() == "video-gallery"): ?>
                    <object height="390" width="640" style="height:390px; width: 640px">
                      <param name="movie" value="http://www.youtube.com/p/<?php echo $displays['destaque-principal'][0]->Asset->AssetVideoGallery->getYoutubeId(); ?>?version=3&amp;hl=en_US&amp;fs=1" />
                      <param name="allowFullScreen" value="true" />
                      <param name="allowscriptaccess" value="always" />
                      <param name="wmode" value="opaque">
                      <embed allowfullscreen="true" allowscriptaccess="always" src="http://www.youtube.com/p/<?php echo $displays['destaque-principal'][0]->Asset->AssetVideoGallery->getYoutubeId(); ?>?version=3&amp;hl=en_US&amp;fs=1" wmode="opaque" type="application/x-shockwave-flash" width="640" height="390"></embed>
                    </object>
                  <?php else: ?>
                  <a class="" href="<?php echo $displays[0]->retriveUrl() ?>" title="<?php echo $displays['destaque-principal'][0]->getTitle() ?>">
                  <img src="<?php echo $displays['destaque-principal'][0]->retriveImageUrlByImageUsage('image-6') ?>" alt="<?php echo $displays['destaque-principal'][0]->getTitle() ?>" name="<?php echo $displays['destaque-principal'][0]->getTitle() ?>" />
                  <?php endif; ?>
                -->
                <p class="titulos" style="margin-bottom:0px"><?php echo $displays['destaque-principal'][0]->getTitle() ?></p>
                <p><?php echo $displays['destaque-principal'][0]->getDescription() ?></p>
              </div>
              <!-- /DESTAQUE 2 COLUNAS -->
          <?php endif; ?>
                </div>
                
                <?php include_partial_from_folder('blocks','global/share-2c', array('site' => $site, 'uri' => $uri)) ?>

              </div>
              <!-- /NOTICIA INTERNA -->
              
            </div>
            <!-- /ESQUERDA -->
            
            <!-- DIREITA -->
            <div id="direita" class="grid1">
              <h3>Bastidores</h3> 
              <div id="canal" class="grid1">
                  <!-- BOX CANAL YOUTUBE -->
                  <script src="http://www.gmodules.com/ig/ifr?url=http://www.google.com/ig/modules/youtube.xml&up_channel=culturanoteleton&synd=open&w=300&h=390&title=&border=%23ffffff%7C3px%2C1px+solid+%23999999&output=js"></script>
                  <!-- /BOX CANAL YOUTUBE -->
                </div>  
              <!-- BOX TWITTER -->
                <div class="grid1">
                  <a href="http://twitter.com/teletonoficial" class="twitter-follow-button" target="_blank">Siga @teletonoficial</a>
                 
                  <div id="twitter"></div>
                  
                </div>
              <!-- /BOX TWITTER -->              
            </div>
            <!-- /DIREITA -->
          </div>
          <!-- /CAPA -->
        </div>
        <!-- /CONTEUDO PAGINA -->
      </div>
      <!-- /MIOLO -->
    </div>
    <!-- /CAPA SITE -->
     <!-- Place this tag after the last +1 button tag. -->
              <script type="text/javascript">
                window.___gcfg = {lang: 'pt-BR'};
              
                (function() {
                  var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
                  po.src = 'https://apis.google.com/js/plusone.js';
                  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
                })();
              </script>

