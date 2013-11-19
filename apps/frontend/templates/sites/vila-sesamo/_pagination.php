<?php
echo count($pager)/9 . " >>>>>>>>>>>>>>"
?>
<?php if(intval($pager2) <= intval(count($pager)/9)):?>
<nav id="page_nav">
  <div class="container-ajax-loader">
    <img id="ajax-loader" src="http://cmais.com.br/portal/images/capaPrograma/vilasesamo2/sprites/ajax-loader.gif" alt="" style="display:none;">
  </div>
  <?php
  if($section == "cuidadores"):
    $icone = "icone-carregar-ve-grande";
  else:
    $icone = "icone-carregar-br-grande";
  endif;    
  ?>
  <a href="javascript:vilaSesamoGetContents();" class="mais">Carregar mais<i class="icones-sprite-interna <?php echo $icone ?>"></i></a>
</nav>
<?php endif; ?>
<script src="http://cmais.com.br/portal/js/isotope/jquery.isotope.min.js"></script>
<script src="http://cmais.com.br/portal/js/vilasesamo2/internas-isotope.js"></script>
<script>
  actualPage = 0;
  contentPage = 1;
  quantPage = <?php echo intval($pager2)?>;
  $('.mais').click(function(){
    actualPage+1;
  });
  function vilaSesamoGetContents() {
    $.ajax({
      url: "<?php echo url_for("@homepage") ?>ajax/vilasesamogetcontents",
      data: "page="+contentPage+"&items=9&site=<?php echo $site->getSlug(); ?>&siteId=<?php echo (int)$site->id ?>&sectionId=<?php echo $section->getId(); ?>&section=<?php echo $section->getSlug(); ?>",
      beforeSend: function(){
          $('#page-nav a.mais').hide();
          $('#page-nav #ajax-loader').show();
        },
      success: function(data){
        contentPage+1;
        $('#page-nav #ajax-loader').hide();
        if (data != "") {
          console.log(contentPage);
          var newEls = $(data).appendTo('#container');
          $("#container").isotope().isotope('appended',newEls);
          if(contentPage++ >= quantPage){
            $('#page_nav').hide();
          }
        }else{
          $('#page_nav').hide();
          //$('#page_nav').html('<span class="mais">fim da listagem.</span>')
          //console.log("fim da listagem");
        }
      }
    });
  }
  $(document).ready(function(){
   vilaSesamoGetContents();
  });
</script>