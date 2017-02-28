function NewsScroller () {
	if (window.NewsScrollerInstance != null) {
		window.alert("Only one NewsScroller control is allowed on a page.");
		return;
	}
	window.NewsScrollerInstance = this;
	this.LoadXML = NewsScroller_LoadXML;
	this.AddNewsItem = NewsScroller_AddNewsItem;
	this.Clear = NewsScroller_Clear;
	this.StartScrolling = NewsScroller_StartScrolling;
	this.StopScrolling = NewsScroller_StopScrolling;
	this.Render = NewsScroller_Render;

	// public properties
	this.className = "";
	this.itemNormalClassName = "";

	this.scrollRate = 25;
	this.scrollStep = 1;
	this.scrollPause = 2000;

	// internal use
	this.RenderChildren = NewsScroller_RenderChildren;

	this.renderedControl = "";
	this.itemsText = new Array();
	this.itemsLink = new Array();
	this.itemCount = 0;

	this.scrollEnabled = false;
}

function NewsScroller_LoadXML (sXmlID) {
	this.Clear();
	var xDoc = sXmlID;
	var xItems = xDoc.selectNodes("/Items/Item");
	for (var iNode = 0; iNode < xItems.length; iNode++) {
		var xItem = xItems[iNode];
		var xText = xItem.selectSingleNode("Text");
		var xLink = xItem.selectSingleNode("Link");
		this.AddNewsItem(xText.text, xLink.text);
	}
	var elmControl = document.getElementById(this.renderedControl);
	this.RenderChildren(this.renderedControl);
}

function NewsScroller_AddNewsItem (strText, strLink) {
    var arrText = [];
	//strText = replace(strText, '[', '<');
    //strText = replace(strText, ']', '>');
    arrText = strText.split('[br]');
    var cls  = ((this.itemCount%2) == 0) ? ' class="zero"' : '';
    strLink = '';
    //strText = '<b>AU $' + arrText[3] + '</b> &nbsp; ' + arrText[0];
    strText = '<div' + cls + '>' + '<span  class="first">' + arrText[0] + '</span><span class="second">$ ' + arrText[3] + '</span><span class="third">' + arrText[2] + ' ' + arrText[1] + '</span></div>';

    //alert(strText);

	this.itemsText[this.itemCount] = strText;
	this.itemsLink[this.itemCount] = strLink;
	this.itemCount++;
}

function NewsScroller_Clear () {
	this.StopScrolling ();
	var elmControl = document.getElementById(this.renderedControl);
	while (elmControl.childNodes.length > 0)
		elmControl.removeChild(elmControl.childNodes[0]);
	this.itemsText = new Array();
	this.itemsLink = new Array();
	this.itemCount = 0;
}

function NewsScroller_StartScrolling () {
	if (this.itemCount > 0) {
		var sControlName = this.renderedControl;
		if (sControlName == null) {
			window.alert ("You must render a control before you can start scrolling it.");
			return;
		}
		var elmControl = document.getElementById(sControlName);
		var elmItem0 = document.getElementById("floatingNews0");
		if (this.itemCount > 1) {
			var elmItem1 = document.getElementById(sControlName + "1");
			this.cySeparator = (elmItem1.offsetTop - elmItem0.offsetTop) - elmItem0.offsetHeight;
		} else {
			this.cySeparator = 0;
		}

		if (this.ScrollTimerID == null)
			this.ScrollTimerID = window.setInterval(NewsScroller_ScrollNews, this.scrollRate);
	}
}

function NewsScroller_StopScrolling () {
	window.clearInterval(this.ScrollTimerID);
	this.ScrollTimerID = null;
}

function NewsScroller_Render(sControlID) {
	if (sControlID.length == 0) {
		window.alert("You must provide a unique ID for the rendered control.");
		return;
	}
	var elmControl = document.getElementById(sControlID);
	if (elmControl != null) {
		window.alert("A NewsScroller with this ID has already been rendered. Please use a unique ID.");
		return;
	}
	this.renderedControl = sControlID;

	// <DIV>

	var controlPane = document.getElementById("RecentWinnersScroller");
	controlPane.innerHTML = '<div id="' + sControlID + '" class="' + this.className + '" style="position:relative; width:100%; height:100%;"></div>';

	/*
	document.write("<div");
	document.write(" id=\"" + sControlID + "\"");
	document.write(" class=\"" + this.className + "\"");
	document.write(" style=\"position: relative; width: 100%; height: 100%; \"");
	document.write(">");

	// </DIV>
	document.write("</div>");
	*/

	this.RenderChildren(sControlID);

	var dtNow = new Date();
	var dtResume = new Date(dtNow.getFullYear(), dtNow.getMonth(), dtNow.getDate(), dtNow.getHours(), dtNow.getMinutes(), dtNow.getSeconds(), this.scrollPause);
	elmControl = document.getElementById(sControlID);
	elmControl.ResumeDateTime = dtResume;
}

// Supporting functions
function NewsScroller_RenderChildren() {
	var sControlID = this.renderedControl;
	elmControl = document.getElementById(sControlID);

	// <DIV>
	elmDiv = document.createElement("div");
	elmDiv.style.position = "relative";
	elmDiv.style.left = "0px";
	elmDiv.style.top = "0px";
	elmDiv.style.width = "100%";
	elmDiv.style.height = "100%";
	elmDiv.style.overflow = "hidden";
	elmControl.appendChild(elmDiv);

	for (var nItem = 0; nItem < this.itemCount; nItem++) {
		var sItemName = sControlID + nItem.toString();

		var elmP = document.createElement("div");
		elmP.id = sItemName;
		elmP.style.position = "relative";
		elmP.style.top = "0px";
		elmP.style.width = "100%";
		elmP.style.paddingTop = "0px";
		//elmP.style.paddingBottom = "10px";
		elmP.className = this.itemNormalClassName;
		elmDiv.appendChild(elmP);

		var elmA = document.createElement("a");
		elmA.className = this.itemNormalClassName;
		//elmA.href = this.itemsLink[nItem];
		elmA.innerHTML = this.itemsText[nItem];
		elmP.appendChild(elmA);
	}
}

