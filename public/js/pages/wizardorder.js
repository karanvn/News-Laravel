"use strict";
var KTWizard4 = (function () {
    var t,
        e,
        a = function (t, a = 0) {
            KTApp.block("body", { overlayColor: "#000000", state: "success", message: $("#message_loading").val() }),
                $.ajax(base_url_admin + "/dashboardorder/wizard/" + t + "?period=" + a, {
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
                            $(".wizard-step-" + t).html(a.html), o(a.valuesPLN, a.categories, a.values, a.valuesFalse, a.valuesSHIP, a.valuesCONF, a.orders, a.step, a.width, a.bar);
                           
                        }
                    },
                });
        },
        o = function (pln = [], t = [], e = [], f = [], ship = [], m = [], a = [], o = 1, n = 1, r = [!1, 400]) {
            var s = document.getElementById("wedget-chart-step-" + o);
            if (s) {
                var i = {
                    series: [
                        { name: "Thành công", type: "bar", stacked: !1, height: r[1], data: e},
                        { name: "Đã xác nhận", type: "bar", stacked: !1, data: m},
                        { name: "Đang giao", type: "bar", stacked: !1, data: ship},
                        { name: "Thất bại", type: "bar", stacked: !1, data: f },
                        { name: "Mới đặt", type: "bar", stacked: !1, data: pln },
                    ],
                    chart: { stacked: !0, height: 350, toolbar: { show: !1 } },
                    plotOptions: { bar: {
                        horizontal: false,
                        columnWidth: '55%'
                    } },
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
                                return t;
                            },
                        },
                    },

                    colors: ['#1BC5BD', '#8950FC', '#3699FF', '#F64E60', '#EBEDF3'],
                    grid: { borderColor: KTApp.getSettings().colors.gray["gray-200"], strokeDashArray: 4, yaxis: { lines: { show: !0 } } },
                };
                new ApexCharts(s, i).render();
            };
            var s = document.getElementById("chartElip-" + o);
            if (s) {
                // 
                console.log(
                    
                  );
                var i = {
                    series: [
                        e.reduce((a, b) => a + b, 0),
                        m.reduce((a, b) => a + b, 0),
                        ship.reduce((a, b) => a + b, 0),
                        f.reduce((a, b) => a + b, 0),
                        pln.reduce((a, b) => a + b, 0)
                    ],
                    chart: {
                        width: 380,
                        type: 'pie',
                      },
                      labels: ['Thành công', 'Đã xác nhận', 'Giao hàng', 'Thất bại', 'Mới đặt'],
                    colors: ['#1BC5BD', '#8950FC', '#3699FF', '#F64E60', '#EBEDF3'],
                };
                new ApexCharts(s, i).render();
            }
        },
        n = function (t = 1) {
            KTApp.block("body", { overlayColor: "#000000", state: "success", message: $("#message_loading").val() }),
                $.ajax(base_url_admin + "/home/log?type=ORDER&page=" + t, {
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
