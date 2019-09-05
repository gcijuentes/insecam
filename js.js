document.write("<li><a aria-label='Previous' href='" + url + (currentpg - 1) + "'><span aria-hidden='true'>&laquo;</span></a></li>");
if (currentpg > 10)

function imgreplace(imgid, URL) {
    dstimage = document.getElementById(imgid);
    console.log('sereeeeeeeeeeeeeeeeeeeeeee');
    //dstimage.src = URL;
}

function imageloaded(img) {
    try {
        console.log("typeof " + typeof img.naturalWidth);
        console.log("width " + img.naturalWidth);
        console.log(img.complete);
        if (typeof img.naturalWidth != "number" || img.naturalWidth < 100) {
            return false;
        }
        if (!img.complete)
            return false;
    } catch (e) {
        return false;
    }
    return true;
}

function refreshimages() {
    for (i = 0; i < imageurls.length; i++) {
        try {
            if (imageloaded(newimages[i]) || c == 0) {
                console.log("Starting load image " + i);
                newimages[i] = new Image();
                var url = imageurls[i];
                var img = document.getElementById("image" + i);
                console.log('imageeeeeeeeeeeeeeeeeeee');
                console.log(img);
                var tempurl;
                tempurl = url.replace("CHANNEL", ch.toString());
                tempurl = tempurl.replace("COUNTER", c.toString());
                newimages[i].src = tempurl;
                img.src = tempurl;
            }
        } catch (e) {
            alert(e);
            a = 0;
        }
    }
    c = parseInt(new Date().getTime() / 1000);

}

function pagenavigator(url, totalpg, currentpg) {
    if (currentpg > 1)
        document.write("<li><a aria-label='Previous' href='" + url + (currentpg - 1) + "'><span aria-hidden='true'>&laquo;</span></a></li>");
    if (currentpg > 10)
        document.write("<li><a href='" + url + "1" + "' rel='first'>1 </a></li><li class='disabled'><a href='#'>...</a></li>");
    for (p = 1; p <= totalpg; p++)
        if (p == currentpg) {
            document.write("<li class='active'><a href='#'>" + p + "</a></li>");
        }
    else
    if ((currentpg > p - 10) && (currentpg < p + 10)) {
        document.write("<li><a href='" + url + p + "'>" + p + "</a></li>");
    }
    if (currentpg < totalpg - 10)
        document.write("<li class='disabled'><a href='#'>...</a></li><li><a href='" + url + totalpg + "' rel='last'>" + totalpg + "</a></li>");
    if (currentpg < totalpg)
        document.write("<li><a aria-label='Next' href='" + url + (currentpg + 1) + "'><span aria-hidden='true'>&raquo;</span></a></li>");
}

function getlangattr() {
    return document.getElementById("langattr").value;
}

function jsoncountries() {
    var countriesdiv = document.getElementById("countriesul");
    var lang = getlangattr();
    if (http_countriesrequest.readyState == 4) {
        if (http_countriesrequest.status == 200) {
            var list = JSON.parse(http_countriesrequest.responseText);
            countries = list.countries;
            var ccodes = [];
            var i = 0;
            for (var c in countries)
                ccodes[i++] = c;
            ccodes = ccodes.sort(function(a, b) {
                return countries[b].count - countries[a].count;
            });
            if (countries) {
                for (var idx = 0; idx < i; idx++) {
                    c = ccodes[idx];
                    var htmlline = "<li id=" + idx + "_cbtn><a href='/" + lang + "/bycountry/" + c + "/' title='Online cameras in " + countries[c].country + "'>" + countries[c].country + "(" + countries[c].count + ")</a>";
                    var countrieslistcontent = document.createElement('li');
                    countrieslistcontent.innerHTML = htmlline;
                    countriesdiv.appendChild(countrieslistcontent.firstChild);
                }
            } else {
                document.write("Can't parse countries");
            }
        } else {
            alert("Can't get countries.");
        }
        http_countriesrequest = null;
    }
}

function jsontags() {
    var tagsdiv = document.getElementById("tagsul");
    var lang = getlangattr();
    if (http_tagsrequest.readyState == 4) {
        if (http_tagsrequest.status == 200) {
            var list = JSON.parse(http_tagsrequest.responseText);
            tags = list.tags;
            var tagnames = [];
            var i = 0;
            for (var c in tags)
                tagnames[i++] = c;
            tagnames = tagnames.sort(function(a, b) {
                return tags[b].name - tags[a].name;
            });
            if (tags) {
                for (var idx = 0; idx < i; idx++) {
                    c = tagnames[idx];
                    var htmlline = "<li id=" + idx + "_cbtn><a href='/" + lang + "/bytag/" + c + "/' title='Online cameras in " + c + "'>" + tags[c] + "</a>";
                    var tagslistcontent = document.createElement('li');
                    tagslistcontent.innerHTML = htmlline;
                    tagsdiv.appendChild(tagslistcontent.firstChild);
                }
            } else {
                document.write("Can't parse tags");
            }
        } else {
            alert("Can't get tags.");
        }
        http_tagsrequest = null;
    }
}

function setlanglinkpath(href, lang) {
    var ahref = document.getElementById(href);
    var currentpath = window.location.pathname;
    currentpath = currentpath.replace(/\/(\w+)\//, '/' + lang + '/');
    ahref.href = currentpath;
}