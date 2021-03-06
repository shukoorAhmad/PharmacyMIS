! function(t) {
    "use strict";
    var o = function() {};
    o.prototype.init = function() {
        t("#basic-colorpicker").colorpicker(), t("#hexa-colorpicker").colorpicker({ format: "auto" }), t("#component-colorpicker").colorpicker({ format: null }), t("#horizontal-colorpicker").colorpicker({ horizontal: !0 }), t("#inline-colorpicker").colorpicker({ color: "#DD0F20", inline: !0, container: !0 }), t(".clockpicker").clockpicker({ donetext: "Done" }), t("#single-input").clockpicker({ placement: "bottom", align: "left", autoclose: !0, default: "now" }), t("#check-minutes").click(function(o) { o.stopPropagation(), t("#single-input").clockpicker("show").clockpicker("toggleView", "minutes") });
        var o = { cancelClass: "btn-light", applyButtonClasses: "btn-success" };
        t('[data-toggle="date-picker"]').each(function(e, n) {
            var c = t.extend({}, o, t(n).data());
            t(n).daterangepicker(c)
        });
        var e = { startDate: moment().subtract(29, "days"), endDate: moment(), ranges: { Today: [moment(), moment()], Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")], "Last 7 Days": [moment().subtract(6, "days"), moment()], "Last 30 Days": [moment().subtract(29, "days"), moment()], "This Month": [moment().startOf("month"), moment().endOf("month")], "Last Month": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")] } };
        t('[data-toggle="date-picker-range"]').each(function(o, n) {
            var c = t.extend({}, e, t(n).data()),
                r = c.targetDisplay;
            t(n).daterangepicker(c, function(o, e) { r && t(r).html(o.format("MMMM D, YYYY") + " - " + e.format("MMMM D, YYYY")) })
        })
    }, t.FormPickers = new o, t.FormPickers.Constructor = o
}(window.jQuery), window.jQuery.FormPickers.init();