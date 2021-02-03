var KTBanner = (function () {
    var t = function (t) {
        $(t).datetimepicker({ todayHighlight: !0, autoclose: !0, pickerPosition: "bottom-left", todayBtn: !0, format: "yyyy-mm-dd hh:ii" });
    };
    return {
        init: function () {
            var e;
            $("#frmAddBanner").submit(function () {
                return (
                    KTApp.block("body", { overlayColor: "#000000", state: "success", message: $("#message_loading").val() }),
                    $.ajax(base_url_admin + "/banner/add", {
                        method: "POST",
                        data: new FormData(this),
                        dataType: "JSON",
                        contentType: !1,
                        cache: !1,
                        processData: !1,
                        success: function (t) {
                            if (($(".text-error").text(" "), t.success)) toastr.success(t.toastr), location.reload();
                            else {
                                for (var e in (toastr.error(t.toastr), t.errors)) $("." + e + "-error").text(t.errors[e][0]);
                                KTApp.unblock("body");
                            }
                        },
                    }),
                    !1
                );
            }),
                t("#dtpk_published_start"),
                t("#dtpk_published_end"),
                (e = ".drag-body"),
                $(e).length && ($(e).sortable({ connectWith: e }).droppable({ greedy: !0 }), $("body").droppable({ drop: function (t, e) {} })),
                $("#frmSortBanner").submit(function () {
                    return (
                        KTApp.block("body", { overlayColor: "#000000", state: "success", message: $("#message_loading").val() }),
                        $.ajax(base_url_admin + "/banner/sort", {
                            method: "POST",
                            data: new FormData(this),
                            dataType: "JSON",
                            contentType: !1,
                            cache: !1,
                            processData: !1,
                            success: function (t) {
                                $(".text-error").text(" "), t.success && location.reload();
                            },
                        }),
                        !1
                    );
                });
        },
    };
})();
KTUtil.ready(function () {
    KTBanner.init();
});
