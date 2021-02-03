"use strict";
var KTWizard4 = (function () {
    var t,
        e,
        a = function (t, a = 0) {
            KTApp.block("body", { overlayColor: "#000000", state: "success", message: $("#message_loading").val() }),
                $.ajax(base_url_admin + "/home/wizard/" + t + "?period=" + a, {
                    method: "GET",
                    success: function (a) {
                        if ((KTApp.unblock("body"), a.success)) {
                            if (4 == t) {
                                var n = a.tab;
                                " : 01-01" != n.title &&
                                    ($(".step-" + t)
                                        .find(".wizard-desc")
                                        .text(n.title),
                                    $(".step-" + t)
                                        .find(".wizard-number")
                                        .text(n.number),
                                    $(".step-" + t)
                                        .find(".wizard-total")
                                        .text(n.total),
                                    e.goTo(4),
                                    KTUtil.scrollTop());
                            }
                            $(".wizard-step-" + t).html(a.html), o(a.categories, a.values, a.profit, a.orders, a.step, a.width, a.bar);
                        }
                    },
                });
        },
        o = function (t = [], e = [], profit = [], a = [], o = 1, n = 1, r = [!1, 400]) {
            var s = document.getElementById("wedget-chart-step-" + o);
            if (s) {
                var i = {
                    series: [
                        { name: "Doanh thu", type: "bar", stacked: !1, height: r[1], data: e },
                        { name: "Lợi nhuận", type: "bar", stacked: !1, data: profit },
                    ],
                    chart: { height: 350, toolbar: { show: !1 } },
                    plotOptions: { bar: { horizontal: r[0], columnWidth: [n], endingShape: "rounded" } },
                    legend: { show: !1 },
                    dataLabels: { enabled: !1 },
                    stroke: { curve: "smooth", show: !0, width: 2, colors: ["transparent"] },
                    xaxis: { categories: t, axisBorder: { show: !0 }, axisTicks: { show: !0 }, labels: { style: { colors: KTApp.getSettings().colors.gray["gray-500"], fontSize: "12px", fontFamily: KTApp.getSettings()["font-family"] } } },
                    yaxis: { labels: { style: { colors: KTApp.getSettings().colors.gray["gray-500"], fontSize: "12px", fontFamily: KTApp.getSettings()["font-family"] } } },
                    fill: { opacity: 1 },
                    states: { normal: { filter: { type: "none", value: 0 } }, hover: { filter: { type: "none", value: 0 } }, active: { allowMultipleDataPointsSelection: !1, filter: { type: "none", value: 0 } } },
                    tooltip: {
                        style: { fontSize: "12px", fontFamily: KTApp.getSettings()["font-family"] },
                        y: {
                            formatter: function (t, e) {
                                var o = e.dataPointIndex,
                                    n = a[o];
                                return t.toLocaleString('vi', {style : 'currency', currency : 'VND'});
                            },
                        },
                    },
                    colors: [KTApp.getSettings().colors.theme.base.primary, KTApp.getSettings().colors.gray["gray-300"]],
                    grid: { borderColor: KTApp.getSettings().colors.gray["gray-200"], strokeDashArray: 4, yaxis: { lines: { show: !0 } } },
                };
                new ApexCharts(s, i).render();
            }
        },
        n = function (t = 1) {
            KTApp.block("body", { overlayColor: "#000000", state: "success", message: $("#message_loading").val() }),
                $.ajax(base_url_admin + "/home/log?page=" + t, {
                    method: "GET",
                    success: function (e) {
                        if ((KTApp.unblock("body"), e.success)) {
                            $("#timeline_logs").append(e.html);
                            var a = parseInt(e.lastPage),
                                o = $(".btn_load_mores");
                            o.find("span").text(e.msgPage), t < a ? o.attr("rel", t) : o.remove();
                        }
                    },
                });
        };
    return {
        init: function () {
            (t = KTUtil.getById("kt_wizard_v4")),
                (e = new KTWizard(t, { startStep: 1, clickableSteps: !0 })),
                a(1),
                e.on("change", function (t) {
                    var e = t.getStep();
                    4 != e && 0 == $(".wizard-step-" + e).find("#wedget-chart-step-" + e).length && (a(e), KTUtil.scrollTop());
                }),
                (function (t) {
                    moment().subtract(29, "days"), moment();
                    $(t).daterangepicker(
                        {
                            buttonClasses: " btn",
                            applyClass: "btn-primary",
                            cancelClass: "btn-secondary",
                            locale: { customRangeLabel: "Tuỳ chọn", cancelLabel: "Huỷ", applyLabel: "Chọn" },
                            ranges: {
                                "Hôm qua": [moment().subtract(1, "days"), moment().subtract(1, "days")],
                                "Hôm kia": [moment().subtract(2, "days"), moment().subtract(2, "days")],
                                "7 ngày trước": [moment().subtract(6, "days"), moment()],
                                "15 ngày trước": [moment().subtract(14, "days"), moment()],
                                "30 ngày trước": [moment().subtract(29, "days"), moment()],
                                "Tháng trước": [moment().subtract(1, "month").startOf("month"), moment().subtract(1, "month").endOf("month")],
                            },
                        },
                        function (e, o, n) {
                            var r = n + "_" + e.format("YYYY-MM-DD") + "_" + o.format("YYYY-MM-DD");
                            $(t + " .form-control").val(e.format("DD-MM-YYY") + " / " + o.format("DD-MM-YYY")), a(4, r);
                        }
                    );
                })("#filter_daterangepicker"),
                $(".btn_load_mores").click(function () {
                    var t = parseInt($(this).attr("rel"));
                    n(t + 1);
                });
        },
    };
})();
jQuery(document).ready(function () {
    KTWizard4.init();
});
