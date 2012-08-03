<?php

/**
 * _section actions.
 *
 * @package    astolfo
 * @subpackage _section
 * @author     Emerson Estrella
 * @version    SVN: $Id: actions.class.php 23810 2009-11-12 11:07:44Z Kris.Wallsmith $
 */
class _sectionActions extends sfActions
{
  /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request){
    gc_enable();
    if($request->getParameter('object')){
      
      if($request->getParameter('busca'))
        $this->busca = $request->getParameter('busca');
      if($request->getParameter('site_id'))
        $this->site_id = $request->getParameter('site_id');
      
      // URI
      $this->uri = $request->getUri();
      // URL
      $this->url = @current(explode('?',$this->uri));
      // section
      $this->section = $request->getParameter('object');

      if($request->getParameter('debug') != "")
        print "<br>>>>".$this->section->getId();

      if($this->section->getId() == 113){
        header("Location: /maiscrianca");
        die();
      }
      
      $this->getUser()->setCulture('pt_BR');

      // current site
      $this->site = $this->section->Site;

	    if(($this->site->getSlug() == "culturafm")&&($this->section->getSlug()=="controle-remoto")){
	      $this->setLayout(false);
	    }elseif($this->site->getSlug() == "prontoatendimento"){
	      if($this->section->getSlug() != "ao-vivo") {
	        if(date('w') == 6 && date('H:i') >= "12:30") {
	          header("Location: http://tvcultura.cmais.com.br/prontoatendimento/ao-vivo");
	      die(); 
	        }
	     }
	    }
			
	    if(($this->site->getSlug() == "quintaldacultura") && !$request->getParameter('force')){
	    	if($this->section->getSlug() == 'voceescolhe'){
	          header("Location: http://cmais.com.br/quintaldacultura");
	      	  die(); 
	    	}
	    }
			
			if ($request->getUri() == "http://www.fpa.com.br/sic/home") {
				header('Location: http://fpa.com.br/sic');
				die();
			}

	    if($this->site->getSlug() == "rodaviva"){
				if (date('w H:i') > "1 22:00" && date('w H:i') < "1 23:35") {
					if ($this->section->getSlug() == "home") {
						header("Location: http://tvcultura.cmais.com.br/rodaviva/transmissao");
						die();
					}	
				}
				else {
					if ($this->section->getSlug() == "transmissao") {
						header("Location: http://tvcultura.cmais.com.br/rodaviva");
						die();
					}	
				}
			}

    
      if(($this->section->Site->type == "Programa Simples")||($this->section->Site->type == "Programa TVRTB" && $this->section->getSlug() == "programacao")){
        if($this->section->getSlug() == "diario-de-programacao" || $this->section->getSlug() == "home" || $this->section->getSlug() == "homepage" || $this->section->getSlug() == "programacao"){
          if($request->getParameter('object')){
            if($request->getParameter('d')){
              $this->date = $request->getParameter('d');
              $start = date("Y/m/d", mktime(0,0,0, substr($this->date,5,2), substr($this->date,8,2) ,substr($this->date,0,4)));
              $end = date("Y/m/d", mktime(0,0,0, substr($this->date,5,2), substr($this->date,8,2)+1 ,substr($this->date,0,4))); 
              $this->nextDate = $end;
              $this->prevDate = date("Y/m/d", mktime(0,0,0, substr($this->date,5,2), substr($this->date,8,2)-1 ,substr($this->date,0,4)));
              if($this->site->Program->id == 111){
                $this->schedules = Doctrine_Query::create()
                  ->select('s.*')
                  ->from('Schedule s')
                  ->where('s.program_id = ?', $this->site->Program->id)
                  ->andWhere('s.channel_id = ?', 1)
                  ->andWhere('s.date_start >= ? AND s.date_start <= ?', array($start.' 04:59:59', $end.' 05:00:00'))
                  ->orderBy('s.date_start asc')
                  ->limit(80)
                  ->execute();
              }
              else{
                $this->schedules = Doctrine_Query::create()
                  ->select('s.*')
                  ->from('Schedule s')
                  ->where('s.channel_id = ?', $this->site->Program->getChannelId())
                  ->andWhere('s.program_id = ?', $this->site->Program->id)
                  ->andWhere('s.date_start >= ? AND s.date_start <= ?', array($start.' 04:59:59', $end.' 05:00:00'))
                  ->orderBy('s.date_start asc')
                  ->limit(80)
                  ->execute();
              }
            }
            else{
              $this->date = date("Y-m-d");
              $start = date("Y/m/d", mktime(0,0,0, substr($this->date,5,2), substr($this->date,8,2) ,substr($this->date,0,4)));
              $end = date("Y/m/d", mktime(0,0,0, substr($this->date,5,2), substr($this->date,8,2)+1 ,substr($this->date,0,4))); 
              $this->nextDate = $end;
              $this->prevDate = date("Y/m/d", mktime(0,0,0, substr($this->date,5,2), substr($this->date,8,2)-1 ,substr($this->date,0,4)));
              
              if($this->site->Program->id == 111){
                $next = Doctrine_Query::create()
                  ->select('s.*')
                  ->from('Schedule s')
                  ->where('s.program_id = ?', $this->site->Program->id)
                  ->andWhere('s.channel_id = ?', 1)
                  ->andWhere('s.date_start > ?', date("Y-m-d"))
                  ->orderBy('s.date_start asc')
                  ->limit(1)
                  ->execute();
              }
              else{
                $next = Doctrine_Query::create()
                  ->select('s.*')
                  ->from('Schedule s')
                  ->where('s.program_id = ?', $this->site->Program->id)
                  ->andWhere('s.channel_id = ?', 1)
                  ->andWhere('s.date_start > ?', date("Y-m-d"))
                  ->orderBy('s.date_start asc')
                  ->limit(1)
                  ->execute();
              }

              if(count($next)>0){
                $d = explode(" ",$next[0]->date_start);
                header("Location: ".$this->uri."?d=".str_replace("-","/",$d[0]));
                die();
              }else{
                $prev = Doctrine_Query::create()
                  ->select('s.*')
                  ->from('Schedule s')
                  ->where('s.program_id = ?', $this->site->Program->id)
                  ->andWhere('s.date_start < ?', date("Y-m-d"))
                  ->orderBy('s.date_start asc')
                  ->limit(1)
                  ->execute();
                if(count($prev)>0){
                  $d = explode(" ",$prev[0]->date_start);
                  header("Location: ".$this->uri."?d=".str_replace("-","/",$d[0]));
                  die();
                }
              }
            }
            $this->nextDate = date("Y/m/d", mktime(0,0,0, substr($this->date,5,2), substr($this->date,8,2)+1 ,substr($this->date,0,4))); 
            $this->prevDate = date("Y/m/d", mktime(0,0,0, substr($this->date,5,2), substr($this->date,8,2)-1 ,substr($this->date,0,4))); 
          }
        }
        elseif($this->section->getSlug() == "episodios"){
          if($request->getParameter('e')){
            $this->episode = Doctrine::getTable('Asset')->findOneBySlug($request->getParameter('e'))->AssetEpisode;
            $this->season = $this->episode->AssetSeason;
          }
          elseif($request->getParameter('s')){
            $this->season = Doctrine::getTable('Asset')->findOneBySlug($request->getParameter('s'))->AssetSeason;
            //$this->episode = @current($this->season->AssetSeason->AssetEpisodes);
          }else{
            $this->season = $tag = Doctrine::getTable('Asset')->findOneByAssetTypeIdAndSiteId(14, $this->site->id)->AssetSeason;
          }
          $this->episodes = $this->season->AssetEpisodes;
          if(!$this->episode)
            $this->episode = $this->episodes[0];
        }
        elseif($this->section->getSlug() == "personagens"){
          if($request->getParameter('p'))
            $this->asset = Doctrine::getTable('Asset')->findOneBySlug($request->getParameter('p'));
        }
      }
/*
			// controls mobile user redirections
			//if ($request->getHost() != 'm.cmais.com.br') {			
				if ($this->section->Site->Program->getChannelId() == 1 || in_array($this->section->Site->getSlug(), array("cmais","m","tvcultura"))) {
					$from = $request->getParameter('from');	
					if (!isset($_COOKIE['versao_classica']) && $from == 'm')
						setcookie('versao_classica', '1');
	
					$useragent=$_SERVER['HTTP_USER_AGENT'];
					if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))) {
						if ($request->getHost() != 'm.cmais.com.br') {
							//if ($request->getParameter('param1')) {
								if (!isset($_COOKIE['versao_classica']) && $from != 'm') {
									if ($request->getParameter('param1'))
										$siteMob = Doctrine::getTable('Site')->findOneBySlug($request->getParameter('param1'));
									if ($siteMob->id > 0) {
										if ($siteMob->getSlug() != 'cmais') {
											header('Location: http://m.cmais.com.br/programa/' . $siteMob->getSlug());
											die();
										}
										else {
											header('Location: http://m.cmais.com.br');
											die();
										}
									}
									else {
										if (in_array($request->getParameter('param1'), array("programas","grade","aovivo"))) {
											header('Location: http://m.cmais.com.br/'.$request->getParameter('param1'));
											die();
										}
										else {
											header('Location: http://m.cmais.com.br');
											die();
										}
									}
								}
							//}
							//else {
							//	header('Location: http://m.cmais.com.br');
							//	die();
							//}
						}
					}
					else {
						if ($this->section->Site->getSlug() == "m" && $_REQUEST['force'] != "1") {
							if ($this->section->getSlug() == "programa") {
								$siteDesk = Doctrine::getTable('Site')->findOneBySlug($request->getParameter('slug'));
								if ($siteDesk->id > 0) {
									if ($siteDesk->getSlug() != 'cmais') {
										header('Location: http://cmais.com.br/'.$siteDesk->getSlug());
										die();
									}
									else {
										header('Location: http://cmais.com.br/');
										die();
									}
								}
								else {
									header('Location: http://cmais.com.br/');
									die();
								}
							}
							elseif (in_array($this->section->getSlug(), array("home","home-page","homepage"))) {
								header('Location: http://cmais.com.br');
								die();
							}
							elseif (in_array($this->section->getSlug(), array("grade","aovivo"))) {
								header('Location: http://cmais.com.br/'.$this->section->getSlug());
								die();
							}
							elseif ($this->section->getSlug() == "programas") {
								header('Location: http://cmais.com.br/programas-de-a-z');
								die();
							}
							elseif ($this->section->getSlug() == "culturabrasil") {
								header('Location: http://www.culturabrasil.com.br');
								die();
							}
							elseif ($this->section->getSlug() == "culturafm") {
								header('Location: http://culturafm.cmais.com.br');
								die();
							}
							else {
								header('Location: http://cmais.com.br');
								die();
							}
						}
					}
				}
			//}
			*/
      // siteSections
      if($this->section->Site->type == "Portal" || $this->section->Site->getSlug() == "m"){
        
        if($this->section->Site->getSlug() == "cmais"){
          $this->siteSections = Doctrine_Query::create()
            ->select('s.*')
            ->from('Section s')
            ->where('s.parent_section_id = ?', $this->section->id)
            ->andWhere('s.is_active = ?', 1)
            ->andWhere('s.is_visible = ?', 1)
            ->andWhereNotIn('s.slug', array('home', 'home-page', 'homepage'))
            ->orderBy('s.display_order')
            ->execute();
        }elseif($this->section->Site->getSlug() == "tvratimbum" && $this->section->getSlug() == "agenda"){
          if($request->getParameter('d')){
            $this->date = $request->getParameter('d');
            $this->start = date("Y/m/d", mktime(0,0,0, substr($this->date,5,2), substr($this->date,8,2) ,substr($this->date,0,4)));
            $this->end = date("Y/m/d", mktime(0,0,0, substr($this->date,5,2), substr($this->date,8,2)+1 ,substr($this->date,0,4))); 
            $this->nextDate = $this->end;
            $this->prevDate = date("Y/m/d", mktime(0,0,0, substr($this->date,5,2), substr($this->date,8,2)-1 ,substr($this->date,0,4)));
          }
          else{
            $date = date("Y/m/d");
            header("Location: ".$this->uri."?d=".str_replace("-","/",$date));
            die();
          }
        }else{
          $this->siteSections = Doctrine_Query::create()
            ->select('s.*')
            ->from('Section s')
            ->where('s.site_id = ?', $this->section->getSiteId())
            ->andWhere('s.is_active = ?', 1)
            ->andWhere('s.is_visible = ?', 1)
						->andWhere('parent_section_id IS NULL')						
            ->andWhereNotIn('s.slug', array('home', 'home-page', 'homepage'))
            ->orderBy('s.display_order')
            ->execute();
        }
        
        // category
        $this->category = Doctrine::getTable('Category')->findOneBySlug($this->section->slug);
        if(($this->category)&&($this->section->parent_section_id > 0)){
          if($request->getParameter('d')){
            if($request->getParameter('d'))
              $this->date = $request->getParameter('d');
            else
              $this->date = date("Y/m/d");
            // category assets
            $this->assetsQuery = Doctrine_Query::create()
              ->select('a.*')
              ->from('Asset a, CategoryAsset ca')
              ->where('ca.category_id = ?', $this->category->id)
              ->andWhere('ca.asset_id = a.id')
              ->andWhere('a.is_active = ?', 1)
              ->andWhere('a.created_at >= ? AND a.created_at <= ?', array($this->date.' 00:00:00', $this->date.' 23:59:59'))
              ->orderBy('a.id desc');
          }
          else{
            // category assets
            $this->assetsQuery = Doctrine_Query::create()
              ->select('a.*')
              ->from('Asset a, CategoryAsset ca')
              ->where('ca.category_id = ?', $this->category->id)
              ->andWhere('ca.asset_id = a.id')
              ->andWhere('a.is_active = ?', 1)
              ->orderBy('a.id desc');
          }
        }
        else{
          if(($this->section->slug == "grade")||($this->section->slug == "diario-de-programacao")||($this->section->slug == "programacao")||($this->section->slug == "guia-do-ouvinte")){
            $s = 'tvcultura';
            if($request->getParameter('c') == "univesptv")
              $s = 'univesptv';
            elseif(($request->getParameter('c') == "multicultura")||($this->section->Site->getSlug() == "multicultura"))
              $s = 'multicultura';
            elseif($request->getParameter('c') == "tvratimbum")
              $s = 'tvratimbum';
            if($this->section->slug == "diario-de-programacao")
              $s = 'culturafm';
            if($this->section->slug == "guia-do-ouvinte")
              $s = 'culturafm';
            if($request->getParameter('d'))
              $this->date = $request->getParameter('d');
            else
              $this->date = date("Y/m/d");
            
            if($this->site->getSlug() == "tvratimbum")
              $s = 'tvratimbum';
            else if($this->site->getSlug() == "univesptv")
              $s = 'univesptv';

            $start = date("Y/m/d", mktime(0,0,0, substr($this->date,5,2), substr($this->date,8,2) ,substr($this->date,0,4)));
            $end = date("Y/m/d", mktime(0,0,0, substr($this->date,5,2), substr($this->date,8,2)+1 ,substr($this->date,0,4))); 
            $this->nextDate = $end;
            $this->prevDate = date("Y/m/d", mktime(0,0,0, substr($this->date,5,2), substr($this->date,8,2)-1 ,substr($this->date,0,4)));

            $this->sChannel = Doctrine::getTable('Channel')->findOneBySlug($s);
            // schedules
            if($this->section->slug == "guia-do-ouvinte"){
              $this->schedules = Doctrine_Query::create()
              ->select('s.*')
              ->from('Schedule s')
              ->where('s.channel_id = ?', $this->sChannel->id)
              ->andWhere('s.date_start >= ? AND s.date_start <= ?', array($start.' 00:00:00', $start.' 23:59:59'))
              ->orderBy('s.date_start asc')
              ->limit(80)
              ->execute();
            }
            else{
              $this->schedules = Doctrine_Query::create()
              ->select('s.*')
              ->from('Schedule s')
              ->where('s.channel_id = ?', $this->sChannel->id)
              ->andWhere('s.date_start >= ? AND s.date_start <= ?', array($start.' 04:59:59', $end.' 05:00:00'))
              ->orderBy('s.date_start asc')
              ->limit(80)
              ->execute();
            }
          }
          else if(($this->section->slug == "videos")){
            if(($request->getParameter('site_id') <= 0)&&($request->getParameter('busca') == '')){
              if($this->site->getSlug() == "penarua"){
                $this->assetsQuery = Doctrine_Query::create()
                ->select('a.*')
                ->from('Asset a, SectionAsset sa')
                ->where('sa.section_id = ?', $this->section->id)
                ->andWhere('sa.asset_id = a.id')
                ->andWhere('a.is_active = ?', 1)
                ->orderBy('sa.display_order')
                ->limit(20);
              }else{
                $this->assetsQuery = Doctrine_Query::create()
                  ->select('a.*')
                  ->from('Asset a, AssetVideo av');
                if($this->site->getId() == 3)
                  $this->assetsQuery->where('a.site_id = ?', $this->site->getId())->andWhere('av.asset_id = a.id');
                else
                  $this->assetsQuery->where('av.asset_id = a.id');
                $this->assetsQuery->andWhere("av.youtube_id != ''")
                  ->andWhere('a.is_active = 1')
                  ->andWhereIn('a.asset_type_id', array(6, 7))
                  ->groupBy('a.id')
                  ->orderBy('a.created_at desc')
                  ->limit(20);
              }
            }
            else if(($request->getParameter('site_id') > 0)&&($request->getParameter('busca') != '')){
              $this->assetsQuery = Doctrine_Query::create()
                ->select('a.*')
                ->from('Asset a, AssetVideo av')
                ->where('av.asset_id = a.id')
                ->andWhere("av.youtube_id != ''")
                ->andWhere('a.site_id = ?', $request->getParameter('site_id'))
                ->andWhere('a.is_active = 1')
                ->andWhereIn('a.asset_type_id', array(6, 7))
                ->andWhere("a.title like '%".$request->getParameter('busca')."%' OR a.description like '%".$request->getParameter('busca')."%'")
                ->orderBy('a.created_at desc')
                ->limit(20);
            }
            else if($request->getParameter('site_id') > 0){
              $this->assetsQuery = Doctrine_Query::create()
                ->select('a.*')
                ->from('Asset a, AssetVideo av')
                ->where('av.asset_id = a.id')
                ->andWhere("av.youtube_id != ''")
                ->andWhere('a.site_id = ?', $request->getParameter('site_id'))
                ->andWhere('a.is_active = 1')
                ->andWhereIn('a.asset_type_id', array(6, 7))
                ->groupBy('a.id')
                ->orderBy('a.created_at desc')
                ->limit(20);
            }
        else if($request->getParameter('busca') != ''){
              $this->assetsQuery = Doctrine_Query::create()
                ->select('a.*')
                ->from('Asset a, AssetVideo av')
                ->andWhere('av.asset_id = a.id')
                ->andWhere("av.youtube_id != ''")
                ->andWhere('a.is_active = 1')
                ->andWhereIn('a.asset_type_id', array(6, 7))
                ->andWhere("a.title like '%".$request->getParameter('busca')."%' OR a.description like '%".$request->getParameter('busca')."%'")
                ->groupBy('a.id')
                ->orderBy('a.created_at desc')
                ->limit(20);
            }
      }
          else{
            if($request->getParameter('d')){
              if($request->getParameter('d'))
                $this->date = $request->getParameter('d');
              else
                $this->date = date("Y/m/d");
              // category assets
              $this->assetsQuery = Doctrine_Query::create()
                ->select('a.*')
                ->from('Asset a, SectionAsset sa')
                ->where('sa.section_id = ?', $this->section->id)
                ->andWhere('sa.asset_id = a.id')
                ->andWhere('a.is_active = ?', 1)
                ->andWhere('a.created_at >= ? AND a.created_at <= ?', array($this->date.' 00:00:00', $this->date.' 23:59:59'))
                ->orderBy('a.id desc');
            }
            else{
              if($request->getParameter('debug') != "")
                print "<br>>>s>".$this->site_id." >>>>t>".$this->busca;
        
              if(($this->site_id > 0)&&($this->busca)){
                $this->assetsQuery = Doctrine_Query::create()
                  ->select('a.*')
                  ->from('Asset a, SectionAsset sa')
                  ->where('sa.section_id = ?', $this->section->id)
                  ->andWhere('a.is_active = 1')
                  ->andWhereIn('a.asset_type_id', array(6, 7))
                  ->andWhere("a.title like '%".$this->busca."%' OR a.description like '%".$this->busca."%'")
                  ->andWhere("a.site_id = ?", $this->site_id)
                  ->orderBy('a.created_at desc')
                  ->limit(20);
              }else{
                // section assets
                $this->assetsQuery = Doctrine_Query::create()
                  ->select('a.*')
                  ->from('Asset a, SectionAsset sa')
                  ->where('sa.section_id = ?', $this->section->id)
                  ->andWhere('sa.asset_id = a.id');
                if($this->site_id > 0)
                  $this->assetsQuery->andWhere('a.site_id = ?', (int)$this->site_id);
                if($this->busca != "")
                  $this->assetsQuery->andWhere('a.title like ? OR a.description like ?', array('%'.$this->busca.'%', '%'.$this->busca.'%'));
                $this->assetsQuery->andWhere('a.is_active = ?', 1)
                  ->orderBy('a.created_at desc'); 
              }
            }
          }
        }
      }else{
        if($this->site->type == 'ProgramaRadio'){
          $this->siteSections = Doctrine_Query::create()
            ->select('s.*')
            ->from('Section s')
            ->where('s.site_id = ?', 4)
            ->andWhere('s.is_active = ?', 1)
            ->andWhere('s.is_visible = ?', 1)
            ->andWhere('s.parent_section_id <= 0 OR s.parent_section_id IS NULL')
            ->andWhereNotIn('s.slug', array('home', 'home-page', 'homepage'))
            ->orderBy('s.display_order')
            ->limit(10)
            ->execute();
        }
        else{
          if(($this->site->Program->Channel->getSlug() == "univesptv")&&($this->site->getSlug() != "inglescommusica")){
            $this->siteSections = Doctrine_Query::create()
              ->select('s.*')
              ->from('Section s')
              ->where('s.site_id = ?', 3)
              ->andWhere('s.is_active = ?', 1)
              ->andWhere('s.is_visible = ?', 1)
              ->andWhere('s.parent_section_id <= 0 OR s.parent_section_id IS NULL')
              ->andWhereNotIn('s.slug', array('home', 'home-page', 'homepage'))
              ->orderBy('s.display_order')
              ->limit(10)
              ->execute();
	        }elseif($this->section->Site->getSlug() == "sic"){
	          $this->siteSections = Doctrine_Query::create()
	            ->select('s.*')
	            ->from('Section s')
	            ->where('s.site_id = ?', $this->section->getSiteId())
	            ->andWhere('parent_section_id IS NULL')
	            ->andWhere('s.is_active = ?', 1)
	            ->andWhere('s.is_visible = ?', 1)
	            ->orderBy('s.display_order')
	            ->execute();
					}					
          else{
            $this->siteSections = Doctrine_Query::create()
              ->select('s.*')
              ->from('Section s')
              ->where('s.site_id = ?', $this->site->id)
              ->andWhere('s.is_active = ?', 1)
              ->andWhere('s.is_visible = ?', 1)
              ->andWhere('s.parent_section_id <= 0 OR s.parent_section_id IS NULL')
              ->andWhereNotIn('s.slug', array('home', 'home-page', 'homepage'))
              ->orderBy('s.display_order')
              ->limit(10)
              ->execute();
          }
        }
          
        if($request->getParameter('d')){
          if($request->getParameter('d'))
            $this->date = $request->getParameter('d');
          else
            $this->date = date("Y/m/d");
            // assets
            $this->assetsQuery = Doctrine_Query::create()
              ->select('a.*')
              ->from('Asset a, SectionAsset sa')
              ->where('sa.section_id = ?', $this->section->id)
              ->andWhere('sa.asset_id = a.id')
              ->andWhere('a.is_active = ?', 1)
              ->andWhere('a.created_at >= ? AND a.created_at <= ?', array($this->date.' 00:00:00', $this->date.' 23:59:59'))
              ->orderBy('a.id desc');
        }
        else{
          if($this->site->getSlug() == "penarua"){
            $this->assetsQuery = Doctrine_Query::create()
              ->select('a.*')
              ->from('Asset a, SectionAsset sa')
              ->where('sa.asset_id = a.id')
              ->andWhere('a.is_active = ?', 1);
            if($request->getParameter('busca') != '') 
              $this->assetsQuery->andWhere("a.title like '%".$request->getParameter('busca')."%' OR a.description like '%".$request->getParameter('busca')."%'");
            if($request->getParameter('section') != '') 
              $this->assetsQuery->andWhere("sa.section_id = ?", (int)$request->getParameter('section'));
						else
              $this->assetsQuery->andWhere('sa.section_id = ?', $this->section->id);
            $this->assetsQuery->orderBy('sa.display_order');
          }
          else if (in_array($this->site->getSlug(), array('rodaviva','provocacoes','metropolis'))) {
          	
            if($this->section->getSlug()=="programas"){
              if($request->getParameter('ordem') == 'alfabetica') {
                $request->setParameter('ordem','a.title');
                if(!$request->getParameter('sequencia'))
                  $request->setParameter('sequencia','asc');
              }
              else if($request->getParameter('ordem') == 'cronologica') {
                $request->setParameter('ordem','ae.date_release');
                if(!$request->getParameter('sequencia'))
                  $request->setParameter('sequencia','asc');
              }
              else {
                $request->setParameter('ordem','ae.date_release');
                if (!$request->getParameter('sequencia'))
                  $request->setParameter('sequencia','desc');
              }
              $this->assetsQuery = Doctrine_Query::create()
                ->select('*')
                ->from('Asset a, AssetEpisode ae')
                ->where('a.id = ae.asset_id')
                ->andWhere('a.asset_type_id = ?', 15)
                ->andWhere('a.site_id = ?', $this->site->id)
                ->andWhere("a.title like '%" . $request->getParameter('palavra') . "%' OR a.description like '%" . $request->getParameter('palavra') . "%'")
                ->andWhere('ae.date_release >= ?', $request->getParameter('de') ? $request->getParameter('de') : '0')
                ->andWhere('ae.date_release <= ?', $request->getParameter('ate') ? $request->getParameter('ate') : '99999999')
                ->andWhere('a.is_active = ?', 1)
                ->groupBy('a.id')
                ->orderBy($request->getParameter('ordem') . " " . $request->getParameter('sequencia'));   
            }
            else{
              $this->assetsQuery = Doctrine_Query::create()
                ->select('a.*')
                ->from('Asset a, SectionAsset sa')
                ->where('sa.section_id = ?', $this->section->id)
                ->andWhere('sa.asset_id = a.id')
                //->andWhere('a.date_start <= ? AND a.date_end >= ?', array(date("Y/m/d H:i:s"), date("Y/m/d H:i:s")))
                ->andWhere('a.is_active = ?', 1)
                ->orderBy('a.id desc');
            }
          }
          else {
          	if ($this->site->getSlug() == "reportereco" && $this->section->getSlug() == "videos") {
							$relatedAssets = Doctrine_Query::create()
								->select('ra.parent_asset_id')
								->from('RelatedAsset ra, Asset a2, AssetVideo av')
								->where('ra.asset_id = a2.id')
								->andWhere('a2.asset_type_id = ?', 6)
								->andWhere('a2.site_id = ?', $this->site->getId())
								->andWhere('av.asset_id = a2.id')
								->andWhere('av.youtube_id != ""')
								->groupBy('ra.parent_asset_id')
								->execute();
							
							foreach($relatedAssets as $ra)
								$related[] = $ra->parent_asset_id;
							
              $this->assetsQuery = Doctrine_Query::create()
                ->select('a.*')
                ->from('Asset a, SectionAsset sa')
                ->where('sa.section_id = ?', $this->section->id)
                ->andWhere('sa.asset_id = a.id')
                ->andWhere('a.asset_type_id = ?', 1)
                ->andWhere('a.is_active = ?', 1)
								->andWhereIn('a.id',$related);
              if($request->getParameter('busca') != '')
                $this->assetsQuery->andWhere("a.title like '%".$request->getParameter('busca')."%' OR a.description like '%".$request->getParameter('busca')."%'");               
              $this->assetsQuery->orderBy('a.created_at desc');
						}
						else {
	            $this->assetsQuery = Doctrine_Query::create()
	              ->select('a.*')
	              ->from('Asset a, SectionAsset sa')
	              ->where('sa.section_id = ?', $this->section->id)
	              ->andWhere('sa.asset_id = a.id')
	              ->andWhere('a.is_active = ?', 1);
	            if($request->getParameter('busca') != '')
	              $this->assetsQuery->andWhere("a.title like '%".$request->getParameter('busca')."%' OR a.description like '%".$request->getParameter('busca')."%'");               
	            if(($this->site->getId() == 295)&&($this->section->id == 893))
	              $this->assetsQuery->orderBy('sa.display_order');
	            else if(($this->site->getId() == 282)&&($this->section->id == 778))
	              $this->assetsQuery->orderBy('sa.display_order');
	            else
	              $this->assetsQuery->orderBy('a.created_at desc');
						}
          }
        }
      }
      // program
      $this->program = $this->site->Program;
      // main site
      $this->mainSite = Doctrine::getTable('Site')->findOneBySlug('cmais');
      
      // blocks
      $bs = $this->section->Blocks;
      $displays = array();
      if(count($bs) > 0){
        foreach($bs as $b){
          $displays[$b->getSlug()] = $b->retriveDisplays();
          if($request->getParameter('debug') != "")
            print "<br>>>>".$b->getSlug()." - ".$b->getid()." - ".$b->getItems()." >>displays> ".count($displays[$b->getSlug()]);
        }
      }
      if(!isset($displays['alerta'])){
        $block = Doctrine::getTable('Block')->findOneById(210);
        if($block)
          $displays['alerta'] = $block->retriveDisplays();
      }
      $this->displays = $displays;
      unset($displays); unset($bs); 
    }

    if($request->getParameter('section_id'))
      $this->section_id = $request->getParameter('section_id');
    if($request->getParameter('site_id'))
      $this->site_id = $request->getParameter('site_id');

    $sectionSlug = $this->section->getSlug();
    
    if($this->site->slug == 'culturafm'){
      if(in_array($sectionSlug, array('fale-conosco','faleconosco','contato')))
        $sectionSlug = 'contact';
      if(in_array($sectionSlug, array('home-page','homepage','home')))
        $sectionSlug = 'index';
      if(in_array($sectionSlug, array('diario-de-programacao')))
        $sectionSlug = 'grade';
    }
    elseif(in_array($sectionSlug, array('home','homepage','home-page','diario-de-programacao'))){
      if($this->site->type == "Programa Infantil"){
        $sectionSlug = 'programa';
        if($request->getParameter('p'))
          $this->character = Doctrine::getTable('Asset')->findOneBySlug($request->getParameter('p'));
      }
      else
        $sectionSlug = 'index';
    }
    elseif(in_array($sectionSlug, array('noticias','linha-do-tempo')))
      $sectionSlug = 'list';
    elseif(in_array($sectionSlug, array('sobre','entrevistadores','entrevistados')))
      $sectionSlug = 'asset';
    elseif(in_array($sectionSlug, array('equipe','apresentadores','personagens')))
      $sectionSlug = 'team';
    elseif(in_array($sectionSlug, array('fotos')))
      $sectionSlug = 'imagens';
    elseif(in_array($sectionSlug, array('fale-conosco','faleconosco','contato','contate-o-nucleo')))
      $sectionSlug = 'contact';
    elseif(in_array($sectionSlug, array('aovivo','ao-vivo')))
      $sectionSlug = 'live';
    elseif(in_array($sectionSlug, array('programas-a-z')))
      $sectionSlug = 'programas-de-a-z';
    #elseif(in_array($sectionSlug, array('programacao')))
    #  $sectionSlug = 'grade';

    if($sectionSlug == 'contate-o-nucleo')
      $sectionSlug = 'contact';

    if($this->site->getSlug() == "m" && $sectionSlug == 'list')
      $sectionSlug = 'noticias';

    if(in_array($this->section->getSlug(), array('infantil')))
      $this->setLayout(false);

    if($this->site->slug == 'quintaldacultura'){
      if(($sectionSlug == 'todos')||($sectionSlug == 'todas')||($sectionSlug == 'tudo')){
        if($this->section->Parent->getSlug() == "imagens")
          $sectionSlug = "imagem";
        elseif($this->section->Parent->getSlug() == "baixar")
          $sectionSlug = "baixar-content";
        else
          $sectionSlug = substr($this->section->Parent->getSlug(),0,strlen($this->section->Parent->getSlug())-1);
      }else{
        if(in_array($sectionSlug, array('desafio','esportes','habilidade','educativos','aventura')))
          $sectionSlug = 'jogo';
        elseif(in_array($sectionSlug, array('artes','brincadeiras','receitas','experiencia')))
          $sectionSlug = 'atividade';
        elseif(in_array($sectionSlug, array('paracolorir','para-colorir','colorir')))
          $sectionSlug = 'atividade-colorir';
        elseif(in_array($sectionSlug, array('papel-de-parede','folhinha','toque-para-celular','carinhas')))
          $sectionSlug = 'baixar-content';
        elseif($sectionSlug == 'videos'){
          if($request->getParameter('s')>0){
            $sectionSlug = 'video';
            $this->s = Doctrine::getTable('Site')->findOneById($request->getParameter('s'));
          }
        }
        elseif($sectionSlug == 'imagens'){
          if($request->getParameter('s')>0){
            $sectionSlug = 'imagem';
            $this->s = Doctrine::getTable('Site')->findOneById($request->getParameter('s'));
          }
        }
      }
      if(!in_array($sectionSlug, array('team','desenhos','diretrizes-pedagogicas','sobre-o-quintal-da-cultura','publico-alvo'))){ 
        $this->setLayout(false);
      }
    }
    elseif($this->site->slug == 'maiscrianca'){
      if(in_array($sectionSlug, array('index','home','vocesabia','recadinhos'))){ 
        $this->setLayout(false);
      }
    }
    elseif($this->site->slug == 'm'){
      $this->setLayout(false);
    }
    elseif($this->site->slug == 'sic'){
      $this->setLayout(false);
    }

    // mail sender
    $email_site = $this->section->getContactEmail();
    if(isset($email_site)) {
      if(($request->getParameter('captcha'))||($request->getParameter('mande-seu-tema'))||($this->section->getSlug()=='participe')||($this->section->getSlug()=='piadas')||($this->site->getSlug() == "tvcocorico")){
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
      
          $email_site = $this->section->getContactEmail();
          $email_user = strip_tags($request->getParameter('email'));
          $nome_user = strip_tags($request->getParameter('nome'));
          if(strpos($_SERVER['HTTP_REFERER'], $_SERVER['SERVER_NAME']) > 0) {
            // verifica se o servidor que ta o formulario é o mesmo que o chamou, se for um ataque de injeção de dados este valor será diferente
            ini_set('sendmail_from', $email_site);
            $msg = "Formulario Preenchido em " . date("d/m/Y") . " as " . date("H:i:s") . ", seguem abaixo os dados:<br><br>";
            while(list($campo, $valor) = each($_REQUEST)) {
              if(!in_array(ucwords($campo), array('Form_action', 'X', 'Y', 'Enviar', 'Undefinedform_action')))
                $msg .= "<b>" . ucwords($campo) . ":</b> " . strip_tags($valor) . "<br>";
            }
            $cabecalho = "Return-Path: " . $nome_user . " <" . $email_user . ">\r\n";
            $cabecalho .= "From: " . $nome_user . " <" . $email_user . ">\r\n";
            $cabecalho .= "X-Priority: 3\r\n";
            $cabecalho .= "X-Mailer: Formmail [version 1.0]\r\n";
            $cabecalho .= "MIME-Version: 1.0\r\n";
            $cabecalho .= "Content-Transfer-Encoding: 8bit\r\n";
            $cabecalho .= 'Content-Type: text/html; charset="utf-8"';
            if(mail($email_site, '['.$this->site->getTitle().']['.$this->section->getTitle().'] '.$nome_user.' <'.$email_user.'>', stripslashes(nl2br($msg)), $cabecalho)){
        			die("1");
            }
            else {
              die("0");
						}
          }
          else {
            header("Location: http://cmais.com.br");
            die();
          }
        }
      }
    }

    if($this->site->type == "Programa Infantil")
      $this->setLayout(false);
    
    //metas
    /*
    if(($sectionSlug == 'videos')&&($this->site->getId() == 1)){
      $vid1 = Doctrine_Query::create()
        ->select('a.*')
        ->from('Asset a, AssetVideo av')
        ->where('a.id = av.asset_id')
        ->andWhere('a.is_active = 1')
        ->andWhere('a.asset_type_id = 6')
        ->andWhere("av.youtube_id != ''")
        ->andWhere("(a.date_start IS NULL OR a.date_start <= CURRENT_TIMESTAMP)")
        ->limit(1)
        ->orderBy('a.id desc')
        ->fetchOne();
      if($vid1){
        $title = $vid1->Site->getTitle().' - '.$vid1->getTitle().' - cmais+ O portal de conteúdo da Cultura';
        //header("Location: ".$vid1->retriveUrl());
        //die();
      }
    }
    else */
    if($sectionSlug != 'index')
      $title = $this->site->getTitle().' - '.$this->section->getTitle().' - cmais+ O portal de conteúdo da Cultura';
    else{
      if($this->site->getTitle() != 'cmais+')
        $title = $this->site->getTitle().' - cmais+ O portal de conteúdo da Cultura';
      else
        $title = 'cmais+ O portal de conteúdo da Cultura';
    }
    $this->getResponse()->setTitle($title, false);
    
    if($this->section->getDescription() != "")
      $description = $this->section->getDescription().' - cmais+ O portal de conteúdo da Cultura';
    else
      $description = $this->site->getDescription().' - cmais+ O portal de conteúdo da Cultura';
    
    $this->getResponse()->addMeta('description', $description);
    $keywords = 'cultura, educacao, infantil, jornalismo';
    if($this->section->keywords != ""){
      foreach(explode(",",$this->section->keywords) as $k){
        $keywords .= ', '.trim($k);
      }
    }
    $this->getResponse()->addMeta('keywords', $keywords);

    $this->getResponse()->addMetaProp('og:title', $title);
    if(in_array($this->site->getType(), array('Programa Simples','Programa')))
      $this->getResponse()->addMetaProp('og:type', 'tv_show');
    else
      $this->getResponse()->addMetaProp('og:type', 'website');
    $this->getResponse()->addMetaProp('og:description', $description);
    $this->getResponse()->addMetaProp('og:url', $this->uri);
    $this->getResponse()->addMetaProp('og:site_name', 'cmais+');
    if($this->site->Program->getImageLive() != "")
      $this->getResponse()->addMetaProp('og:image', 'http://midia.cmais.com.br/programs/'.$this->site->Program->getImageLive());
    elseif($this->site->Program->getImageThumb() != "")
      $this->getResponse()->addMetaProp('og:image', 'http://midia.cmais.com.br/programs/'.$this->site->Program->getImageThumb());
    elseif($this->site->getImageThumb() != "")
      $this->getResponse()->addMetaProp('og:image', 'http://midia.cmais.com.br/programs/'.$this->site->getImageThumb());
    else
      $this->getResponse()->addMetaProp('og:image', 'http://cmais.com.br/portal/images/logoCMAIS.jpg');

    if($this->site->getSlug() == "socrates")
      $this->getResponse()->addMetaProp('og:image', 'http://midia.cmais.com.br/assets/image/image-2/ede959d3d1ebe912bb45850f59c92b07f243837a.jpg');
    
    // pagination
    if($sectionSlug == 'recadinhos'){
      $this->assetsQuery = Doctrine_Query::create()
        ->select('a.*')
        ->from('Asset a')
        ->where('a.category_id = ?', 24)
        ->orderBy('a.id desc');
      $pagelimit = 4;
    }
    elseif($sectionSlug == 'vocesabia')
      $pagelimit = 15;
    elseif(($sectionSlug == 'index')&&($this->site->getSlug()=="deupaulanatv"))
      $pagelimit = 1;
    elseif(($sectionSlug == 'programas')&&($this->site->getSlug()=="rodaviva"))
      $pagelimit = 9;
    elseif(($sectionSlug == 'blog')&&($this->site->getSlug()=="univesptv"))
      $pagelimit = 2;
    elseif(($sectionSlug == 'videos')&&($this->site->getSlug()=="univesptv")||($this->site->getSlug() == "castelo" && $sectionSlug == "episodios"))
      $pagelimit = 12;
    elseif(($sectionSlug == 'blog')&&($this->site->getSlug()=="cartaoverde"))
      $pagelimit = 1;
    elseif(($this->site->Program->Channel->getSlug()=="univesptv" || $this->site->Program->Channel->getSlug()=="univesp-tv-copy")&&($this->site->getType() != "Portal")){
      if($this->section->getSlug() != "home"){
        if($request->getParameter('debug') != "")
          echo ">>>>>>disciplina";
        $this->assetsQuery = Doctrine_Query::create()
          ->select('a.*')
          ->from('Asset a, SectionAsset sa')
          ->where('sa.section_id = ?', $this->section->id)
          ->andWhere('sa.asset_id = a.id')
          ->orderBy('sa.display_order');
        if($request->getParameter('busca') != '')
          $this->assetsQuery->andWhere("a.title like '%".$request->getParameter('busca')."%' OR a.description like '%".$request->getParameter('busca')."%'");               
				if ($this->site->getSlug() != "inglescommusica")
          $this->assetsQuery->limit(60);
      }
      else{
        if($request->getParameter('debug') != "")
          echo ">>>>>>não disciplina";
        if(count($this->section->getAssets()) > 0){
          $this->assetsQuery = Doctrine_Query::create()
            ->select('a.*')
            ->from('Asset a, SectionAsset sa')
            ->where('sa.section_id = ?', $this->section->id)
            ->andWhere('sa.asset_id = a.id')
            ->orderBy('sa.display_order')
            ->limit(60);
        }else{
          $this->assetsQuery = Doctrine_Query::create()
            ->select('a.*')
            ->from('Asset a')
            ->where('a.site_id = ?', (int)$this->site->getId())
            ->orderBy('a.created_at asc')
            ->limit(60);
        }
      }
      $pagelimit = 1;
		  if ($this->site->getSlug() == "inglescommusica")
        $pagelimit = 9;
		  			
    }
    if(!isset($pagelimit))
      $pagelimit = 9;
    if(isset($this->assetsQuery)){
      $this->pager = new sfDoctrinePager('Asset', $pagelimit);
      $this->pager->setQuery($this->assetsQuery);
      $this->pager->setPage($request->getParameter('page', 1));
      $this->pager->init();
      $this->page = $request->getParameter('page');
    }
		
		if($this->section->Site->getSlug() == "sic") {
  		if($this->pager->count() == 1){
    		header("Location: ".$this->pager->getCurrent()->retriveUrl());
    		die();
  		} 
  	} 

    if(($this->site->Program->Channel->getSlug() == "univesptv")&&($this->site->getSlug() != "inglescommusica")){
      $t = explode("-old", $this->section->Site->getSlug());
      if($_REQUEST["debug"]==1){
        echo $this->section->Site->getSlug();
      }
      if((count($t) > 1)&&($_REQUEST["test"]!=1)){
        header("Location: ".$t[0]);
        die();
      }
    }

    $debug = false;
    if($request->getParameter('debug') != ""){
      print "<br>Site>>".$this->site->id;
      print "<br>Seasons>>".count($this->seasons);
      print "<br>Assets: ".count($this->pager);
      print "<br>section: ".$this->section->getSlug();
      print "<br>section: ".$sectionSlug;
      print "<br>section: ".$this->section->getId();
      print "<br>page: ".$request->getParameter('page');
      print "<br>schedules: ".count($this->schedules);
      print "<br>page limit: ".$pagelimit;
      $debug = true;

      echo sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug.'Success.php';

    }
    
    if($sectionSlug == 'juvenil'){
      if($request->getParameter('test') == ""){
        header("Location: http://cmais.com.br");
        die();
      }
    }
    
    if(isset($this->category) && ($this->section->Parent->id > 0)){
      if(is_file(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug.'Success.php')){
        if($debug) print "<br1>>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug;
        $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug);
      }else{
        if($debug) print "<br>2>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/subsection';
        $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/subsection');
      }
    }
    elseif(is_file(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug.'Success.php')){
      if($debug) print "<br>3>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug;
      $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug);
    }
    elseif($this->section->Parent->id > 0){
      if($this->site->getType() == "Hotsite" || $this->site->getType() == 1){
        if(is_file(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug.'Success.php')){
          if($debug) print "<br>4-1>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug;
          $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug);
        }
        elseif(is_file(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$this->section->Parent->getSlug().'Success.php')){
          if($debug) print "<br>4-2>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$this->section->Parent->getSlug();
          $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$this->section->Parent->getSlug());
        }
        else{
          if($debug) print "<br>4-3>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultHotsite/'.$sectionSlug;
          $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultHotsite/'.$sectionSlug);
        }
      }
      elseif(is_file(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug.'Success.php')){
        if($debug) print "<br>5>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug;
        $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug);
      }
      elseif(is_file(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultPrograma/'.$sectionSlug.'Success.php')){
        if($debug) print "<br>6>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultPrograma/'.$sectionSlug;
        $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultPrograma/'.$sectionSlug);
      }
      elseif(is_file(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultProgramaSimples/'.$sectionSlug.'Success.php')){
        if($debug) print "<br>7>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultProgramaSimples/'.$sectionSlug;
        $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultProgramaSimples/'.$sectionSlug);
      }
      else{
        if($debug) print "<br>8>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultPrograma/subsection';
        $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultPrograma/subsection');
      }
    }
    else{
      if($this->site->getType() == "Hotsite" || $this->site->getType() == 1){
        if(is_file(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug.'Success.php')){
          if($debug) print "<br>9-1>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug;
          $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug);
        }else{
          if(is_file(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultHotsite/'.$sectionSlug.'Success.php')){
            if($debug) print "<br>9-2>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultHotsite/'.$sectionSlug;
            $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultHotsite/'.$sectionSlug);
          }
          else{
            if(is_file(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/subsectionSuccess.php')){
              if($debug) print "<br>9-3>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/subsection';
              $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/subsection');
            }else{
                if($debug) print "<br>9-4>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultHotsite/subsection';
              $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultHotsite/subsection');
            }
          }
        }
      }
      elseif($this->site->getType() == "Portal" || $this->site->getType() == 2){
        if(is_file(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug.'Success.php')){
          if($debug) print "<br>10-1>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug;
          $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug);
        }elseif(is_file(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/subsectionSuccess.php')){
          if($debug) print "<br>10-2>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/subsection';
          $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/subsection');
        }elseif(is_file(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultPortal/'.$sectionSlug.'Success.php')){
          if($debug) print "<br>10-3>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultPortal/'.$sectionSlug;
          $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultPortal/'.$sectionSlug);
        }else{
          if($sectionSlug == "grade"){
            if($this->site->getSlug()=="tvratimbum"){
              if($debug) print "<br>10-41>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/tvratimbum/grade';
              $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/tvratimbum/grade');
            }else{
              if($debug) print "<br>10-42>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/cmais/grade';
              $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/cmais/grade');
            }
          }
          elseif($sectionSlug == "programas-de-a-z"){
            if($debug) print "<br>10-5>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/cmais/programas-de-a-z';
            $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/cmais/programas-de-a-z');
          }
          else{
            if($debug) print "<br>10-6>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultPortal/subsection';
            $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultPortal/subsection');
          }
        }
      }
      elseif($this->site->getType() == "Programa" || $this->site->getType() == 3){
        if($this->site->Program->Channel->getSlug()=="univesptv"){
          $test = @end(explode("-",$this->site->getSlug()));
          if($test != "old"){
            if($this->site->Program->getIsACourse()){
              if($debug) print "<br>3.0>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/univesp-tv-copy/curso';
              $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/univesp-tv-copy/curso');
            }
            else{
              if($debug) print "<br>3.1>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/univesp-tv-copy/programa';
              if($this->site->getSlug() == 'inglescommusica')
                $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/univesp-tv-copy/subsection');
              else
                $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/univesp-tv-copy/programa');
            }
          }else{
            if($this->site->Program->getIsACourse()){
              if($debug) print "<br>3.0>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/univesptv/curso';
              $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/univesptv/curso');
            }
            else{
              if($debug) print "<br>3.1>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/univesptv/programa';
              if($this->site->getSlug() == 'inglescommusica')
                $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/univesptv/subsection');
              else
                $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/univesptv/programa');
            }
          }
        }        
        else if($this->site->Program->Channel->getSlug()=="univesp-tv-copy"){
          if($this->site->Program->getIsACourse()){
            if($debug) print "<br>3.0>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/univesp-tv-copy/curso';
            $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/univesp-tv-copy/curso');
          }
          else{
            if($debug) print "<br>3.1>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/univesp-tv-copy/programa';
            if($this->site->getSlug() == 'inglescommusica')
              $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/univesp-tv-copy/subsection');
            else
              $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/univesp-tv-copy/programa');
          }
        }        
        elseif(is_file(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug.'Success.php')){
          if($debug) print "<br>11-a>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug;
          $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug);
        }elseif(is_file(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/subsectionSuccess.php')){
          if($debug) print "<br>11-b>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/subsection';
          $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/subsection');
        }elseif(is_file(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultPrograma/'.$sectionSlug.'Success.php')){
          if($debug) print "<br>11-c>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultPrograma/'.$sectionSlug;
          $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultPrograma/'.$sectionSlug);
        }else{
          if($debug) print "<br>11-d>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultPrograma/subsection';
          $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultPrograma/subsection');
        }
      }
      elseif($this->site->getType() == "ProgramaRadio"){
        if(is_file(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug.'Success.php')){
          if($debug) print "<br>13-a>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug;
          $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/'.$sectionSlug);
        }elseif(is_file(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/subsectionSuccess.php')){
          if($debug) print "<br>13-b>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/subsection';
          $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/'.$this->site->getSlug().'/subsection');
        }elseif(is_file(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultProgramaRadio/'.$sectionSlug.'Success.php')){
          if($debug) print "<br>13-c>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultProgramaRadio/'.$sectionSlug;
          $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultProgramaRadio/'.$sectionSlug);
        }else{
          if($debug) print "<br>13-d>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultProgramaRadio/subsection';
          $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultProgramaRadio/subsection');
        }
      }
      elseif($this->site->getType() == "Programa Infantil" || $this->site->getType() == 5){
        if($debug) print "<br>12-1>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/maiscrianca/'.$sectionSlug;
        $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/maiscrianca/'.$sectionSlug);
      }
      elseif($this->site->getType() == "Programa TVRTB"){
        if($debug) print "<br>14-1>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/tvratimbum/programas/'.$sectionSlug;
        $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/tvratimbum/programas/'.$sectionSlug);
      }
      elseif($this->site->getType() == "Programa Simples" || $this->site->getType() == 4){

if($this->section->id == 809){
$this->assetsQuery = Doctrine_Query::create()
->select('a.*')
->from('Asset a, SectionAsset sa')
->where('sa.section_id = ?', 809)
->andWhere('sa.asset_id = a.id')
->andWhere('a.is_active = ?', 1);

$this->pager = new sfDoctrinePager('Asset', 9);
$this->pager->setQuery($this->assetsQuery);
$this->pager->setPage($request->getParameter('page', 1));
$this->pager->init();
$this->page = 1;
}

        if(is_file(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultProgramaSimples/'.$sectionSlug.'Success.php')){
          if($debug) print "<br>12-2>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultProgramaSimples/'.$sectionSlug;
          $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultProgramaSimples/'.$sectionSlug);
        }
        else{
          if($debug) print "<br>12-3>>".sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultProgramaSimples/subsection';
          $this->setTemplate(sfConfig::get('sf_app_template_dir').DIRECTORY_SEPARATOR.'sites/defaultProgramaSimples/subsection');
        }
      }
    } 

  }
  
}