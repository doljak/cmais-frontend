<link rel="stylesheet" href="/portal/css/tvcultura/secoes/defaultPrograma.css" type="text/css" />
<link rel="stylesheet" href="/portal/css/tvcultura/secoes/programaBlog.css" type="text/css" />
<link rel="stylesheet" href="/portal/css/tvcultura/sites/<?php echo $asset->Site->getSlug() ?>.css" type="text/css" />

<script type="text/javascript" src="/js/jquery-ui-1.8.7/jquery-1.4.4.min.js"></script>
<link href="/js/audioplayer/jPlayer.Blue.Monday.2.0.0/jplayer.blue.monday.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/js/audioplayer/jplayer_min.js"></script>

<?php use_helper('I18N', 'Date') ?>
<?php include_partial_from_folder('blocks', 'global/menu', array('site' => $site, 'mainSite' => $mainSite, 'asset' => $asset, 'section' => $section)) ?>

	<div class="bg-chamada">
	  <?php if(isset($displays["alerta"])) include_partial_from_folder('blocks','global/breakingnews', array('displays' => $displays["alerta"])) ?>
	</div>
	<div class="bg-site"></div>

    <!-- CAPA SITE -->
    <div id="capa-site">

      

      <!-- BARRA SITE -->
      <div id="barra-site">

        <div class="topo-programa">
          <?php if(isset($program) && $program->id > 0): ?>
          <h2>
            <a href="<?php echo $program->retriveUrl() ?>" style="text-decoration: none;">
              <?php if($program->getImageThumb() != ""): ?>
                <img src="http://midia.cmais.com.br/programs/<?php echo $program->getImageThumb() ?>" alt="<?php echo $program->getTitle() ?>" title="<?php echo $program->getTitle() ?>" />
              <?php else: ?>
                <h3 class="tit-pagina grid1"><?php echo $program->getTitle() ?></h3>
              <?php endif; ?>
            </a>
          </h2>
          <?php endif; ?>
          
          <?php if(isset($program) && $program->id > 0): ?>
          <?php include_partial_from_folder('blocks','global/like', array('site' => $site, 'uri' => $uri, 'program' => $program)) ?>
          <?php endif; ?>

          <?php if(isset($program) && $program->id > 0): ?>
            <!-- horario -->
            <div id="horario">
              <p><?php echo html_entity_decode($program->getSchedule()) ?></p>
            </div>
            <!-- /horario -->
          <?php endif; ?>
        </div>

        <?php if(isset($siteSections) && $site->getType() != "Portal"): ?>
        <!-- box-topo -->
        <div class="box-topo grid3">

          <?php include_partial_from_folder('blocks','global/sections-menu', array('siteSections' => $siteSections)) ?>

          <?php if(isset($section->slug)): ?>
            <?php if(!in_array(strtolower($section->getSlug()), array('home','homepage','home-page','index'))): ?>
            <div class="navegacao txt-10">
              <a href="<?php echo $site->retriveUrl() ?>" title="Home">Home</a>
              <span>&gt;</span>
              <a href="<?php echo $asset->retriveUrl()?>" title="<?php echo $asset->getTitle()?>"><?php echo $asset->getTitle()?></a>
            </div>
            <?php endif; ?>
          <?php endif; ?>

        </div>
        <!-- /box-topo -->
        <?php endif; ?>

      </div>
      <!-- /BARRA SITE -->

      <!-- MIOLO -->
      <div id="miolo">
      
        <!-- BOX LATERAL -->
        <?php include_partial_from_folder('blocks','global/shortcuts') ?>
        <!-- BOX LATERAL -->

        <!-- CONTEUDO PAGINA -->
        <div id="conteudo-pagina">

          <!-- CAPA -->
          <div class="capa grid3">

            <!-- ESQUERDA -->
            <div id="esquerda" class="grid2">

              <!-- NOTICIA INTERNA -->
              <div class="box-interna grid2">
                <h3><?php echo $asset->getTitle() ?></h3>
                <p><?php echo $asset->getDescription() ?></p>
                <div class="assinatura grid2">
                  <p class="sup"><?php echo $asset->AssetContent->getAuthor() ?> <span><?php echo $asset->retriveLabel() ?></span></p>
                  <p class="inf"><?php echo format_date($asset->getCreatedAt(), "g") ?> - Atualizado em <?php echo format_date($asset->getUpdatedAt(), "g") ?></p>
                  <!--
                  <div class="acessibilidade">
                    <a href="#" class="zoom">+A</a>
                    <a href="#" class="zoom">-A</a>
                  </div>
                  -->

                  <?php include_partial_from_folder('blocks','global/share-small', array('site' => $site, 'uri' => $uri)) ?>

                </div>
                
                <?php $videoRelated = $asset->retriveRelatedAssetsByAssetTypeId(6); ?>
                
                
		            <?php if(isset($videoRelated)): ?>
		              <!-- DESTAQUE 2 COLUNAS -->
		              <div class="duas-colunas destaque grid2">
		
		                  <?php if($videoRelated->AssetType->getSlug() == "image"): ?>
		                  <a class="" href="<?php echo $videoRelated->retriveUrl() ?>" title="<?php echo $asset->getTitle() ?>">
		                  <img src="<?php echo $asset->retriveImageUrlByImageUsage('image-6') ?>" alt="<?php echo $videoRelated->getTitle() ?>" name="<?php echo $videoRelated->getTitle() ?>" />
		                  
		                  <?php elseif($videoRelated->AssetType->getSlug() == "content" || $videoRelated->AssetType->getSlug() == "image-gallery"): ?>
		                    <?php $imgs = $videoRelated->retriveRelatedAssetsByAssetTypeId(2); ?>
		                    <?php if(count($imgs) > 0): ?>
		                      <img src="/uploads/assets/image/image-6/<?php echo $imgs[0]->AssetImage->getFile() ?>.jpg" alt="<?php echo $videoRelated->getTitle() ?>" name="<?php echo $videoRelated->getTitle() ?>" />
		                    <?php endif; ?>
		                  </a>
		
		                  <?php elseif($videoRelated->AssetType->getSlug() == "video"): ?>
		                    <object style="height:390px; width: 640px">
		                      <param name="movie" value="http://www.youtube.com/v/<?php echo $videoRelated->AssetVideo->getYoutubeId() ?>?version=3&enablejsapi=1&playerapiid=ytplayer&rel=0">
		                      <param name="allowFullScreen" value="true">
		                      <param name="allowScriptAccess" value="always">
		                      <param name="wmode" value="opaque">
		                      <embed id="ytplayer" src="http://www.youtube.com/v/<?php echo $videoRelated->AssetVideo->getYoutubeId() ?>?version=3&enablejsapi=1&playerapiid=ytplayer&rel=0" wmode="opaque" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="640" height="390"></embed>
		                    </object>
		
		                  <?php elseif($videoRelated->AssetType->getSlug() == "video-gallery" || $videoRelated->AssetType->getSlug() == "episode"): ?>
		                    <?php 
		                    if($videoRelated->AssetType->getSlug() == "video-gallery")
		                      $youtubeid = $videoRelated->AssetVideoGallery->getYoutubeId();
		                    else
		                      $youtubeid = "";
		                    ?>
		                    <?php if($youtubeid != ""): ?>
		                    <iframe width="640" height="390" src="http://www.youtube.com/embed/videoseries?list=PL<?php echo $youtubeid ?>&amp;hl=en_US" frameborder="0" allowfullscreen></iframe>
		                    <?php /*
		                    <object height="390" width="640" style="height:390px; width: 640px">
		                      <param name="movie" value="http://www.youtube.com/p/<?php echo $youtubeid ?>?version=3&amp;hl=en_US&amp;fs=1" />
		                      <param name="allowFullScreen" value="true" />
		                      <param name="allowscriptaccess" value="always" />
		                      <param name="wmode" value="opaque">
		                      <embed allowfullscreen="true" allowscriptaccess="always" src="http://www.youtube.com/p/<?php echo $youtubeid ?>?version=3&amp;hl=en_US&amp;fs=1" wmode="opaque" type="application/x-shockwave-flash" width="640" height="390"></embed>
		                    </object>
		                    */?>
		                    <?php else: ?>
		                    <?php $videos = $videoRelated->retriveRelatedAssetsByAssetTypeId(6); ?>
		                    <div id="player"><iframe title="<?php echo $videos[0]->getTitle() ?>" width="640" height="390" src="http://www.youtube.com/embed/<?php echo $videos[0]->AssetVideo->getYoutubeId(); ?>?wmode=transparent" frameborder="0" allowfullscreen></iframe></div>
		                    <script>
		                    function changeVideo(id){
		                      $('#player').html('<iframe width="640" height="390" src="http://www.youtube.com/embed/'+id+'?wmode=transparent" frameborder="0" allowfullscreen></iframe>');
		                    }
		                    </script>
		
		                    <?php if(count($videos) > 0): ?>
		                      <ul class="box-playlist grid2">
		                        <?php foreach($videos as $k=>$dd): ?>
		                          <li style="width: 155px">
		                            <?php if($dd->retriveImageUrlByImageUsage("image-2") != ""): ?>
		                            <a href="javascript:changeVideo('<?php echo $dd->AssetVideo->getYoutubeId(); ?>')" class="img">
		                              <img class="img-150x90" src="<?php echo $dd->retriveImageUrlByImageUsage("image-2") ?>" alt="<?php echo $dd->getTitle() ?>" />
		                            </a>
		                            <?php endif; ?>
		                            <?php if($dd->retriveLabel() != ""): ?>
		                            <h3 class="chapeu"><?php echo $dd->retriveLabel() ?></h3>
		                            <?php endif; ?>
		                            <a href="<?php echo $dd->retriveUrl() ?>"><?php echo $dd->getDescription() ?></a>
		                          </li>
		                        <?php endforeach; ?>
		                      </ul>
		                    <?php endif; ?>
		                    <?php endif; ?>
		                  
		                  <?php else: ?>
		                  <div style="width:640px; height:390px;"><h2><?php echo $videoRelated->getTitle() ?></h2><h4><?php echo $videoRelated->getDescription() ?></h4></div>
		                  <?php endif; ?>
		              </div>
		              <!-- /DESTAQUE 2 COLUNAS -->
		          <?php endif; ?>                
                
                
                
                
                
                
                
                
                <div class="texto">
                  <?php if($asset->AssetType->getSlug() == "person"): ?>
                    <?php echo html_entity_decode($asset->AssetPerson->getBio()) ?>
                  <?php else: ?>
                    <?php echo html_entity_decode($asset->AssetContent->render()) ?>
                  <?php endif; ?>
                </div>
                
                <?php $relacionados = $asset->retriveRelatedAssetsByRelationType('Asset Relacionado'); ?>
                <?php if(count($relacionados) > 0): ?>
                	
                	
                  <!-- SAIBA MAIS -->
                  <div class="box-padrao grid2" style="margin-bottom: 20px;">
                  	<div id="saibamais">                                                            
                  	<h4>saiba +</h4>                                                            
                    <ul class="conteudo">
                      <?php foreach($relacionados as $k=>$d): ?>
                        <li style="width: auto;">
                          <a class="titulos" href="<?php echo $d->retriveUrl()?>" style="width: auto;"><?php echo $d->getTitle()?></a>
                          <!--
                          <?php if($d->retriveImageUrlByImageUsage("image-1") != ""): ?>
                            <a href="<?php echo $d->retriveUrl()?>" class="img-90x54" style="width: auto">
                              <img src="<?php echo $d->retriveImageUrlByImageUsage("image-1-b") ?>" alt="<?php echo $d->getTitle() ?>" title="<?php echo $d->getTitle() ?>" style="width: auto" />
                            </a>
                          <?php endif; ?>
                          -->
                          <!--p><?php echo $d->getDescription()?></p-->
                        </li>
                      <?php endforeach; ?>
                    </ul>
                   </div>
                  </div>
                  <!-- SAIBA MAIS -->
                <?php endif; ?>
                
                <?php include_partial_from_folder('blocks','global/share-2c', array('site' => $site, 'uri' => $uri)) ?>

              </div>
              <!-- /NOTICIA INTERNA -->
              
            </div>
            <!-- /ESQUERDA -->
            
            <!-- DIREITA -->
            <div id="direita" class="grid1">

              <!-- BOX PADRAO -->
              <?php if(isset($displays["destaque-apresentadores"])) include_partial_from_folder('blocks','global/display-1c-hosts', array('displays' => $displays["destaque-apresentadores"])) ?>
              <!-- /BOX PADRAO -->
              
              <!-- BOX PUBLICIDADE -->
              <div class="box-publicidade grid1">
                <!-- programas-assets-300x250 -->
                <script type='text/javascript'>
                GA_googleFillSlot("programas-assets-300x250");
                </script>
              </div>
              <!-- / BOX PUBLICIDADE -->

              <?php $relacionados = array(); if($asset) $relacionados = $asset->retriveRelatedAssets2(); ?>
              <?php if(count($relacionados) > 0): ?>
              <!-- BOX PADRAO Mais recentes -->
              <div class="box-padrao grid1">
                <div class="topo claro">
                  <span></span>
                  <div class="capa-titulo">
                    <h4>relacionadas</h4>
                    <a href="#" class="rss" title="rss"></a>
                  </div>
                </div>
                <?php if(count($relacionados) > 0) include_partial_from_folder('blocks','global/recent-news', array('displays' => $relacionados)) ?>
              </div>
              <!-- BOX PADRAO Mais recentes -->
              <?php endif; ?>

              <?php if(isset($displays["destaque-noticias-recentes"])): ?>
              <!-- BOX PADRAO Mais recentes -->
              <div class="box-padrao grid1">
                <div class="topo claro">
                  <span></span>
                  <div class="capa-titulo">
                    <h4>+ recentes</h4>
                    <a href="<?php echo $site->getSlug() ?>/feed" class="rss" title="rss" style="display: block"></a>
                  </div>
                </div>
                <?php if(isset($displays["destaque-noticias-recentes"])) include_partial_from_folder('blocks','global/recent-news', array('displays' => $displays["destaque-noticias-recentes"])) ?>
              </div>
              <!-- BOX PADRAO Mais recentes -->
              <?php endif; ?>

              <?php if(isset($displays["destaque-categorias"])): ?>
              <!-- BORDA 02 -->
              <div class="box-padrao box-borda grid1">
                <div class="topo claro">
                  <span></span>
                  <div class="capa-titulo">
                    <h4><?php if(isset($displays["destaque-categorias"])) echo $displays["destaque-categorias"][0]->Block->getTitle() ?></h4>
                  </div>
                </div>
                <div class="conteudo top tipo2">
                  <?php if(isset($displays["destaque-categorias"])) include_partial_from_folder('blocks','global/popular-news', array('displays' => $displays["destaque-categorias"])) ?>
                </div>
                <div class="detalhe-borda grid1"></div>
              </div>
              <!-- /BORDA 02 -->
              <?php endif; ?>
              
              <?php if(isset($displays["destaque-links"])): ?>
              <!-- BOX PADRAO + Visitados -->
              <div class="box-padrao mais-visitados grid1">
                <div class="topo">
                  <span></span>
                  <div class="capa-titulo">
                    <h4><?php if(isset($displays["destaque-links"])) echo $displays["destaque-links"][0]->Block->getTitle() ?></h4>
                  </div>
                </div>
                <?php if(isset($displays["destaque-links"])) include_partial_from_folder('blocks','global/popular-news', array('displays' => $displays["destaque-links"])) ?>
              </div>
              <!-- /BOX PADRAO + Visitados -->
              <?php endif; ?>

              <?php include_partial_from_folder('blocks','global/facebook-1c-2', array('site' => $site, 'url' => $url)) ?>

            </div>
            <!-- /DIREITA -->

            </div>
            <!-- /DIREITA -->
          </div>
          <!-- /CAPA -->
          
					<?php if (isset($displays["rodape-interno"])): ?>
          <!--APOIO-->
          <?php include_partial_from_folder('blocks','global/support', array('displays' => $displays["rodape-interno"])) ?>
          <!--/APOIO-->
          <?php endif; ?>
          
        </div>
        <!-- /CONTEUDO PAGINA -->

      </div>
      <!-- /MIOLO -->
    </div>
    <!-- / CAPA SITE -->

