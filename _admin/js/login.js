/* © LeoCRAFT Digital, "Catana" https://catana.leocraft.digital */
document.addEventListener('DOMContentLoaded', function(){
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
    enteradmin.onclick = function() {
        var enter = {};
        enter['login'] = document.querySelector('#login form input[name="login"]').value;
        enter['pass'] = document.querySelector('#login form input[name="pass"]').value;

        $load("POST","_admin/login.php",enter).then(function(req) {
            // console.log(req);
            if(req == 'enter') {
                var loc = document.querySelector('base').getAttribute('href');
                window.location.replace(loc);
            }
            else {
                document.querySelector('#login').classList.add('wrong');
                setTimeout(() => {
                    document.querySelector('#login').classList.remove('wrong');
                }, 1000);
            }
        }, function(error) {
            console.log(error);
        });
    }
});