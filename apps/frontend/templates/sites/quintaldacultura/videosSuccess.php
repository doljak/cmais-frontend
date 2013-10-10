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
    $(function(){
      $('.carrossel').jcarousel({
        wrap: "both"
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
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
  </script> 
  <body>

   


  <?php use_helper('I18N', 'Date') ?>
  <?php include_partial_from_folder('blocks', 'global/menu', array('site' => $site, 'mainSite' => $mainSite, 'asset' => $asset, 'section' => $section)) ?>

      <div class="contentWrapper" align="center">


      <div class="content internas">
        <?php include_partial_from_folder('sites/quintaldacultura', 'global/menu') ?>
           <div class="conteudo">

          <div class="conteudoWrapper">
            <?php include_partial_from_folder('sites/quintaldacultura', 'global/itensBackground') ?>
        <ul class="sidebar">
          <li class="sprite-balao-categoria">Escolha por <br/>categoria</li>
          
          
          
         <?php
			$secoes = Doctrine_Query::create()
			  ->select('s.*')
			  ->from('Section s')
			  ->where('s.parent_section_id = ?', 93)
			  ->addWhere('s.is_active = 1')
			  ->orderBy('s.display_order asc')
			  ->execute(); 
         ?>
         
         <?php if(count($secoes) > 0): ?>
	     <?php    foreach ($secoes as $s):?>
	     			<?php if($section->getSlug() == "videos" && $s->getSlug() == "todos"):?>
	     					<li class="ativo"> <a href="/quintaldacultura/diversao" title="Todos">Todos</a></li>
					<?php else :?>
							<li <?php if($section->getSlug() == $s->getSlug() || $s->getSlug() == "videos") echo 'class="ativo" ';?>>
								<a href="/quintaldacultura/videos<?php if($s->getSlug() != "todas") echo "/".$s->getSlug()?>" title="<?php echo $s->getTitle()?>">
								
			                      	<?php if(strlen($s->getTitle()) > 17):?> 
			                      		<?php echo substr($s->getTitle(),0,15) ?>...
								  	<?php else: ?>
								  		<?php echo $s->getTitle() ?>
								  	<?php endif;?>	
								
								</a>
							</li>
					<?php endif; ?>						 
		 <?php    endforeach; ?> 
		 <?php  endif; ?>
          
         
        </ul>
        <div class="lista">
          <ul class="navegacao">
            <li><a href="/quintaldacultura" title="Quintal da Cultura">Quintal da Cultura</a></li>
            <?php if($section->getSlug() != "videos" || @$_GET["search"] != "" ): ?>     
            	<li><span>/</span><a href="/quintaldacultura/videos" title="Vídeos">Vídeos</a></li>
            <?php endif; ?>
          </ul>
          
          <?php if(@$_GET["search"]): ?> 
	          <h2><?php echo @$_GET["search"] ?></h2>
		 <?php else: ?>	          
	          <h2><?php echo $section->getTitle()?></h2>
          <?php endif; ?>
          
          <!-- BUSCA -->
          <form id="busca" method="get">
            <input type="text" name="search" id="search" placeholder="Pesquisar" value="" />
            <button class="sprite-ico-busca"></button>
          </form>
          <!-- BUSCA -->
          
          <ul class="assets">
          	<div id="google_search" style="display:none">
				<script>
				  (function() {
				    var cx = '005232987476052626260:czy5dx_z-m4';
				    var gcse = document.createElement('script');
				    gcse.type = 'text/javascript';
				    gcse.async = true;
				    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
				        '//www.google.com/cse/cse.js?cx=' + cx;
				    var s = document.getElementsByTagName('script')[0];
				    s.parentNode.insertBefore(gcse, s);
				  })();
				</script>
				<gcse:searchresults-only></gcse:searchresults-only>
			</div>
			
			<div id="resultados_busca" style="display:none">			 
	            <?php if(count($pager) > 0): ?>
	              <?php foreach($pager->getResults() as $d): ?>
	                <?php $related = $d->retriveRelatedAssetsByAssetTypeId(6); ?>
	                <li>
	                 	 <?php /*<a href="/quintaldacultura<?php if($section->slug != "videos") echo "/videos/".$section->slug ?>/<?php echo $d->slug ?>" title="<?php echo $d->getTitle() ?>">*/?>
	                 	 <a href="/quintaldacultura/videos/<?php echo $d->slug ?>" title="<?php echo $d->getTitle() ?>">
		                      <?php if(strlen($d->getTitle()) > 19):?> 
		                      	<h3><?php echo substr($d->getTitle(),0,15) ?>...</h3>
							  <?php else: ?>
							  	<h3><?php echo $d->getTitle() ?></h3>
							  <?php	endif;?>
		          			  <img src="http://img.youtube.com/vi/<?php echo $d->AssetVideo->getYoutubeId() ?>/0.jpg" alt="<?php echo $d->getTitle() ?>" alt="<?php echo $d->getTitle() ?>" />
		          			  <p><?php echo $d->getDescription() ?></p>
		          			  <p class="btn">Assistir</p>
	        		  	 </a>
	                </li>
	              <?php endforeach; ?>
	        	<?php endif; ?> 
        	</div>
		 	</ul>
        	<?php include_partial_from_folder('sites/quintaldacultura', 'global/paginator', array('page' => $page, 'pager' => $pager)) ?>
          </div>
        </div>
        <?php include_partial_from_folder('sites/quintaldacultura', 'global/footer') ?>
        </div>
        </div>
        
<script>
	function ExecuteSearch(){
		$("#busca").submit();
	}

	function getURLParameter(name) {
	    return decodeURI(
	        (RegExp(name + '=' + '(.+?)(&|$)').exec(location.search)||[,null])[1]
	    );
	}
	if(getURLParameter("search") == "null" || getURLParameter("search") == ""){
		$('#resultados_busca').show();
	}else{
		$('#resultados_busca').hide();
		$('#google_search').show();
	}
</script>
              

      

    </div>

    <?php include_partial_from_folder('blocks', 'global/footer') ?>

  <div id="miolo"></div>
  <div class="box-lateral"></div>
  

  
</body>
</html>