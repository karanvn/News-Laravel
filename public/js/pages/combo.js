var KTOrder = (function () {
    var t = function (t, e) {
            $(t).submit(function () {
                return (
                    KTApp.block("body", { overlayColor: "#000000", state: "success", opacity: 0.1, message: $("#message_loading").val() }),
                    $.ajax(e, {
                        method: "POST",
                        data: new FormData(this),
                        dataType: "JSON",
                        contentType: !1,
                        cache: !1,
                        processData: !1,
                        success: function (t) {
                            if (($(".text-error").text(" "), KTApp.unblock("body"), t.success)) toastr.success(t.toastr), t.flag ? location.reload() : (window.location.href = t.route);
                            else for (var e in (toastr.error(t.toastr), t.errors)) $("." + e + "-error").text(t.errors[e][0]);
                        },
                    }),
                    !1
                );
            });
        },
        e = function () {
            $(".product_amount").bind("keyup mouseup change input", function () {
                (amount = $(this).val()), (parent = $(this).parent()), (price = parent.data("price")), (total_price = amount * price), parent.find(".price").text("= " + total_price.toLocaleString("en-US")), a();
            });
        },
        r = function (t, e) {
            var r = e * $(t).find(".product-group").data("price");
            t.find(".price").text("= " + r.toLocaleString("en-US")), a();
        },
        a = function () {
            var t = 0;
            $(".product_item").each(function (e) {
                var r = parseInt($(this).find(".product-group").data("price")),
                    a = parseInt($(this).find(".product_amount").val());
                t += r * a;
            }),
                $(".order-subtotal").text(t.toLocaleString("en-US")),
                $(".order-total").text(t.toLocaleString("en-US"));
        },
        o = function () {
            $(".btn-del-item").click(function () {
                (parent = $(this).parent().closest(".product_item")), parent.remove(), a();
            });
        },
        n = function (t) {
            $(t).datetimepicker({ todayHighlight: !0, autoclose: !0, pickerPosition: "bottom-left", todayBtn: !0, format: "yyyy-mm-dd hh:ii" });
        };
    return {
        init: function () {
            var i;
            $("#selected_product")
                .select2({
                    placeholder: "---Chọn sản phẩm---",
                    selectionTitleAttribute: !1,
                    ajax: {
                        url: base_url_admin + "/combo/add_product",
                        global: !1,
                        type: "GET",
                        data: function (t) {
                            return { term: $.trim(t.term), page: t.page || 1 };
                        },
                        processResults: function (t) {
                            return {
                                results: $.map(t.results, function (t) {
                                    return { text: t.text, id: t.id, html: t.html };
                                }),
                            };
                        },
                    },
                    allowClear: !0,
                    templateResult: function (t) {
                        if (void 0 !== t.text) return $(t.text);
                    },
                    templateSelection: function (t) {
                        return t.id ? $(t.text) : t.text;
                    },
                })
                .on("select2:selecting", function (t) {
                    (data = t.params.args.data),
                        (parent = $(".item-" + data.id)),
                        parent.length ? ((product_amount = parent.find(".product_amount")), (amount = parseInt(product_amount.val()) + 1), product_amount.val(amount), r(parent, amount)) : $(".selected_items").append(data.html),
                        o(),
                        e(),
                        a(),
                        $(this).empty();
                }),
                t("#frmAddCombo", base_url_admin + "/combo/add"),
                e(),
                o(),
                n("#dtpk_created_from"),
                n("#dtpk_created_to");
        },
    };
})();
KTUtil.ready(function () {
    KTOrder.init();
});
