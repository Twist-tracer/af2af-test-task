<div class="modal hide fade visible-desktop" id="myModal" style="z-index:999999;">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <?=t(T_POPUP_TITLE)?>
      <div class="modal-body">
        
        	    <?PHP 
					$i = 0;
					$count = 4;
			
					foreach(brands_list() as $brand ):			
						$i++;
					if ($i == 2 || $i == 4 || $i == 5 ) { 
				?>
      	<table>
          <tr>        
            <td class="casino-logo-td"><div class="casino-logo">
                <p><a target="_blank" <?=$brand->aff_link_part()?>><?=$brand->logo_image(max)?></a></p>
              </div></td>
          </tr> 
          <tr>
            <td class="span5 bonus-text-td"><p class="bonus-text"><?=$brand->speciall_offer()?></p></td>  
          </tr> 
          <tr>     
            <td style="width: 175px;" class="play-td"><p><a target="_blank" <?=$brand->aff_link_part()?> class="green-btn play"><?=t(T_PLAY_NOW)?></a></p></td>
          </tr> 
    	</table>         
          		<?PHP } endforeach; ?> 
        
      </div>
    </div>
    
<div class="modal-backdrop"  style="display: none; width:100%; height:100%; position:fixed; background:#000000; opacity: .8; filter:alpha(opacity=0.8); z-index:999998;"></div>