function NewsScroller_ScrollNews() {
	var ns = window.NewsScrollerInstance;
	var sControlName = ns.renderedControl;
	if (sControlName.length == 0) {
		//window.alert ("Do not call ScrollNews directly. Use the Start method of the NewsScroller object.");
		//window.status = 'Do not call ScrollNews directly. Use the Start method of the NewsScroller object.';
		return;
	}

	var elmControl = document.getElementById(sControlName);
	if (new Date() >= elmControl.ResumeDateTime) {
		// see whether any item is about to reach the top,
		for (var nItem = 0; nItem < ns.itemCount; nItem++) {
			var sItemName = sControlName + nItem.toString();
			var elmItem = document.getElementById(sItemName);
			var elTop = Number(String(elmItem.style.top).substr(0, String(elmItem.style.top).length - 2))
			elmItem.style.top = (elTop - ns.scrollStep) + "px";

			if ((elmItem.offsetTop > 0) && ((elmItem.offsetTop - ns.scrollStep) <= 0)) {
				// the top of this item has reached the top of the control, pause for # seconds
				var dtNow = new Date();
				var dtResume = new Date(dtNow.getFullYear(), dtNow.getMonth(), dtNow.getDate(), dtNow.getHours(), dtNow.getMinutes(), dtNow.getSeconds(), ns.scrollPause);
				elmControl.ResumeDateTime = dtResume;
			}
		}

		//check if the item at the top should be put to the bottom
		for (var nItem = 0; nItem < ns.itemCount; nItem++) {
			var sItemName = sControlName + nItem.toString();
			var elmItem = document.getElementById(sItemName);
			if (elmItem.offsetTop < (0 - elmItem.offsetHeight)){
				var elmLast = document.getElementById(sControlName + (ns.itemCount - 1));
				elmItem.style.top = (elmLast.offsetTop + elmLast.offsetHeight) + "px";
			}
		}

	}
}

function replace(string,text,by) {
    var strLength = string.length, txtLength = text.length;
    if ((strLength == 0) || (txtLength == 0)) return string;

    var i = string.indexOf(text);
    if ((!i) && (text != string.substring(0,txtLength))) return string;
    if (i == -1) return string;

    var newstr = string.substring(0,i) + by;

    if (i+txtLength < strLength)
        newstr += replace(string.substring(i+txtLength,strLength),text,by);

    return newstr;
}

//############################################################

function prepXML(s){
		var rtn = replace(s, "\n", "");
		rtn = replace(rtn, "\r", "");
		rtn = replace(rtn, "\t", "");
		return rtn;
	}

	function loadXMLFeed(s){

		var recentWinners;

		if (window.DOMParser){
			parser = new DOMParser();
			recentWinners = parser.parseFromString(prepXML(s),"text/xml");
		} else {
			recentWinners = new ActiveXObject("Microsoft.XMLDOM");
			recentWinners.async="false";
			recentWinners.loadXML(prepXML(s));
		}

		var xmlText
		var xmlURL
		var node = recentWinners.getElementsByTagName("text");

		for (i=0;i< node.length;i++) {
			xmlText = recentWinners.getElementsByTagName("text")[i].childNodes[0].nodeValue;
			xmlURL	= recentWinners.getElementsByTagName("link")[i].childNodes[0].nodeValue;

			xmlText	= replace(xmlText, 'USD', '$')
			xmlText	= replace(xmlText, 'GBP', '&pound;')
			xmlText	= replace(xmlText, 'EUR', '&#8364;')

			if (adid.length != 0) xmlURL += '?a=' + adid + '&'
			if (affid.length != 0) xmlURL += 's=' + affid + '&'

			recentWinnersScroller.AddNewsItem (xmlText, xmlURL);
		}

		recentWinnersScroller.Render("floatingNews");
		recentWinnersScroller.StartScrolling();
	}

	//############################################################
	var objHTTP;

	try {
		objHTTP = new ActiveXObject("Msxml2.XMLHTTP");
	} catch (e) {
		try {
			objHTTP = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (E) {
			objHTTP = false;
		}
	}

	if (!objHTTP && typeof XMLHttpRequest!='undefined') {
		try { objHTTP = new XMLHttpRequest(); } catch (e) { objHTTP = false; }
	}

	if (!objHTTP && window.createRequest) {
		try { objHTTP = window.createRequest(); } catch (e) { objHTTP = false; }
	}

	var recentWinnersScroller = new NewsScroller("main");

	//var XMLFeedURL	= 'recentwinnersXML.asp?'
	var XMLFeedURL	= 'wp-feedxml.php'
	//if (casino.length != 0) XMLFeedURL += 'casino=' + casino + '&'
	//if (gametype.length != 0) XMLFeedURL += 'gametype=' + gametype + '&'
	//if (friendlytext.length != 0 && friendlytext == true) XMLFeedURL += 'friendly=true&'
	//if (showcasinonames.length != 0 && showcasinonames == true) XMLFeedURL += 'showcasinonames=true&'

	objHTTP.open('GET', XMLFeedURL, true);
	objHTTP.onreadystatechange=function() {
		if (objHTTP.readyState == 4) loadXMLFeed(objHTTP.responseText)
	}
	objHTTP.send();

