                <!-- BOX PADRAO Noticia -->
                <?php if(count($displays)>0): ?>
                <div class="box-padrao noticia grid1">
                  
                  <?php if($displays[0]->retriveLabel() != ""): ?>
                  <p class="chapeu<?php if($displays[0]->Asset->Category->slug): ?><?php echo " ".$displays[0]->Asset->Category->getSlug() ?><?php endif; ?>"><?php echo $displays[0]->retriveLabel() ?></p>
                  <?php endif; ?>
                  
                  <?php if($displays[0]->retriveImageUrlByImageUsage("image-3-b") != ""): ?>
                  <a href="<?php echo $displays[0]->retriveUrl() ?>" title="<?php echo $displays[0]->getTitle() ?>">
                    <img src="<?php echo $displays[0]->retriveImageUrlByImageUsage("image-3") ?>" alt="<?php echo $displays[0]->getTitle() ?>" name="<?php echo $displays[0]->getTitle() ?>"<?php if($displays[0]->Asset->AssetType->getSlug() == "video"):?> class="img-video"<?php endif;?> />
                  </a>
                  <?php endif; ?>

                  <a class="titulos" href="<?php echo $displays[0]->retriveUrl() ?>"><?php echo $displays[0]->getTitle() ?></a>
                  <p><?php echo $displays[0]->getDescription() ?></p>

                </div>
                <?php endif; ?>
                <!-- BOX PADRAO Noticia -->