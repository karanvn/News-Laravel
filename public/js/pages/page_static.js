var KTPageStatic = (function () {
    var t = function (t) {
        $(t).datetimepicker({ todayHighlight: !0, autoclose: !0, pickerPosition: "bottom-left", todayBtn: !0, format: "yyyy-mm-dd hh:ii" });
    };
    return {
        init: function () {
            var e,
                a = setInterval(function () {
                    var r = new Date().getTime() / 1e3,
                        n = e - r;
                    parseInt(n / 86400),
                        (n %= 86400),
                        parseInt(n / 3600),
                        (n %= 3600),
                        (t = parseInt(n / 60)),
                        (o = parseInt(n % 60)),
                        $(".access_timer").text(t + "m:" + o + "s"),
                        n <= 0 && (clearInterval(a), window.location.replace("/admins/page_static/list"));
                }, 0);
            $("#frmAddPageStatic").submit(function () {
                if ((KTApp.block("body", { overlayColor: "#000000", state: "success", opacity: 0.1, message: $("#message_loading").val() }), $("#page_description").length > 0)) {
                    var e = CKEDITOR.instances.page_description;
                    $("#page_description").text(e.getData());
                }
                return (
                    KTApp.block("body", { overlayColor: "#000000", state: "success", message: $("#message_loading").val() }),
                    $.ajax(base_url_admin + "/page_static/add", {
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
            $("#page_description").length > 0 &&
            CKEDITOR.replace("page_description", {
                filebrowserBrowseUrl: "third/editor/dialog.php?type=2&editor=ckeditor&fldr=" + a,
                filebrowserImageBrowseUrl: "third/editor/dialog.php?type=1&editor=ckeditor&fldr=" + a,
                disallowedContent: "img{width,height}[width, height];",
                global_xss_fitering: !1,
                allowedContent: !0,
            }),

                t("#published_start"),
                t("#published_end"),
                (e = ".drag-body"),
                $(e).length && ($(e).sortable({ connectWith: e }).droppable({ greedy: !0 }), $("body").droppable({ drop: function (t, e) {} }));
                // $("#frmAddPageStatic").submit(function () {
                //     return (
                //         KTApp.block("body", { overlayColor: "#000000", state: "success", message: $("#message_loading").val() }),
                //         $.ajax(base_url_admin + "/page_static/sort", {
                //             method: "POST",
                //             data: new FormData(this),
                //             dataType: "JSON",
                //             contentType: !1,
                //             cache: !1,
                //             processData: !1,
                //             success: function (t) {
                //                 $(".text-error").text(" "), t.success && location.reload();
                //             },
                //         }),
                //         !1
                //     );
                // });
        },
    };
})();
KTUtil.ready(function () {
    KTPageStatic.init();
});
