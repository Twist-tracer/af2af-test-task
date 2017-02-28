function getBrowserInfo() {
    var t, v = undefined;

    if (navigator.userAgent.indexOf('Safari')>=0){
        t='Safari';
    }else if (navigator.userAgent.indexOf('Chrome')>=0){
        t='Chrome';
    }else if (window.opera){
        t = 'Opera';
    }else if (document.all) {
        t = 'IE';
    } else if (navigator.appName){
        t = 'Netscape';
    }

    return {type:t, version:v};
}

function bookmark(a) {
    var url = window.document.location;
    var title = window.document.title;
    var b = getBrowserInfo();

    if (b.type == 'IE') {
        window.external.AddFavorite(url, title);

    } else if (b.type == 'Opera') {
        a.href = url;
        a.rel = "sidebar";
        a.title = url + ',' + title;
        return true;

    } else if (b.type == "Netscape") {
        window.sidebar.addPanel(title, url, "");

    } else {
        alert('Press CTRL-D, to add the page to your bookmarks.');
    }
    return false;
}