<?php
/*
$apresentador = Doctrine_Query::create()
  ->select('a.title')
  ->from('Asset a, RelatedAsset ra')
  ->where('ra.asset_id = a.id')
  ->andWhere("ra.type = 'Apresentador'")
  ->andWhere('a.site_id = ?', (int)$site->id)
  ->andWhere('a.asset_type_id = 20')
  ->groupBy('a.title')
  ->orderBy('a.title asc')
  ->limit(50)
  ->execute();
 * 
 */
?>

<link rel="stylesheet" href="/portal/css/tvcultura/sites/<?php echo $site->getSlug() ?>.css" type="text/css" />
<script type="text/javascript" src="/js/jquery-ui-1.8.7/js/jquery-ui-1.8.7.custom.min.js"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/i18n/jquery-ui-i18n.min.js" type="text/javascript"></script>
<link type="text/css" href="/portal/js/jquery-ui/css/ui-lightness/jquery-ui-1.8.11.custom.css" rel="stylesheet" />	


<?php use_helper('I18N', 'Date') ?>
<?php include_partial_from_folder('blocks', 'global/menu', array('site' => $site, 'mainSite' => $mainSite, 'section' => $section)) ?>

    <!-- CAPA SITE -->
	<div class="bg-metropolis">
    <div id="capa-site">
    	
      <!-- BREAKING NEWS -->
      <?php if(isset($displays["alerta"])) include_partial_from_folder('blocks','global/breakingnews', array('displays' => $displays["alerta"])) ?>
      <!-- /BREAKING NEWS -->

      <!-- BARRA SITE -->
      <div id="barra-site">
	  	<div class="topo-programa">
	  	  <?php if(isset($program) && $program->id > 0): ?>
		  <h2>
		    <a href="<?php echo $program->retriveUrl() ?>" title="<?php echo $program->getTitle() ?>">
		      <img title="<?php echo $program->getTitle() ?>" alt="<?php echo $program->getTitle() ?>" src="/uploads/programs/<?php echo $program->getImageThumb() ?>">
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
		<div class="box-topo grid3">
          <?php if(count($siteSections) > 0): ?>
          <ul class="menu">
            <?php foreach($siteSections as $s): ?>
				<li><a href="<?php echo $s->retriveUrl() ?>" title="<?php echo $s->getTitle() ?>" <?php if($s->getId() == $section->getId()):?>class="ativo"<?php endif; ?>><span><?php echo $s->getTitle() ?></span></a></li>
			<?php endforeach; ?>
          </ul>
          <?php endif; ?>
		</div>
		<!-- /box-topo -->
	</div>
      <!-- /BARRA SITE -->
      <!-- MIOLO -->
      <div id="miolo">
      	
        <!-- BOX LATERAL -->
        <?php include_partial_from_folder('blocks','global/shortcuts') ?>
        <!-- BOX LATERAL -->
      	
        <!-- CONTEUDO PAGINA -->
        <div id="conteudo-pagina exceptionn">
          <!-- CAPA -->
          <div class="capa grid3 exceptionn">
          	<div class="tudo-metropolis">
          		<span class="bordaTopRV"></span>
          		<div class="centroRV excp">
          			<div class="video">
          				<div class="cabecalho">
          					<h2><?php echo $section->getTitle() ?></h2>
          				</div>
          				<div class="busca">
          				  <form class="chave" name="busca" id="busca" method="post">
          				  	<input type="hidden" name="ordem" id="ordem" value="" />
          				  	<input type="hidden" name="sequencia" id="sequencia" value="" />
          				    <div class="palavra-chave">
          				      <p>Buscar palavra-chave</p>
          				      <input class="campo" type="text" name="palavra" id="palavra" value="<?php if(isset($_REQUEST['palavra'])) echo $_REQUEST['palavra'] ?>" />
          				      <a href="javascript: document.busca.submit()" class="confirmar"><span>confirmar</span></a>
          				    </div>
                            <span class="divisoria"></span>
                            <div class="filtro">
                              <!--div class="entrevistas">
                                <p>Filtrar entrevistas</p>
                                <label><input type="checkbox" name="checkbox" />na &iacute;ntegra</label>
                                <label><input type="checkbox" name="checkbox" />com transcri&ccedil;&atilde;o</label>
                                <label><input type="checkbox" name="checkbox" />internacional</label>
                              </div-->
								<!--div class="formWrapper">
	                              <label><input type="radio" name="filtrar_por" value="tema" />Filtrar por tema</label>
	                              <select name="tema" id="tema">
	                                <option value="" selected="selected"> </option>
	                                <option value="Ciências">Ciências</option>
	                                <option value="Cultura">Cultura</option>
	                                <option value="Economia">Economia</option>
	                                <option value="Esporte">Esporte</option>
	                                <option value="Política">Política</option>
	                              </select>
								</div>
								<div class="formWrapper">
	                              <label><input type="radio" name="filtrar_por" value="apresentador" />Filtrar por apresentador</label>
	                              <select name="apresentador" id="apresentador">
	                                <option value="" selected="selected"> </option>
	                                <?php foreach($apresentador as $a): ?>
	                                <option value="<?php echo $a->getTitle() ?>"><?php echo $a->getTitle() ?></option>
	                                <?php endforeach; ?>
	                              </select>
								</div-->
								<div class="formWrapper">
									<script type="text/javascript">
									  $(function(){ //onready
									    // Datepicker
									    $.datepicker.setDefaults($.datepicker.regional['pt-BR']);
									    $('.datepicker').datepicker({
									      dateFormat: 'yy-mm-dd',
									      changeYear: true,
									      yearRange: '1987:c'
									    });
									  });
									</script>
	                              <label><input type="radio" name="filtrar_por" value="periodo" />Filtrar por per&iacute;odo</label>
	                              <p class="de">de</p>
	                              <input type="text" name="de" id="de" class="datepicker" value="<?php if(isset($_REQUEST['de'])) echo $_REQUEST['de'] ?>" />
	                              <p class="ate">at&eacute;</p>
	                              <input type="text" name="ate" id="ate" class="datepicker" value="<?php if(isset($_REQUEST['ate'])) echo $_REQUEST['ate'] ?>" />
	                              <a href="javascript: document.busca.submit()" class="confirmar"><span>confirmar</span></a>
								</div>
                            </div>
                            <span class="divisoria"></span>
                            <div class="organizacao">
                              <p>Organizar por</p>
                              <button onclick="$('#busca #ordem').attr('value','cronologica'); $('#busca #sequencia').attr('value','<?php if($_REQUEST['sequencia'] == 'asc'): ?>desc<?php else: ?>asc<?php endif; ?>'); $('#busca').submit()" <?php if($_REQUEST['ordem'] == 'cronologica'): ?>onmouseover="$(this).children('span').html('inverter seleção')" onmouseout="$(this).children('span').html('ordem cronológica')" class="cronologica ativo"<?php else: ?> class="cronologica"<?php endif; ?>><span>ordem cronol&oacute;gica</span></button>
                              <button onclick="$('#busca #ordem').attr('value','alfabetica'); $('#busca #sequencia').attr('value','<?php if($_REQUEST['sequencia'] == 'asc'): ?>desc<?php else: ?>asc<?php endif; ?>'); $('#busca').submit()" <?php if($_REQUEST['ordem'] == 'alfabetica'): ?>onmouseover="$(this).children('span').html('inverter seleção')" onmouseout="$(this).children('span').html('ordem alfabética')" class="alfabetica ativo"<?php else: ?> class="alfabetica"<?php endif; ?>><span>ordem alfab&eacute;tica</span></button>
                            </div>
          				  </form>
          				</div>
          			</div>
          		</div>
          		<span class="bordaBottomRV"></span>
          		<div class="listaVideos">
          			
                  <?php if(count($pager) > 0): ?> 
                    <?php foreach($pager->getResults() as $d): ?>
                      <?php	
                        $videos = $d->retriveRelatedAssetsByAssetTypeId(6);
                        //$guest = $d->retriveRelatedAssetsByRelationType('entrevistado');
                      ?>
          			<div class="boxLista-video">
          				<span class="topo"></span>
          				<div class="centro">
          					<div class="centrowrapper">
	          					<span class="faixa"></span>
	          					<?php if(count($videos) > 0): ?>
		                  	<?php
		                  		$title = $d->getTitle();
		                  		if (preg_match("/^[0-9]{8}$/",trim($d->getTitle())))
		                  		{
		                  			$year = substr($d->getTitle(),0,4);
		                  			$month = substr($d->getTitle(),4,2);
		                  			$day = substr($d->getTitle(),6,2);
														$title = "Programa exibido em " . $day . "/" . $month . "/" . $year;
													}
													elseif (preg_match("/^[0-9]{8}(_|-){1}(.)*$/",trim($d->getTitle())))
		                  		{
		                  			$year = substr($d->getTitle(),0,4);
		                  			$month = substr($d->getTitle(),4,2);
		                  			$day = substr($d->getTitle(),6,2);
														$title = "Programa exibido em " . $day . "/" . $month . "/" . $year;
													}
													elseif (preg_match("/^[0-9-]+$/",trim($d->getTitle())))
													{
														$aux = explode('-', trim($d->getTitle()));
														if (count($aux) >= 3) { 
															$title = "Programa exibido em " . $aux[2] . "/" . $aux[1] . "/" . $aux[0];
														}
													}
		                  	?>
	          						
			                    <a class="imgTumb" href="<?php echo $d->retriveUrl() ?>" title="<?php echo $title ?>">
			                      <img src="http://img.youtube.com/vi/<?php echo $videos[0]->AssetVideo->getYoutubeId() ?>/0.jpg" alt="<?php echo $title ?>" name="<?php echo $title ?>" />
			                    </a>
                                <?php else: ?>
			                    <a class="imgTumb" href="<?php echo $d->retriveUrl() ?>" title="<?php echo $title ?>">
			                      <img src="/portal/images/capaPrograma/metropolis/img-padrao.png" alt="<?php echo $title ?>" name="<?php echo $title ?>" />
			                    </a>
			                    <?php endif; ?>
	          					<span class="faixa"></span>
	          					<h4><a href="<?php echo $d->retriveUrl() ?>"><?php echo $title ?></a></h4>
	          					<p>
	          						<a href="<?php echo $d->retriveUrl() ?>">
	          						<?php if ($d->getDescription()): ?>
	          							<?php echo $d->getDescription() ?>
	          						<?php else: ?>
	          							<?php $blocos = $d->retriveRelatedAssetsByAssetTypeId(6); ?>
                          <?php if(isset($blocos)): ?>
                            <?php if(count($blocos) > 0): ?>
                            	<?php foreach($blocos as $k=>$d): ?>
                              	<?php echo trim($d->getTitle()) ?><?php if($k < count($blocos)-1) echo ", "; else echo "."; ?>
                              <?php endforeach; ?>
		                  			<?php endif; ?>
		                  		<?php endif; ?>
	          						<?php endif; ?>
	          						</a>
	          					</p>
	          					
	          					<a class="mais" href="<?php echo $d->retriveUrl() ?>"><span>+</span></a>
	          				</div>
	          			</div>	
          				<span class="bottom"></span>
          			</div>
                    <?php endforeach; ?>
                  <?php else: ?>
                  	<p style="float:left">Nenhum resultado encontrado!</p>
                  <?php endif; ?>
                  
                  
                  
              <?php if(isset($pager)): ?>
                <?php if($pager->haveToPaginate()): ?>
          	  <!-- PAGINACAO -->
          	  <div class="paginacao grid3">
          	    <div class="centraliza">
          	      <a href="javascript: goToPage(<?php echo $pager->getPreviousPage() ?>);" class="btn-ante"></a>
          	      <a class="btn anterior" href="javascript: goToPage(<?php echo $pager->getPreviousPage() ?>);">Anterior</a>
          	      <ul>
                    <?php foreach ($pager->getLinks() as $page): ?>
                      <?php if ($page == $pager->getPage()): ?>
                    <li><a href="javascript: goToPage(<?php echo $page ?>);" class="ativo"><?php echo $page ?></a></li>
                      <?php else: ?>
                    <li><a href="javascript: goToPage(<?php echo $page ?>);"><?php echo $page ?></a></li>
                      <?php endif; ?>
                    <?php endforeach; ?>
          	      </ul>
          	      <a class="btn proxima" href="javascript: goToPage(<?php echo $pager->getNextPage() ?>);">Pr&oacute;xima</a>
          	      <a href="javascript: goToPage(<?php echo $pager->getNextPage() ?>);" class="btn-prox"></a>
          	    </div>
          	  </div>
              <form id="page_form" action="" method="post">
              	<input type="hidden" name="return_url" value="<?php echo $url?>" />
              	<input type="hidden" name="page" id="page" value="" />
              	<input type="hidden" name="palavra" id="palavra" value="<?php echo $palavra ?>" />
              	<input type="hidden" name="ordem" id="ordem" value="<?php echo $ordem ?>" />
              	<input type="hidden" name="sequencia" id="sequencia" value="<?php echo $sequencia ?>" />
              	<input type="hidden" name="ate" id="ate" value="<?php echo $ate ?>" />
              </form>
              <script>
              	function goToPage(i){
                	$("#page").val(i);
                	$("#page_form").submit();
              	}
              </script>
          	  
		      <!-- PAGINACAO -->
		        <?php endif; ?>
		      <?php endif; ?>
                  
                  
                  
                  
          		</div>
          	</div>
          </div>
           <!-- BOX PUBLICIDADE 2 -->
		  <div class="box-publicidade pub-grd grid3">
		    <!-- programas-assets-728x90 -->
		    <script type='text/javascript'>
		      GA_googleFillSlot("cmais-assets-728x90");
		    </script>
		  </div>
		  <!-- / BOX PUBLICIDADE 2 -->
        </div>
        <!-- /CONTEUDO PAGINA -->

      </div>
      <!-- /MIOLO -->

    </div>
    </div>
    <!-- / CAPA SITE -->
    

