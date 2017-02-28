<?PHP
//echo '/root/articles.php';
	include_once 'global.php';

    $text       = article($_GET['t']);

	include_once TEMPLATE_DIR.'/article.php';