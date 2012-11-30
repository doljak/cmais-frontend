     <?php
        $displays = array();
        $blocks = Doctrine_Query::create()
         ->select('b.*')
          ->from('Block b, Section s')
          ->where('b.section_id = s.id')
          ->andWhere('s.slug = ?', 'home')
          ->andWhere('b.slug = ?', 'descricao') 
          ->andWhere('s.site_id = ?', $site->id)
          ->execute();
      
        if(count($blocks) > 0){
          $displays["descricao"] = $blocks[0]->retriveDisplays();
        }
      ?>
      <div id="topo-central">
        <div class="row-fluid" style="position: relative;">
          <a href="http://fpa.com.br/central-de-relacionamento" class="pull-left logo-central" title="Fundação Padre Anchieta - Central de Relacionamento">
            <img src="/portal/images/capaPrograma/central-de-relacionamento/logo-centralderelacionamento.png" border="0" />
          </a>
          <!--DESCRIÇÃO-->
          <div class="desc-site">
          	<?php if(isset($displays['descricao'])):?>
        <?php if(count($displays['descricao']) > 0): ?>
          <?php foreach($displays['descricao'] as $k=>$d): ?>
          	            <p><?php echo $d->getDescription() ?></p>
          <?php endforeach; ?>
        <?php endif; ?>
      <?php endif; ?>
          </div>
          <!--/DESCRIÇÃO-->
        </div>
        <?php
          if(isset($asset))
            include_partial_from_folder('sites/central-de-relacionamento','global/sections-menu', array('siteSections' => $siteSections, 'section' => $section, 'asset' => $asset));
          else
            include_partial_from_folder('sites/central-de-relacionamento','global/sections-menu', array('siteSections' => $siteSections, 'section' => $section));
        ?>  
      </div>  
      <!-- /TOPO CENTRAL RELACIONAMENTO-->  
