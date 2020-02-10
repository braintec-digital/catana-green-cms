/* © LeoCRAFT Digital, Slite JS for "Catana" https://catana.leocraft.digital */
function $load(type,url,params) {
    return new Promise(function(succeed, fail) {
        var request = new XMLHttpRequest();
        request.open(type, url, true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        request.addEventListener("load", function() {
            if(request.status < 400) succeed(request.responseText);
            else fail(new Error("Request failed: " + request.statusText));
        });
        request.addEventListener("error", function() {
            fail(new Error("Network error"));
        });
        if(typeof(params) == 'object') {
            params = JSON.stringify(params);
            params = params.replace('{','');
            params = params.replace('}','');
            params = params.replace(/"/g,'');
            params = params.replace(/:/g,'=');
            params = params.replace(/,/g,'&');
        }
        request.send(params);
    });
}