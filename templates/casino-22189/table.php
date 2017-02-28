<div class="brand-list">

  	<?PHP 
		$i = 0;
		$count = count(brands_list());
		foreach(brands_list() as $brand):
		$i++;
		
		$stars2 = array(
		0=>'bamby!',
		1=>	'<img src="'.TEMPLATE.'/img/rait-1.png" alt="rating">',
		2=>	'<img src="'.TEMPLATE.'/img/rait-1.png" alt="rating">',
		3=>	'<img src="'.TEMPLATE.'/img/rait-2.png" alt="rating">',
		4=>	'<img src="'.TEMPLATE.'/img/rait-2.png" alt="rating">',
		5=>	'<img src="'.TEMPLATE.'/img/rait-2.png" alt="rating">',
		6=>	'<img src="'.TEMPLATE.'/img/rait-2.png" alt="rating">',
		7=>	'<img src="'.TEMPLATE.'/img/rait-3.png" alt="rating">',
		8=>	'<img src="'.TEMPLATE.'/img/rait-3.png" alt="rating">',
		9=>	'<img src="'.TEMPLATE.'/img/rait-3.png" alt="rating">',
		);			
	?>
    
    			<div class="brand-item">
                	<div class="item-num"><? echo $i; ?></div>
                	<div class="item-logo" onClick="ga('send', 'event', {eventCategory: 'click',eventAction: 'logo', eventLabel: '<?=$brand->name()?>'});">
                    	<a <?=$brand->aff_link_part()?> target="_blank" rel="nofollow"><?=$brand->logo_image()?></a>                    
                    </div>
                    <div class="left_float">
                        <div class="item-name" onClick="ga('send', 'event', {eventCategory: 'click',eventAction: 'logo', eventLabel: '<?=$brand->name()?>'});">
                            <a target="_blank" <?=$brand->aff_link_part()?> class="orange"><?=$brand->name()?></a><?=$stars2[$i]?>
                        </div>
                        <div class="item-bonus">
                            <?=$brand->speciall_offer()?>
                        </div>
                    </div>
                    
                    <div class="right_float button"  onClick="ga('send', 'event', {eventCategory: 'click',eventAction: 'play', eventLabel: '<?=$brand->name()?>'});">
                    	<a target="_blank" <?=$brand->aff_link_part()?> class="green-btn"><?=t(T_PLAY_NOW)?>!</a>
                    </div>
                    <div class="right_float bonus visible-desktop">
                    	<span><?=t(T_TOTAL_BONUS)?></span>
                    	<?=$brand->total_bonus()?>
                    </div>
                    <div class="right_float payout visible-desktop">
                    	<span><?=t(T_PAYOUT)?></span>
                    	<?=$brand->payout()?>
                    </div>
                    
                    
                    
                    
                    <div class="clearfix"></div>
                </div>
					
					
	
	<?PHP endforeach; ?>
</div>
 



	

