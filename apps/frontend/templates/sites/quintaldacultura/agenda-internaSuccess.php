<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/">
  <head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <?php include_title()    ?>
    <?php include_metas()    ?>
    <?php include_meta_props()    ?>

    <meta name="google-site-verification" content="sPxYSUnxlnoyUdly_hNwIHma64gh9iosgNcOBrZBYdo" />
    <meta property="fb:admins" content="100000889563712"/>
    <meta property="fb:app_id" content="124792594261614"/>
    <link rel="shortcut icon" href="http://cmais.com.br/portal/images/icon/favicon.png" type="image/x-icon" />
    <link rel="image_src" href="http://cmais.com.br/portal/images/logoCMAIS.jpg" />
    <meta name="description" content="cmais+ O portal de conteúdo da Cultura" />
    <meta name="keywords" content="cultura, educacao, infantil, jornalismo" />
    <link rel="stylesheet" href="http://cmais.com.br/portal/css/geral.css?nocache=1234" type="text/css" />
    <link rel="stylesheet" href="/portal/quintal/css/geralQuintal.css" type="text/css" />
    <!-- scripts -->
    <script type="text/javascript" src="http://cmais.com.br/portal/js/jquery-ui/js/jquery-1.5.1.min.js"></script>
    <script type="text/javascript" src="http://cmais.com.br/portal/js/jcarousel/lib/jquery.jcarousel.min.js"></script>
    <script type="text/javascript" src="http://cmais.com.br/portal/js/portal.js"></script>
    <script type="text/javascript">
      //carrocel
      $(function() {
        $('.carrossel').jcarousel({
          wrap : "both"
        });
      })
    </script>
  </head>
  <script type="text/javascript">
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-22770265-1']);
    _gaq.push(['_setDomainName', '.cmais.com.br']);
    _gaq.push(['_trackPageview']);
    (function() {
      var ga = document.createElement('script');
      ga.type = 'text/javascript';
      ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0];
      s.parentNode.insertBefore(ga, s);
    })();

  </script>
  
  <script type='text/javascript'>
    var googletag = googletag || {};
    googletag.cmd = googletag.cmd || [];
    (function() {
    var gads = document.createElement('script');
    gads.async = true;
    gads.type = 'text/javascript';
    var useSSL = 'https:' == document.location.protocol;
    gads.src = (useSSL ? 'https:' : 'http:') + 
    '//www.googletagservices.com/tag/js/gpt.js';
    var node = document.getElementsByTagName('script')[0];
    node.parentNode.insertBefore(gads, node);
    })();
    </script>
    
    <script type='text/javascript'>
    googletag.cmd.push(function() {
    googletag.defineSlot('/4079539/maiscrianca', [300, 250], 'div-gpt-ad-1380814177723-0').addService(googletag.pubads());
    googletag.pubads().enableSingleRequest();
    googletag.enableServices();
    });
    </script>
  <body>
  	
  	
  	
<?php
  $assets = Doctrine_Query::create()
	  ->select('a.*')
	  ->from('Asset a, SectionAsset sa')
	  ->whereIn('sa.section_id', array(119)) //Para os pais
	  ->andWhere('sa.asset_id = a.id')
	  ->andWhere('a.description != ""')
	  ->orderBy('a.id desc')
	  ->limit(3)
	  ->execute();
?>   	
  	
  	
  	
  	
    <?php use_helper('I18N', 'Date')    ?>
    <?php include_partial_from_folder('blocks', 'global/menu', array('site' => $site, 'mainSite' => $mainSite, 'asset' => $asset, 'section' => $section))    ?>

    <div class="contentWrapper" align="center">
      <div class="content internas">
        <?php include_partial_from_folder('sites/quintaldacultura', 'global/menu')        ?>
        <div class="conteudo" id="agenda">
          <div class="conteudoWrapper">
            <?php include_partial_from_folder('sites/quintaldacultura', 'global/itensBackground')            ?>

            <div class="col-esq">
              <!-- menu-->
              <div class="menu-quintal">
                <ul class="navegacao">
                  <li><a href="/quintaldacultura" title="Quintal da Cultura">Quintal da Cultura</a></li>
                  <li><span>/</span><p><a href="/quintaldacultura/agenda" title="Quintal da Cultura">Agenda</a></p></li>
                </ul>
                <h2><?php echo $asset->getTitle() ?></h2>
                <small><?php echo $asset->getDescription() ?></small>
		          
		          <form id="busca" method="get" action="/quintaldacultura/agenda">
		            <input type="text" name="search" id="search" placeholder="Pesquisar"/>
		            <button class="sprite-ico-busca"></button>
		          </form>
		                
              </div>
              <!-- /menu-->
              <div class="box-content">
              	<p><?php echo html_entity_decode($asset->AssetContent->render()) ?></p>
              </div>
             
            </div>
            <div class="col-dir">
              <div class="leiamais">Para os Pais</div>
              
              
   				<?php if($assets): ?>
	                <?php if(count($assets) > 0): ?>
	                  <?php foreach($assets as $k=>$d): ?>
			              <div class="box-content">
			              	<a href="<?php echo $d->retriveUrl() ?>" title="<?php echo $d->getTitle() ?>">
			                      <?php if(strlen($d->getTitle()) > 22):?> 
			                      	<h2><?php echo substr($d->getTitle(),0,20) ?>...</h2>
								  <?php else: ?>
								  	<h2><?php echo $d->getTitle() ?></h2>
								  <?php	endif;?>				                
				                
				                	<?php if($d->retriveImageUrlByImageUsage("image-4-b")): ?>
				                		<img src="<?php echo $d->retriveImageUrlByImageUsage("image-4-b") ?>" alt="<?php echo $d->getTitle() ?>"/>
				                	<?php endif;?>
				                <p><?php echo $d->getDescription() ?></p>
			              	</a>
			              </div>	                  	
	                  <?php endforeach; ?>
	                <?php endif; ?>
	              <?php endif; ?>    
              
              <!-- maiscrianca -->
              <div id='div-gpt-ad-1380814177723-0' style='width:300px; height:250px;'>
              <script type='text/javascript'>
              googletag.cmd.push(function() { googletag.display('div-gpt-ad-1380814177723-0'); });
              </script>
              </div>
            </div>
          </div>
          <?php include_partial_from_folder('sites/quintaldacultura', 'global/footer')          ?>
        </div>
      </div>
    </div>
    <?php include_partial_from_folder('blocks', 'global/footer')    ?>

    <div id="miolo"></div>
    <div class="box-lateral"></div>
  </body>
</html>