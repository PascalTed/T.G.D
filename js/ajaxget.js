var AjaxGet = {
    init: function(url, callback) {
    this.url = url;
    this.callback = callback;
    this.req = new XMLHttpRequest();
    },
    executer: function () {       
        thatUrl = this.url;
        thatCallback = this.callback;
        thatReq = this.req;
        this.req.open("GET", this.url);
        this.req.addEventListener("load", function () {
            if (thatReq.status >= 200 && thatReq.status < 400) {
                thatCallback(thatReq.responseText);
            } else {
                console.error(thatReq.status + " " + thatReq.statusText + " " + thatUrl);
            }
        });
        this.req.addEventListener("error", function () {
            console.error("Erreur réseau avec l'URL " + thatUrl);
        });
        this.req.send(null);
    }
};