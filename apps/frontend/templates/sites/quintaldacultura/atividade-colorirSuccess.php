<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/"> 
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />

    <?php include_title() ?>
    <?php include_metas() ?>
    <?php include_meta_props() ?>

    <meta name="google-site-verification" content="sPxYSUnxlnoyUdly_hNwIHma64gh9iosgNcOBrZBYdo" />

    <meta property="fb:admins" content="100000889563712"/>
    <meta property="fb:app_id" content="124792594261614"/>

    <link rel="shortcut icon" href="/portal/images/icon/favicon.png" type="image/x-icon" />
    <link rel="image_src" href="/portal/images/logoCMAIS.jpg" />

    <meta name="description" content="cmais+ O portal de conteúdo da Cultura" />
    <meta name="keywords" content="cultura, educacao, infantil, jornalismo" />
    
    <link rel="stylesheet" href="/portal/css/geral.css?nocache=1234" type="text/css" />
    <link rel="stylesheet" href="/portal/quintal/css/geralQuintal.css" type="text/css" />

    <!-- scripts -->
    <script type="text/javascript" src="/portal/js/jquery-ui/js/jquery-1.5.1.min.js"></script>
    <script type="text/javascript" src="/portal/js/jcarousel/lib/jquery.jcarousel.min.js"></script>
    <script type="text/javascript" src="/portal/js/portal.js"></script>

    <script type="text/javascript" src="/portal/quintal/js/jquery.carousel.js"></script>

    <script type="text/javascript">
    //carrocel
    $(function(){
      $('.carrossel').jcarousel({
      wrap: "both"      
      });
    })
    $(document).ready(function() {
        $('#my-carousel-1').carousel();
       ;
    });
    </script>
  </head>
  <script type="text/javascript"> 
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-22770265-1']);
    _gaq.push(['_setDomainName', '.cmais.com.br']);
    _gaq.push(['_trackPageview']);
   
    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
  </script> 
  <body>

  <div class="allWrapper">

  <?php
  // section assets
  if(!$section){
    if(count($assets)<=0){
      $assets = Doctrine_Query::create()
        ->select('a.*')
        ->from('Asset a, SectionAsset sa')
        ->whereIn('sa.section_id', array(94, 103, 106, 104, 105, 107, 127))
        ->andWhere('sa.asset_id = a.id')
        ->orderBy('a.id desc')
        ->execute();
    }
  }else{
    if(isset($pager))
      $assets = $pager->getResults();
    else{
      $assets = Doctrine_Query::create()
        ->select('a.*')
        ->from('Asset a, SectionAsset sa')
        ->Where('sa.section_id = ?', $section->id)
        ->andWhere('sa.asset_id = a.id')
        ->orderBy('a.id desc')
        ->execute();
    }
  }
  if(!isset($asset))
    $asset = $assets[0];

  ?>

  <?php use_helper('I18N', 'Date') ?>
  <?php include_partial_from_folder('blocks', 'global/menu', array('site' => $site, 'mainSite' => $mainSite, 'asset' => $asset, 'section' => $section)) ?>

      <div class="contentWrapper" align="center">


      <div class="content">
        <?php include_partial_from_folder('sites/quintaldacultura', 'global/menu') ?>
        <hr />

        <div class="conteudo">

          <div class="conteudoWrapper">
            <?php include_partial_from_folder('sites/quintaldacultura', 'global/itensBackground') ?>
            <div class="menuVoltar">
              <a href="/quintaldacultura" class="voltar"><span class="ico-voltar"></span><span class="tit">Quintal</span></a>
              <a href="/quintaldacultura/atividades" class="voltarBig"><span class="ico-voltar"></span><span class="tit">Atividades</span></a>
              <p><?php echo $asset->getTitle() ?></p>
            </div>
            <hr />

                            <div class="atividadesBox dois interna">
                              <div class="gameAtividade">
                                <?php $preview = $asset->retriveRelatedAssetsByRelationType('Preview'); ?>
                                <?php if(count($preview) > 0): ?>
                                  <img src="<?php echo $preview[0]->retriveImageUrlByImageUsage('image-6-b') ?>" alt="<?php echo $preview[0]->getTitle() ?>" />
                                <?php endif; ?>
                              </div>

                              <?php $download = $asset->retriveRelatedAssetsByRelationType('Download'); ?>
                              <?php if(count($download) > 0): ?>
                              <div class="boxBaixarImprimir">
                                <a href="http://midia.cmais.com.br/assets/image/original/<?php echo $download[0]->AssetImage->getOriginalFile() ?>" target="_blank">Clique para baixar e imprimir.</a>
                              </div>
                              <?php endif; ?>
                              <span class="palhaca"></span>
                              <span class="palhaco"></span>
                            </div>

                          </div>

                        <div class="allpages">
                          <div class="carrosselWrapper">
                              <div class="categorias">
                                  <a class="mais" href="/quintaldacultura/atividades"><span class="icoBtn"></span><span class="tit">Atividades</span></a>
                                    <p class="categoriaSelecionada"><?php if($section) echo $section->getTitle(); else echo "Todas";?></p>
                                </div>
                                <div class="carrossel">
                                  <ul>
                                    <?php if($assets): ?>
                                      <?php if(count($assets) > 0): ?>
                                        <?php foreach($assets as $k=>$d): ?>
                                          <li>
                                            <a href="<?php echo $d->retriveUrl() ?>"><span class="top"><span class="text1"><?php echo $d->getTitle() ?></span></span></span>
                                            <?php $preview = $d->retriveRelatedAssetsByRelationType('Preview'); ?>
                                            <?php if(count($preview) > 0): ?>
                                              <img src="<?php echo $preview[0]->retriveImageUrlByImageUsage('image-2-b') ?>" alt="<?php echo $d->getTitle() ?>" name="<?php echo $d->getTitle() ?>" style="width: 200px;" />
                                            <?php elseif($d->retriveImageUrlByImageUsage("image-2") != ""): ?>
                                              <img src="<?php echo $d->retriveImageUrlByImageUsage("image-2-b") ?>" alt="<?php echo $d->getTitle() ?>" name="<?php echo $d->getTitle() ?>" style="width: 200px;" />
                                            <?php endif; ?>
                                            <span class="bottom"><span class="text2">colorir</span></span></a>
                                          </li>
                                        <?php endforeach; ?>
                                      <?php endif; ?>
                                    <?php endif; ?>
                                  </ul>
                                </div>
                            </div>
                            <hr />
                            <!--div class="boxDestaque inter">
                              <div class="destaque jg">
                                  <span class="minhoca"></span>

                                    <h2><span class="ico-cross"></span><span class="tit">Fotos</span></h2>
                                    <div class="boxVideos">
                                      <div class="videoThumbs">
                                        <ul>
                      <?php
                      if(!isset($fotos)){
                        $block = Doctrine::getTable('Block')->findOneById(321);
                        if($block)
                          $fotos = $block->retriveDisplays();
                      }
                      ?>
                      <?php if(isset($fotos)): ?>
                        <?php if(count($fotos) > 0): ?>
                          <?php foreach($fotos as $k=>$d): ?>
                            <?php if(($d->retriveImageUrlByImageUsage("image-1") != "")&&($k>0)): ?>
                              <li><a href="<?php echo $d->retriveUrl() ?>"><img src="<?php echo $d->retriveImageUrlByImageUsage("image-1") ?>" alt="<?php echo $d->getTitle() ?>" name="<?php echo $d->getTitle() ?>" style="width:90px" /></a></li>
                            <?php endif; ?>
                          <?php endforeach; ?>
                        <?php endif; ?>
                      <?php endif; ?>
                                        </ul>
                                      </div>

                                      <div class="videoBig">
                    <?php if(isset($fotos[0])): ?>
                      <?php if($fotos[0]->retriveImageUrlByImageUsage("image-3") != ""): ?>
                        <a href="<?php echo $fotos[0]->retriveUrl() ?>"><img src="<?php echo $fotos[0]->retriveImageUrlByImageUsage("image-3") ?>" alt="<?php echo $fotos[0]->getTitle() ?>" style="width:310px" /></a>
                      <?php endif; ?>
                    <?php endif; ?>
                                      </div>

                                    </div>
                                </div>

                <?php
                if(!isset($curiosidades)){
                  $block = Doctrine::getTable('Block')->findOneById(332);
                  if($block)
                    $curiosidades = $block->retriveDisplays();
                }
                ?>
                <?php if(isset($curiosidades[0])): ?>
                <div class="curiosidades">
                  <p><?php echo $curiosidades[0]->getDescription() ?></p>
                  <h3><?php echo $curiosidades[0]->getTitle() ?></h3>
                </div>
                <?php endif; ?>

                <hr />
              </div-->
              
              <!--QUINTAL PERGUNTE FILOMENA-->
              <?php include_partial_from_folder('sites/quintaldacultura', 'global/perg-filomena') ?>
              <!--/QUINTAL PERGUNTE-->

            </div>
            
          </div>

          <hr />

        </div>

      <?php include_partial_from_folder('sites/quintaldacultura', 'global/footer') ?>

    </div>

    <?php include_partial_from_folder('blocks', 'global/footer') ?>

  </div>
  <div id="miolo"></div>
  <div class="box-lateral"></div>
  
<script type='text/javascript'>
var _sf_async_config={};
/** CONFIGURATION START **/
_sf_async_config.uid = 30538;
_sf_async_config.domain = 'cmais.com.br';
_sf_async_config.sections = '<?php echo $site->getTitle()?> - <?php $asset->getTitle()?>';  //CHANGE THIS
_sf_async_config.authors = 'cmais+';    //CHANGE THIS
/** CONFIGURATION END **/
(function(){
  function loadChartbeat() {
    window._sf_endpt=(new Date()).getTime();
    var e = document.createElement('script');
    e.setAttribute('language', 'javascript');
    e.setAttribute('type', 'text/javascript');
    e.setAttribute('src',
       (('https:' == document.location.protocol) ? 'https://a248.e.akamai.net/chartbeat.download.akamai.com/102508/' : 'http://static.chartbeat.com/') +
       'js/chartbeat.js');
    document.body.appendChild(e);
  }
  var oldonload = window.onload;
  window.onload = (typeof window.onload != 'function') ?
     loadChartbeat : function() { oldonload(); loadChartbeat(); };
})();
</script>

  
</body>
</html>