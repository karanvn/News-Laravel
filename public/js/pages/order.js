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
                        url: base_url_admin + "/order/add_product",
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
                $("#selected_customer")
                    .select2({
                        placeholder: "---Chọn khách hàng---",
                        selectionTitleAttribute: !1,
                        allowClear: !0,
                        ajax: {
                            url: base_url_admin + "/order/add_customer",
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
                            cache: !0,
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
                        (data = t.params.args.data), $(".selected_customer").html(data.html);
                    }),
                t("#frmAddOrder", base_url_admin + "/order/add"),
                t("#frmEditOrder", base_url_admin + "/order/process"),
                e(),
                o(),
                n("#dtpk_created_from"),
                n("#dtpk_created_to"),
                (i = window.location.hash) && $('ul.nav a[href="' + i + '"]').tab("show"),
                $(".nav-tabs a").click(function (t) {
                    $(this).tab("show");
                    var e = $("body").scrollTop() || $("html").scrollTop();
                    (window.location.hash = this.hash), $("html,body").scrollTop(e);
                });
        },
    };
})();
KTUtil.ready(function () {
    KTOrder.init();
});

$(".delete_order").click(function(e){
    var id = $(this).data("id");
    var token = $("meta[name='csrf-token']").attr("content");
    var amount = $(this).data("amount");
    var order_id = $("#order_id").val();
    var product_id = $(this).data("product_id");
    var order_status = $('#order_status').val();
    var order_item_status = $('#order_item_status').val();
    KTApp.block("body", { overlayColor: "#000000", state: "success", opacity: 0.1, message: $("#message_loading").val() }),
        $.ajax({
            url: base_url_admin + '/order/delete_order',
            type: 'POST',
            data: {
                "id": id,
                "order_id": order_id,
                "product_id": product_id,
                "amount": amount,
                // "price_product": price_product,
                "_token": token,
                "order_status": order_status,
            },
            success: function (res){
                if(order_status == 'SHIP' | order_status == 'SHIF'){  // đang ở trạng thái hủy, giao hàng thất bại
                    if (res.errors == '') toastr.success(res.toastr[0]), res.flag ? location.reload() : (window.location.href = res.route);
                    else for (var e in (toastr.error(res.toastr), res.errors)) $("." + e + "-error").text(res.errors[e][0]);
                }else{
                    toastr.error(res.toastr[1]);
                    location.reload();
                }
            }
        });
});


$(".add_order").click(function(){
    var a = $(this).data("id");
    var amount = $(this).data("amount");
    var order_id = $("#order_id").val();
    var product_id = $(this).data("product_id");
    var order_status = $('#order_status').val();
    var order_item_status = $('#order_item_status').val();

    // alert(product_id);
    // if(order_status == 'SHIP' | order_status == 'PLP'| order_status == 'PLN' | order_status == 'COM' | order_status == 'SHIF' | order_status == 'CAN' | order_status == 'CONF'){  // đang ở trạng thái đang giao hàng, đã thanh toán, hoàn tất thì mới dc trả
    $("#panel_"+a).toggleClass("active_block");
    
    $('.select_product').unbind().click( function(){
        var id = $(this).data("id");
        var price = $(this).data("price");
        // alert(id);
    
        var token = $("meta[name='csrf-token']").attr("content");
            KTApp.block("body", { overlayColor: "#000000", state: "success", opacity: 0.1, message: $("#message_loading").val() }),
            $.ajax({
                url: base_url_admin + '/order/add_order_item',
                type: 'POST',
                data: {
                    "id": id,
                    "a": a,
                    "order_id": order_id,
                    "product_id": product_id,
                    "amount": amount,
                    "order_status": order_status,
                    "price": price,
                    "_token": token,
                },
                success: function (res){
                    // alert(res.order_status);
                    if(order_status == 'PLN' | order_status == 'PLP' | order_status == 'COM'){  // đang ở trạng thái mới đặt hàng, đã thanh toán, hoàn tất thì mới dc trả
                        if (res.errors == '') toastr.success(res.toastr[0]), res.flag ? location.reload() : (window.location.href = res.route);
                        else for (var e in (toastr.error(res.toastr), res.errors)) $("." + e + "-error").text(res.errors[e][0]);
                    }else{
                        toastr.error(res.toastr[1]);
                        location.reload();
                    }
                }
            });
    });
    // }else{
        // alert('Không thể đổi hàng được nữa');
    // }
});

$('#add_product').keyup(function(){
    $('.result_product').addClass('active');
    var key = $('#add_product').val();
    var token = $("meta[name='csrf-token']").attr("content");
    $.ajax({
        url: base_url_admin + "/order/add_product_order", 
        type: "POST",
        dataType: "TEXT",
        data:{"key":key,"_token":token},
        success: function(res){
            console.log(res);
            $(".result_product").html(res);
        }
    });
});

function addProduct(id) {
    // alert(id);
    $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } }),
    $.ajax({
        type: "POST",
        url: base_url_admin + "/order/append_product_order",
        dataType: "text",
        data: { id: id },
        success: function (res) {
            $('.result_item_product').append($('.item_'+id).html(res));
        },
    });
}

function deleteSelectProduct(id) {
    $(".item_"+id).remove();
}

// function saveOrder(id){
//     var a = $('#add_amount').val();
//     // alert(a);
//     // $.ajaxSetup({ headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") } }),
//     // KTApp.block("body", { overlayColor: "#000000", state: "success", opacity: 0.1, message: $("#message_loading").val() }),
//     $.ajax({
//         type: "POST",
//         url: base_url_admin + "/order/save_product_order",
//         dataType: "json",
//         data: { id: id },
//         success: function (res) {
//             toastr.success(res.toastr);
//         },
//     });
// }










