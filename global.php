<?PHP
session_start();
define('GEO_ENABLE', detect_geo_enable('true'));

define('DEFAULT_LANG', 'ca');
define('LNG', detect_lang(DEFAULT_LANG));
define('TEMPLATE_NAME', detect_template('casino-22189'));
define('TEMPLATE', '/templates/' . detect_template('casino-22189'));
define('TEMPLATE_DIR', dirname(__FILE__).'/'.TEMPLATE);
define('TEMPLATE_CSS', 'style.css');
define('MOB_DIR', 'mobile');
define('MOBILE_ENABLE', 'false');

$payout = array(0=>'bamby!',1=>'97.95%',2=>'97.91%',3=>'97.89%',4=>'97.85%',5=>'97.82%',6=>'97.75%',7=>'97.72%',8=>'97.67%',9=>'97.62%');
global $payout;
$stars = array(
0=>'bamby!',
1=>	'<i></i><i></i><i></i><i></i><i></i>',
2=>	'<i></i><i></i><i></i><i></i><i></i>',
3=>	'<i></i><i></i><i></i><i></i><i class="half"></i>',
4=>	'<i></i><i></i><i></i><i></i><i class="half"></i>',
5=>	'<i></i><i></i><i></i><i></i>',
6=>	'<i></i><i></i><i></i><i></i>',
7=>	'<i></i><i></i><i></i><i class="half"></i>',
8=>	'<i></i><i></i><i></i><i class="half"></i>',
9=>	'<i></i><i></i><i></i><i class="half"></i>',
);
$stars1 = array(
0=>'bamby!',
1=>	'stars-5',
2=>	'stars-5',
3=>	'stars-4-5',
4=>	'stars-4-5',
5=>	'stars-4',
6=>	'stars-4',
7=>	'stars-3-5',
8=>	'stars-3-5',
9=>	'stars-3-5',
);
global $stars;

require_once 'CasinoItem.php';

global $LNG_MAIN;
global $BRANDS;

$LNG_MAIN   = include 'localizations/'.LNG.'/main.php';
$BRANDS     = include 'localizations/'.LNG.'/brands.php';


/**
 * Return translate for string
 *
 * @param       string $key
 *
 * @return      HTML
 */
function t($key)
{
    global $LNG_MAIN;

    if(!empty($LNG_MAIN[$key]))
    {
        //return htmlspecialchars($LNG_MAIN[$key]);
        return $LNG_MAIN[$key];
    }

    return $key;
}

/**
 * Return label
 *
 * @param       string $key
 *
 * @return      HTML
 */
function l($key)
{
    global $LNG_MAIN;

    if(!empty($LNG_MAIN[$key]))
    {
        return $LNG_MAIN[$key];
    }

    return $key;
}

/**
 * Returns HTML article
 *
 * @param   string  $name
 * @return
 */
function article($name)
{
	$file = './localizations/'.LNG.'/'.$name;

    if(is_file($file.'.php'))
    {
        ob_start();

        include $file.'.php';

        $res = ob_get_contents();
		ob_end_clean();
		
		return $res;
    }
    elseif(is_file($file.'.htm'))
    {
        return file_get_contents($file.'.htm');
    }
    else
    {
        return '';
    }
}

/**
 * Returns brand list
 *
 * @return array
 */
function brands_list()
{
    global $BRANDS;
	global $IS_BRANDS_SORT;

	if(!is_array($BRANDS))
	{
		return array();
	}

	if(empty($IS_BRANDS_SORT))
	{
		brands_remove_unused();
		uasort($BRANDS, 'brands_sort');
		$IS_BRANDS_SORT = true;
	}

    return $BRANDS;
}

function brands_sort(CasinoItem $a, CasinoItem $b)
{
	if($a->order() == $b->order())
	{
        return 0;
    }
    return ($a->order() < $b->order()) ? -1 : 1;
}


function brands_list_mob()
{
    global $BRANDS;
	global $IS_brands_sort_mob;

	if(!is_array($BRANDS))
	{
		return array();
	}

	if(empty($IS_brands_sort_mob))
	{
		brands_remove_unused();
		uasort($BRANDS, 'brands_sort_mob');
		$IS_brands_sort_mob = true;
	}

    return $BRANDS;
}

function brands_sort_mob(CasinoItem $a, CasinoItem $b)
{
	if($a->order_mob() == $b->order_mob())
	{
        return 0;
    }
    return ($a->order_mob() < $b->order_mob()) ? -1 : 1;
}

