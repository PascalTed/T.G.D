var AjaxPost = {
    init: function(url, dataSend, callback) {
    this.url = url;
    this.callback = callback;
    this.req = new XMLHttpRequest();
    this.dataSend = dataSend;
    },
    executer: function () {       
        thatUrl = this.url;
        thatCallback = this.callback;
        thatReq = this.req;
        thatDataSend = this.dataSend;
        this.req.open("POST", this.url);
        this.req.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
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
        this.req.send(thatDataSend);
    }
};