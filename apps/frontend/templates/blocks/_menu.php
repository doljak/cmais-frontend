<!--Controle-Remoto-->
<script src="http://www.culturabrasil.com.br/js/config.js" type="text/javascript"></script>
<script src="http://www.culturabrasil.com.br/js/jquery-1.3.2.js" type="text/javascript"></script>
<script src="http://www.culturabrasil.com.br/js/jquery.xmldom.min.js" type="text/javascript"></script>
<script src="http://www.culturabrasil.com.br/js/Menu.class.js" type="text/javascript"></script>
<script src="http://www.culturabrasil.com.br/js/User.class.js" type="text/javascript"></script>

<script type="text/javascript">
    var Menu    = new Menu(); 
    var User    = new User(); 

    $(function(){
      $('#logo').click(function(){
        location.href=URL;
      });
      Menu.initHandler();
      User.initHandler();

      var controle = null;

      $('#controle-remoto').click(function(){
        if(controle == null || controle.closed){
          controle = window.open('http://www.culturabrasil.com.br/controle-remoto?start=am','controle','width=300,height=600,scrollbars=no');
        } else {
          controle.focus();
        }
      });
    });
</script>
<!--/CONTROLE REMOTO-->

<!--GUIA TOPO-->
<div id="guia-topo" align="center">
  <!--topo Cmais-->
  <div id="topo-cmais">
  
    <!--Logo Cultura-->
    <a href="http://tvcultura.cmais.com.br" id="logoCultura" title="Portal TV Cultura">
      <img src="/portal/images/logos-cultura/logo-cultura-0.png" width="80" height="77"/>
    </a>  
    <!--Logo Cultura-->
    
    <!--menu parte 2-->
    <div id="menu-portal-2">
      
      <h1>
        <a href="http://cmais.com.br" title="cmais+ O portal de conteúdo da Cultura">cmais+ O portal de conteúdo da Cultura</a>
      </h1>  
      
      <!--menu editorias-->
      <ul class="abas">
       <li class="m-infantil" style="float:right; margin:0 0px 0 0 !important;"><a title="+ Criança" href="http://cmais.com.br/infantil">Infantil</a></li>
       <li class="m-musica" style="float:right"><a title="Música" href="http://cmais.com.br/musica">Música</a></li>
       <li class="m-educacao" style="float:right"><a title="Educação" href="http://cmais.com.br/educacao">Educação</a></li>
       <li class="m-arte-e-cultura " style="float:right"><a title="Arte &amp; Cultura" href="http://cmais.com.br/arte-e-cultura">Arte &amp; Cultura</a></li>
       <li class="m-jornalismo" style="float:right"><a title="Jornalismo" href="http://cmais.com.br/jornalismo">Jornalismo</a></li>
      </ul> 
      <!--menu editorias-->
      
      <!-- Busca Portal -->
      <form class="busca-portal" action="/index.php/cmais/busca" method="post">
        <input type="hidden" name="site_id" id="site_id" value="<?php if((isset($site)) && (($site->type == "Programa Simples") || ($site->type == "Programa"))) echo $site->getId();?>" />
        <input class="ipt-txt" type="text" name="term" id="term" value="<?php if($_REQUEST['term']) echo $_REQUEST['term']; ?>" />
        <?php if($_REQUEST['filter']): ?>
        <input type="hidden" name="filter" id="filter" value="<?php echo $_REQUEST['filter']; ?>" />
        <?php endif; ?>
        <input class="ipt-submit" type="submit" value="BUSCAR" />
      </form>
      <!-- /Busca Portal -->  
         
    </div>
    <!--menu parte 2-->
    
    <!--menu parte 1-->
    <div id="menu-portal-1">
      
      <!--FACEBOOK-->
      
      <!--curtir-->
      <div id="facebook-cultura">
        
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
        </script>
        <!--curtir-->
        
        <div class="fb-like" data-href="http://www.facebook.com/tvcultura" data-send="false" data-layout="button_count" data-width="110" data-show-faces="true"></div>
      
      </div>
      <!--/FACEBOOK-->
      
      <!-- Menu Portal -->
      <ul id="menu-portal">
        <!-- Menu TV -->
        <li class="m-tv"><a href="#" class="filho m_tv_tvcultura" title="TV">PROGRAMAS<span></span></a>
          <div class="menu-aberto padrao tv grid3">
            <ul class="abas-menu abas">
              <li class="neutro">
                <p>escolha um canal</p>
                <span></span>
              </li>
              <li class="tvcultura ativo"><a href="javascript:;" title="TV Cultura" class="m_tv_tvcultura">TV Cultura</a><span class="decoracao"></span></li>
              <li class="univesptv"><a href="javascript:;" title="Univesp TV" class="m_tv_univesptv">Univesp TV</a><span class="decoracao"></span></li>
              <li class="multicultura"><a href="javascript:;" title="multiCULTURA" class="m_tv_multicultura">multiCULTURA</a><span class="decoracao"></span></li>
              <li class="tvrtb"><a href="javascript:;" title="TV R&aacute; Tim Bum" class="m_tv_tvrtb">TV R&aacute; Tim Bum</a><span class="decoracao"></span></li>
            </ul>
            <!-- Abas Conteudo -->
            <ul class="abas-conteudo">
              <li id="tvcultura" class="filho"></li>
              <li id="univesptv" class="filho" style="display:none;"></li>
              <li id="multicultura" class="filho" style="display:none;"></li>
              <li id="tvrtb" class="filho" style="display:none;"></li>
            </ul>
            <!-- /Abas Conteudo -->
          </div>
        </li>
        <!-- /Menu TV -->
        
        <!-- Menu No Ar -->
        <li class="m-noar"><a class="filho m_ar_tvcultura" href="#" title="PROGRAMA&Ccedil;&Atilde;O">GRADE DE PROGRAMA&Ccedil;&Atilde;O<span></span></a>
          <div class="menu-aberto padrao ar grid3">
            <ul class="abas-menu abas">
              <li class="neutro">
                <p>escolha um canal</p>
                <span></span>
              </li>
              <li class="tvcultura"><a href="javascript:;" title="TV Cultura" class="m_ar_tvcultura">TV Cultura</a><span class="decoracao"></span></li>
              <li class="univesptv"><a href="javascript:;" title="Univesp TV" class="m_ar_univesptv">Univesp TV</a><span class="decoracao"></span></li>
              <li class="multicultura"><a href="javascript:;" title="multiCULTURA" class="m_ar_multicultura">multiCULTURA</a><span class="decoracao"></span></li>
              <li class="tvrtb"><a href="javascript:;" title="TV R&aacute; Tim Bum" class="m_ar_tvrtb">TV R&aacute; Tim Bum</a><span class="decoracao"></span></li>
            </ul>
            <!-- Abas Conteudo -->
            <ul class="abas-conteudo">
              <li id="ar-tvcultura" class="filho"></li>
              <li id="ar-univesptv" class="filho" style="display:none;"></li>
              <li id="ar-multicultura" class="filho" style="display:none;"></li>
              <li id="ar-tvrtb" class="filho" style="display:none;"></li>
            </ul>
            <!-- /Abas Conteudo -->
          </div>
        </li>
        <!-- /Menu No Ar -->
        
        <!-- Menu Radio -->
            <li class="m-radio"><a href="#" class="filho m_radio_am" title="RADIO">R&Aacute;DIOS<span></span></a>
              <div class="menu-aberto padrao radio grid3">
                <ul class="abas-menu abas">
                  <li class="neutro">
                    <p>escolha uma esta&ccedil;&atilde;o</p>
                    <span></span>
                  </li>
                  <li class="radio-cb"><a href="javascript:;" title="R&aacute;dio Cultura Brasil" class="m_radio_am">Cultura Brasil</a><span class="decoracao"></span></li>
                  <li class="radio-fm"><a href="javascript:;" title="R&aacute;dio FM" class="m_radio_fm">Cultura FM</a><span class="decoracao"></span></li>
                  <li class="radio-rtb"><a href="#radio-rtb"  title="R&aacute;dio R&aacute; Tim Bum">R&aacute;dio R&aacute; Tim Bum</a><span class="decoracao"></span></li>
                  <li class="radio-cocorico"><a href="#radio-cocorico" title="TV R&aacute; Tim Bum">R&aacute;dio Cocoric&oacute;</a><span class="decoracao"></span></li>
                </ul>
                <!-- Abas Conteudo -->
                <ul class="abas-conteudo">
                  <li id="radio-cb" class="filho"></li>
                  <li id="radio-fm" class="filho" style="display:none;"></li>
                  <li id="radio-rtb" class="filho" style="display: none; ">
                    <a href="http://tvratimbum.cmais.com.br/radio" class="bg-Ratimbum"></a>
                  </li>
                  <li id="radio-cocorico" class="filho" style="display: none; ">
                    <a href="http://www3.tvcultura.com.br/cocorico/radio" class="bg-Cocorico"></a>
                  </li>
                </ul>
                <!-- /Abas Conteudo -->
              </div>
            </li>
            <!-- /Menu Radio -->
        
        <!-- Menu Videos -->
        <li class="m-videos"><a href="http://cmais.com.br/videos" title="VIDEOS">V&Iacute;DEOS</a></li>
        <!-- /Menu Videos -->

        <!-- Menu ao Vivo -->
        <li class="m-aovivo"><a href="http://cmais.com.br/aovivo" title="AO VIVO">AO VIVO</a></li>
        <!-- /Menu ao Vivo -->

      </ul>
      <!--redes sociais-->
      <div id="redesnovo">
        <a href="javascript:;" id="controle-remoto" class="redesB" title="controle-remoto"></a>
        <a href="http://itunes.apple.com/br/app/radio-cultura/id370066053" id="apple" class="redesA" title=""></a>
        <a href="https://plus.google.com/b/107290730774038797358/107290730774038797358" id="google" class="redesA" title=""></a>
        <a href="http://statigr.am/tvcultura" id="instangram" class="redesA" title=""></a>
        <a href="http://facebook.com/tvcultura" id="face" class="redesA" title=""></a>
        <a href="http://twitter.com/tvcultura" id="twit" class="redesA" title=""></a>
        <a href="http://youtube.com/cultura" id="youtube" class="redesA" title=""></a>
        <a href="http://tvcultura.cmais.com.br/feed" id="rss" class="redesA" title=""></a>
      </div>
      <!--redes sociais-->
        
    </div>
    <!--menu parte 1-->

    
      
  </div>
  <!--/topo Cmais-->
</div>
<!--/GUIA TOPO-->