var Regex = {
    init: function (verifCaract, mdpValue) {
        this.verifCaract = verifCaract;
        this.mdpValue = mdpValue;
    },
    verifier: function () {
    return this.verifCaract.test(this.mdpValue);
    }
};