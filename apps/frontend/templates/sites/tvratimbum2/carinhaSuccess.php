<?php
  $assets = Doctrine_Query::create()
    ->select('a.*')
    ->from('Asset a, SectionAsset sa')
    ->where('sa.asset_id = a.id')
    ->andWhereIn('sa.section_id',  array(1058))
    ->orderBy('a.id desc')
    ->execute();
  
  if($assets){
    $sites = array();
    foreach($assets as $a){
      if(!in_array($a->Site, $sites))
        $sites[] = $a->Site;
    }
  }

  if(!isset($displays["voce-sabia"])){
    $block = Doctrine::getTable('Block')->findOneById(587);
    if($block)
      $vocesabia = $block->retriveDisplays();
  }
?>

<?php use_helper('I18N', 'Date') ?>
<?php include_partial_from_folder('blocks', 'global/menu', array('site' => $site, 'mainSite' => $mainSite, 'asset' => $asset, 'section' => $section)) ?>
<link href="http://cmais.com.br/portal/tvratimbum/css/geral.css" type="text/css" rel="stylesheet">
<link href="http://cmais.com.br/portal/tvratimbum/css/jquery.jcarousel.css" rel="stylesheet" type="text/css" />
<script src="http://cmais.com.br/portal/tvratimbum/js/jquery-1.4.4.min.js" type="text/javascript"></script>
<script src="http://cmais.com.br/portal/tvratimbum/js/jquery-ui-1.8.9.min.js" type="text/javascript"></script>
<script src="http://cmais.com.br/portal/tvratimbum/js/jquery.jcarousel.pack.js" type="text/javascript"></script>
<script src="http://cmais.com.br/portal/tvratimbum/js/jPlayer/js/jquery.jplayer.min.js" type="text/javascript"></script>
<script type="text/javascript">
  //carrocel
  $(function(){
    $('.carrossel').jcarousel({
      wrap: "both"
    });
  })
  
  function setSection(i){
    $('#section_id').val(i);
    $('#filter').submit();
  }
</script>

<div id="bodyWrapper">

  <div class="conteudoWrapper" align="center">
    
    <?php include_partial_from_folder('tvratimbum','global/top') ?>
    
    <div class="conteudo internas">
      <div class="colunaMaior">
        <div class="trilha">
          <p><a href="/">TV Rá Tim Bum</a></p><span>&gt;&gt;</span><a href="/baixar">Baixar</a><span>&gt;&gt;</span><a href="<?php echo $asset->retriveUrl()?>"><?php echo $asset->getTitle()?></a>
        </div>
        <div id="box-baixar-papel">
          <div class="wrapper baixar cartao">
            <div class="topo-esq"></div>
            <div class="topo">
              <a href="/baixar" class="enunciado">Baixar</a>
            </div>
            <div class="personagem-escolhido">
			  <div class="logo-destaque">
                <span></span>
                <a href=""><img alt="<?php echo $asset->getTitle()?>" src="<?php echo $asset->retriveImageUrlByImageUsage("image-1-b") ?>" /></a>
              </div>
              <p><?php echo $asset->getTitle()?></p>
            </div>
            <div class="info">
              <div align="center" class="imagem-download">

                <?php $download = $asset->retriveRelatedAssetsByRelationType('Download'); ?>
                <?php if(count($download) > 0): ?>
                  <?php foreach($download as $k=>$d): ?>
                    <a href="http://midia.cmais.com.br/assets/image/original/<?php echo $d->AssetImage->getOriginalFile() ?>" target="_blank">
                      <img alt="<?php echo $d->getTitle()?>" src="http://midia.cmais.com.br/assets/image/original/<?php echo $d->AssetImage->getOriginalFile() ?>" />
                    </a>
                  <?php endforeach; ?>
                <?php endif; ?>
                
                <span class="picote"></span>
              </div>
            </div>
            <!-- div class="btn-barra">
              <span class="pontaBarra"></span>
              <a href="http://midia.cmais.com.br/assets/image/original/<?php echo $d->AssetImage->getOriginalFile() ?>" target="_blank">Salvar no computador</a>
              <span class="caudaBarra"></span>
              <span class="pontaBarra"></span>
              <a href="http://midia.cmais.com.br/assets/image/original/<?php echo $d->AssetImage->getOriginalFile() ?>" target="_blank">imprimir</a>
              <span class="caudaBarra"></span>
              <?php /*
              <span class="pontaBarra"></span>
              <a href="#">enviar para um amigo</a>
              <span class="caudaBarra"></span>
              */ ?>
            </div -->
            <span class="picote"></span>
          </div>
        </div>
      </div>
      <div class="coluna">
        <div class="galeriaVideos galeriaGenericaBaixar">
          <div class="enunciado">
            <h2><span class="mais">+</span>Carinhas</h2>
          </div>
          <span class="alcaA"></span>
          <span class="alcaB"></span>
          <div class="listaGaleria">
			<div class="wrappperlistaGaleria">
            <ul>
              <?php foreach($assets as $a): ?>
              <li>
                <a class="aImg" href="<?php echo $a->retriveUrl()?>">
                  <img src="<?php echo $a->retriveImageUrlByImageUsage("image-1-b") ?>" alt="<?php echo $a->getTitle()?>" />
                </a>
                <a class="aTxt" href="<?php echo $a->retriveUrl()?>">
                  <span class="nomeRlacionado"><?php echo $a->getTitle()?></span>
                </a>
              </li>
              <?php endforeach; ?>
            </ul>
          </div>
		 </div>	
        </div>
      </div>
    </div>

    <?php include_partial_from_folder('tvratimbum','global/footer') ?>
    <hr />
  </div>
</div>