function brands_remove_unused()
{
	global $BRANDS;
	$list 	= array();

	foreach($BRANDS as $key => $brand)
	{
		if($brand->order() !== 0)
		{
			$list[$key] = $brand;
		}
	}

	$BRANDS = $list;
}

/**
 * Returns Brand object or null
 *
 * @param       string      $sysname
 *
 * @return      CasinoItem|null
 */
function get_brand($sysname)
{
    global $BRANDS;

	$sysname = strtolower($sysname);

    if(isset($BRANDS[$sysname]))
    {
        return $BRANDS[$sysname];
    }

    throw new Exception("Undefined brand sysname = '$sysname'");
}

function detect_lang($lang = DEFAULT_LANG){

	if (isset($_SESSION['lang']))
		{
		$lang = $_SESSION['lang'];
		} else

	if (GEO_ENABLE == 'true')
		{
		if (isset ($_SERVER['GEOIP_COUNTRY_CODE']))
			{
				$lang = strtolower ($_SERVER['GEOIP_COUNTRY_CODE']);
				
				if($lang == 'mx' || $lang == 'co' || $lang == 'ar' || $lang == 'pe' || $lang == 've' || $lang == 'cl' || $lang == 'gt' || $lang == 'ec' || $lang == 'cu' || $lang == 'ht' || $lang == 'bo' || $lang == 'do' || $lang == 'hn' || $lang == 'py' || $lang == 'ni' || $lang == 'sv' || $lang == 'cr' || $lang == 'pa' || $lang == 'uy' ) {
					$lang = 'lat';
				}
				
				if($lang == 'kz' || $lang == 'by' || $lang == 'ge' || $lang == 'md' || $lang == 'am' || $lang == 'kg' || $lang == 'az' || $lang == 'ua' || $lang == 'uz') {
					$lang = 'ru';
				}
				
				if($lang == 'ca') {
					if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
						$testlang = strtolower ($_SERVER['HTTP_ACCEPT_LANGUAGE']);
						
						if(strpos("$testlang", "fr-ca") !== false || strpos("$testlang", "fr") !== false ) { 
							$lang = 'fr-ca';
						}
					}
				}
				if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) { 
					$testlang = strtolower ($_SERVER['HTTP_ACCEPT_LANGUAGE']);
					if(strpos("$testlang", "ru") !== false) { 
						$lang = 'ru';
					}
				}

			}
		}
	$lang = isset($_GET['lang']) ? $_GET['lang'] : $lang;

	if(!preg_match('|[A-Z]+|i', $lang))
	{
		//throw new Exception('Invalid language code = '.$lang);
		return DEFAULT_LANG;
	}

	$dir = dirname(__FILE__).'/localizations/'.$lang;

	if(!is_dir($dir))
	{
		//throw new Exception("Language not exists ($dir)");
		return DEFAULT_LANG;
	}

	if(!is_file($dir.'/main.php'))
	{
		//throw new Exception("Language failed: main.php not found in $dir");
		return DEFAULT_LANG;
	}
	if(!is_file($dir.'/brands.php'))
	{
		//throw new Exception("Language failed: brands.php not found in $dir");
		return DEFAULT_LANG;
	}
	$_SESSION['lang'] = $lang;
	return $lang;
}

function detect_template($template = 'topcasino')
{
	$template = isset($_GET['template']) ? $_GET['template'] : $template;

	if(!preg_match('|[A-Z,0-9]+|i', $template))
	{
		throw new Exception('Invalid templateuage code = '.$template);
	}

	$dir = dirname(__FILE__).'/templates/'.$template;

	if(!is_dir($dir))
	{
		throw new Exception("templateuage not exists ($dir)");
	}
/*
	if(!is_file($dir.'/main.php'))
	{
		throw new Exception("templateuage failed: main.php not found in $dir");
	}
	if(!is_file($dir.'/brands.php'))
	{
		throw new Exception("templateuage failed: brands.php not found in $dir");
	}
*/
	return $template;
}

function detect_geo_enable($geo_enable = 'false')
{
	
	if (!isset ($_SERVER['GEOIP_COUNTRY_CODE']))
		{
		$geo_enable = 'false';
		}
	$geo_enable = isset($_GET['ge']) ? $_GET['ge'] : $geo_enable;
	return $geo_enable;

}

