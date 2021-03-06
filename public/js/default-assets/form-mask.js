$(function() {
    "use strict";
    new Cleave("#inputCreditCard", {
        creditCard: !0,
        onCreditCardTypeChanged: function(e) {
            console.log(e);
            var t = $("#creditCardType").find("." + e);
            t.length ? (t.addClass("tx-primary"), t.siblings().removeClass("tx-primary")) : $("#creditCardType span").removeClass("tx-primary")
        }
    }), new Cleave("#inputPhoneNumber", { phone: !0, phoneRegionCode: "US" }), new Cleave("#inputDate", { date: !0, datePattern: ["Y", "m", "d"] }), new Cleave("#inputDate2", { date: !0, datePattern: ["m", "y"] }), new Cleave("#inputTime", { time: !0, timePattern: ["h", "m", "s"] }), new Cleave("#inputTime2", { time: !0, timePattern: ["h", "m"] }), new Cleave("#inputNumeral", { numeral: !0, numeralThousandsGroupStyle: "thousand" }), new Cleave("#inputBlocks", { blocks: [4, 3, 3, 4], uppercase: !0 }), new Cleave("#inputBlocks2", { delimiters: ["+", "+", "-"], blocks: [3, 3, 4, 2] }), new Cleave("#inputBlocks3", { prefix: "Prefix-", uppercase: !0 })
});