          <?php if(count($siteSections) > 0): ?>
          <!-- menu interna -->
          <ul class="menu-interna grid3">
            <?php foreach($siteSections as $s): ?>
              <?php $subsections = $s->subsections(); ?>
              <?php if(count($subsections) > 0): ?>
                <li class="m-<?php echo $s->getSlug() ?> span"><a href="#" class="abre-menu" title="<?php echo $s->getTitle() ?>"><?php echo $s->getTitle() ?><span></span></a>
                  <div class="submenu-interna toggle-menu" style="display:none; width: auto;">
                    <ul style="display:block;">
                    <?php foreach($subsections as $s): ?>
                      <li><a href="<?php echo $s->retriveUrl()?>"><?php echo $s->getTitle()?></a></li>
                    <?php endforeach; ?>
                    </ul>
                  </div>
                </li>
              <?php else: ?>
                <li class="m-<?php echo $s->getSlug() ?>">
                <?php if($section->getSlug()): ?>
                	<?php if($s->getSlug() == $section->getSlug()): ?>
                	<a class="selected" href="<?php echo $s->retriveUrl()?>" title="<?php echo $s->getTitle() ?>"><?php echo $s->getTitle() ?></a>
                	<?php else: ?>
                	<a href="<?php echo $s->retriveUrl()?>" title="<?php echo $s->getTitle() ?>"><?php echo $s->getTitle() ?></a>
                	<?php endif; ?>
                	<?php if($s->getSlug() == 'chat-ao-vivo'): ?>
									<div class="chat-ao-vivo">AO VIVO</div>
									<?php endif; ?>          	
                <?php else: ?>
                	<a href="<?php echo $s->retriveUrl()?>" title="<?php echo $s->getTitle() ?>"><?php echo $s->getTitle() ?></a>
                <?php endif; ?>
                </li>
              <?php endif; ?>
            <?php endforeach; ?>
          </ul>
          <!-- /menu interna -->
          <?php endif; ?>
          
          <div class="castelo18">
           <img src="/portal/images/capaPrograma/castelo/img-menu-hashtag.png" alt="#castelo18anos">
           <a href="https://twitter.com/#!/search/realtime/castelo18anos" target="_blank"><img src="/portal/images/capaPrograma/castelo/btn-menu-twitter.png" alt="Twitter"></a>
           <a href="http://statigr.am/viewer.php#/tag/castelo18anos/" target="_blank"><img src="/portal/images/capaPrograma/castelo/btn-menu-instagram.png" alt="Instangram"></a>

         </div>