function word_wrap_annotation($font_size, $text, $font, $maxWidth = 1200)
{
    $words = explode(' ', $text);
    $lines = array();
    $i = 0;
    $lineHeight = 0;
    while($i < count($words) )
    {
        $currentLine = $words[$i];
        if($i+1 >= count($words))
        {
            $lines[] = $currentLine;
            break;
        }
        //Check to see if we can add another word to this line
        $metrics = imagettfbbox($font_size, 0, $font, $currentLine . ' ' . $words[$i+1]);
        $metrics = array('textWidth' => $metrics[2] - $metrics[0], 'textHeight' => abs($metrics[7] - $metrics[1]));

        while($metrics['textWidth'] <= $maxWidth)
        {
            //If so, do it and keep doing it!
            $currentLine .= ' ' . $words[++$i];
            if($i+1 >= count($words))
                break;
            $metrics = imagettfbbox($font_size, 0, $font, $currentLine . ' ' . $words[$i+1]);
            $metrics = array('textWidth' => $metrics[2] - $metrics[0], 'textHeight' => abs($metrics[7] - $metrics[1]));
        }
        //We can't add the next word to this line, so loop to the next line
        $lines[] = $currentLine;
        $i++;
        //Finally, update line height
        if($metrics['textHeight'] > $lineHeight)
            $lineHeight = $metrics['textHeight'];
    }

    $metrics = imagettfbbox($font_size, $font_size, $font, implode("\n", $lines));

    return array($lines, abs($metrics[7] - $metrics[1]));
}

/**
 * Generate image for text
 *
 * @param string $text
 * @param int $width
 * @param int $height
 */
function gen_text_image($text, $width = 1200, $height = 120)
{
    $font_file  = './arial.ttf';
 //   $font_file  = './albr56w.ttf';
 //  $font_file  = './GOST_B.TTF';
 //  $font_file  = './times.ttf';
    $font_size  = 12;
if(isset($_GET['wit']))
	{
	$width = $_GET['wit'];
	}
    list($lines, $lineHeight) = word_wrap_annotation($font_size, $text, $font_file);

    $img        = imagecreatetruecolor($width, $lineHeight);
    //imagealphablending($img, true);
    imagesavealpha($img, true);

    $color      = imagecolorallocatealpha($img,0x00,0x00,0x00,127);
   // $color      = imagecolorallocatealpha($img,0x35,0x32,0x39,50);

    imagefill($img, 0, 0, $color);

    $black      = imagecolorallocate($img, 0x00, 0x00, 0x00);
    $black      = imagecolorallocate($img, 0xff, 0xff, 0xff);
  //  $black      = imagecolorallocate($img, 0x00, 0xff, 0xff);

    $text       = implode("\n", $lines);
    imagefttext($img, $font_size, 0, 0, $font_size, $black, $font_file, $text);

    // Output image to the browser
    header('Content-Type: image/png');

    imagepng($img);
    imagedestroy($img);
}


// code for mobile auto detect


if(isset($_GET['image']))
{
//echo "LNG $_GET['image']" . LNG . "<br />";
    gen_text_image(strip_tags(article($_GET['image'])));

    exit();
}

function get_title()
{
    global $SITE_TITLE;

    if(!empty($SITE_TITLE))
    {
        return $SITE_TITLE;
    }

    return t(T_TITLE);
}

function set_title($title)
{
    global $SITE_TITLE;

    $SITE_TITLE = $title;
}

function get_keywords()
{
    global $SITE_KEYWORDS;

    if(!empty($SITE_KEYWORDS))
    {
        return $SITE_KEYWORDS;
    }

    return t(T_KEYWORDS);
}

function set_keywords($keywords)
{
    global $SITE_KEYWORDS;

    $SITE_KEYWORDS = $keywords;
}

function get_dpn()
{
    global $SITE_DPN;

    if(!empty($SITE_DPN))
    {
        return $SITE_DPN;
    }

    return t(T_DPN);
}

function set_dpn($dpn)
{
    global $SITE_DPN;

    $SITE_DPN = $dpn;
}

//echo '==========================';
//print_r($_SERVER);
//exit();


//if(empty($_SERVER['HTTP_REFERER']))
//{
    //unset($_SESSION['IS_MOBILE_REDIRECT']);
//}

if (MOBILE_ENABLE == 'true')
	{
		if(empty($_SESSION['IS_MOBILE_REDIRECT']))
			{
				include_once 'Mobile_Detect.php';
				$detect = new Mobile_Detect();
				if ($detect->isMobile())
					{
						$_SESSION['IS_MOBILE_REDIRECT'] = true;
						header('Location: http://'.$_SERVER['HTTP_HOST'].'/'.MOB_DIR.'/index.php');
						exit();
					}
				else
					{
						$_SESSION['IS_MOBILE_REDIRECT'] = 'no';
					}
			}
	}
