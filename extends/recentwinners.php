<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
    <head>
	    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
    	<title>Recent Winners</title>
		<script language="javascript" type="text/javascript">
		    var affid = '';
		    var adid = '12345'; 														//	adid - in the format 'wgsaffad0'
		    var casino = 'SPC'; 														//	casino		- choice of		'SPC' 'RFC' 'CCC' (leave blank for all casinos)
		    var gametype = 'Progressive'; 										//  gametype 	- choice of 	'Video Poker', 'Progressive', 'Slots', 'Table Game'
		    var friendlytext = true; 												//	true = show friendly text, false = plain data
		    var showcasinonames = true; 										//	true = show casino names, false = don't (always shown if casino variables is blank!)
		    var url = 'http://www.spinpalace.com/index_slots2.asp'; 	// The URL to browse to.
		    var url = url + '?a=' + adid;
        </script>
        <script src="/jscript/recentwinnersScroller.js" type="text/javascript"></script>
<style type="text/css" media="screen">
html, body {
	/*border-radius:7px;
	border: 0px solid #999;
	background: url(images/bg_comments.png) repeat-x 0 0 #fff;
    behavior: url(/wp-content/themes/name/jscript/PIE.htc);*/
	margin:0;
}
.last {
	background: none repeat scroll 0 0 transparent;
	font:  13px tahoma,verdana,serif;
}
#RecentWinnersScroller{
	/*border: 0px solid #999;
    behavior: url(/wp-content/themes/name/jscript/PIE.htc);*/
}
#RecentWinnersScroller a {
	font-size:12px;
	color: #3d3d3d;
	text-decoration:none;
	font-family: tahoma, verdan, san-serif;
	margin-left:25px !important;
	overflow: hidden;
	width:100%;
	white-space: nowrap;
	display:block;
	text-align: center;
}
#RecentWinnersScroller a span {
	display:inline-block;
	font:  12px 'Tahoma';
}
#RecentWinnersScroller a div {
	height:25px;
	width:93%;
	padding-top:7px;
}
#RecentWinnersScroller a .zero {
	background: #EEEEEE;
}
#RecentWinnersScroller a .first{
   border-right: 1px solid #D8D8D8;
   /*width:31%;*/
   width:25%;
   padding-left:10px;
}
#RecentWinnersScroller a .second{
   padding-left:60px;
   border-right: 1px solid #D8D8D8;
   width:20%;
   background:url(/images/star.png) no-repeat 30px center  transparent;
}
#RecentWinnersScroller a .third{
   padding-left:57px;
}
#RecentWinnersScroller a:hover {
	color: #910b2f;
}
#RecentWinnersScroller b {
	color:#000;
	font-weight:bold;
}
</style>
    </head>

    <body>
    <div align="left" class="last"><b></b></div>
		<div id="RecentWinnersScroller"  class="recentWinnersLayer"
		style="position:absolute; left:0px; top:25px; float: left; width: 100%; height: 192px; z-index:1; padding: 5px 5px 8px 5px;"></div>
	</body>
</html>
