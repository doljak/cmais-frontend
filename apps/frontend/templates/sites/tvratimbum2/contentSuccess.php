<?php
  $assets = Doctrine_Query::create()
    ->select('a.*')
    ->from('Asset a, SectionAsset sa')
    ->where('sa.asset_id = a.id')
    ->andWhereIn('sa.section_id',  array(12, 28, 27, 26, 29, 25))
    ->orderBy('rand()')
    ->execute();
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
    startclock();
  })
  
  function setSection(i){
    $('#section_id').val(i);
    $('#filter').submit();
  }
  
  var timeID=null;
  var timerRunning=false;
  function stopclock (){
    if(timerRunning)
      clearTimeout(timerID);
    timerRunning=false;
  }
  function startclock(){
    stopclock();
    showtime();
  }
  function showtime() {
    var now=new Date();
    var hours= now.getHours();
    var minutes= now.getMinutes();
    var timeValue=""+ hours;
    timeValue += ((minutes<10) ? ":0" : ":") + minutes
    document.clock.face.value= timeValue
    timerID = setTimeout("showtime()",1000);
    timerRunning = true;
  }
</script>

<div id="bodyWrapper">

  <div class="conteudoWrapper" align="center">
    
    <?php include_partial_from_folder('tvratimbum','global/top') ?>
    
    <div class="conteudo internas">
      <div class="colunaMaior exceptionCM">
        <div class="trilha">
          <p><a href="/">TV Rá Tim Bum</a></p><span>&gt;&gt;</span><a href="/jogos">Jogos</a><span>&gt;&gt;</span><a href="<?php echo $asset->retriveUrl()?>"><?php echo $asset->getTitle()?></a>
        </div>
        <div id="box-jogos-interna">
          <div class="wrapper">
            <div class="topo-esq"></div>
            <div class="topo">
              <a href="/jogos" class="enunciado">Jogos</a>
            </div>
            <div class="personagem-escolhido">
              <div class="logo-destaque">
                <span></span>
                <img alt="<?php echo $asset->getTitle()?>" src="<?php echo $asset->retriveImageUrlByImageUsage("image-1-b") ?>">
              </div>
              <p><?php echo $asset->getTitle()?></p>
            </div>
            <div class="info">
              <div align="center" class="jogo">
                <?php echo html_entity_decode($asset->AssetContent->getContent()) ?>
              </div>
              <p><?php echo $asset->getDescription()?></p>
            </div>
            <hr />
            <?php /*  
            <div class="btn-barra">
              <span class="pontaBarra"></span>
              <a href="#">Enviar para um amigo</a>
              <span class="caudaBarra"></span>
            </div>
            <span class="picote"></span>
            */ ?>
          </div>
          <hr />
          <div class="saibaMais">
            <span class="alcaA"></span>
            <span class="alcaB"></span>
            <h2><span class="mais">+</span>Jogos</h2>
            <div class="carrossel jcarousel-container jcarousel-container-horizontal" style="display: block;">
              <div class="jcarousel-prev jcarousel-prev-horizontal" style="display: block;" disabled="false"></div><div class="jcarousel-next jcarousel-next-horizontal" style="display: block;" disabled="false"></div><div class="jcarousel-clip jcarousel-clip-horizontal">
                <ul class="jcarousel-list jcarousel-list-horizontal" style="width: 1980px; left: 0px;">
                  <?php foreach($assets as $a): ?>
                  <li class="jcarousel-item jcarousel-item-horizontal jcarousel-item-1 jcarousel-item-1-horizontal" jcarouselindex="1">
                    <a href="<?php echo $a->retriveUrl()?>" class="aImg">
                      <img alt="<?php echo $a->getTitle()?>" src="<?php echo $a->retriveImageUrlByImageUsage("image-3-b") ?>">
                    </a>
                    <a href="<?php echo $a->retriveUrl()?>" class="aTxt">
                      <span class="nomeRlacionado"><?php echo $a->getTitle()?></span>
                      <span class="nomeItem"><?php echo $a->getDescription()?></span>
                    </a>
                  </li>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
            <hr />
            <span class="picote"></span>
          </div>
        </div>
      </div>
    </div>

    <?php include_partial_from_folder('tvratimbum','global/footer') ?>
    <hr />
  </div>
</div>



