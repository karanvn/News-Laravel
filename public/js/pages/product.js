var KTProduct = (function () {
    var e,
        t = function (e) {
            $(e).length &&
                (($.fn.editable.defaults.mode = "inline"),
                $(e + " a.image_name").editable({
                    type: "text",
                    title: "Chỉnh sửa tên",
                    success: function (e, t) {
                        var o = $(this).data("pk");
                        $.ajax(base_url_admin + "/product/image/editable/" + o + "?name=" + t, { method: "GET", success: function (e) {} });
                    },
                }));
        },
        o = function () {
            $(".symbol_image").click(function () {
                var e = $(this).attr("rel");
                e > 0 &&
                    (KTApp.block("body", { overlayColor: "#000000", state: "success", opacity: 0.1, message: $("#message_loading").val() }),
                    $.ajax(base_url_admin + "/product/image/slide/" + e, {
                        method: "GET",
                        success: function (e) {
                            e.success &&
                                ($("#model_full_images .modal-body").html(e.html),
                                KTApp.unblock("body"),
                                $.getScript("js/cropper/cropper.bundle.js", function () {
                                    h();
                                }),
                                $("#model_full_images").modal("show"));
                        },
                    }));
            });
        },
        a = $('input[name="product_id"]').val(),
        r = function (e = 0) {
            KTApp.block("body", { overlayColor: "#000000", state: "success", opacity: 0.1, message: $("#message_loading").val() }),
                $.ajax(base_url_admin + "/category/banner/" + e, {
                    method: "GET",
                    success: function (e) {
                        $(".load_banner_info").html(e.html), d("#dtpk_published_start"), d("#dtpk_published_end"), g("kt_banner"), KTApp.unblock("body");
                    },
                });
        },
        n = function (e = 0) {
            KTApp.block("body", { overlayColor: "#000000", state: "success", opacity: 0.1, message: $("#message_loading").val() }),
                $.ajax(base_url_admin + "/blog/category/banner/" + e, {
                    method: "GET",
                    success: function (e) {
                        $(".load_banner_info").html(e.html), d("#dtpk_published_start"), d("#dtpk_published_end"), g("kt_banner"), KTApp.unblock("body");
                    },
                });
        },
        s = function (e) {
            KTApp.block("body", { overlayColor: "#000000", state: "success", opacity: 0.1, message: $("#message_loading").val() }),
                $.ajax(base_url_admin + "/product/load_child/" + e + "/" + $('#id_product_parent').val(), {
                    method: "GET",
                    success: function (t) {
                        $(".load_sku_product").html(t.html),
                            u(".dropzone_sku_images", !0),
                            $(".card_sku_image").css("background-color", ""),
                            $(".card_sku_image_" + e).css("background-color", "#eef0f8"),
                            l(".product_org_price"),
                            l(".product_sell_price"),
                            KTApp.unblock("body");
                    },
                });
        },
        c = function (e) {
            $(e).submit(function () {
                KTApp.block("body", { overlayColor: "#000000", state: "success", opacity: 0.1, message: $("#message_loading").val() });
                var e = $(this).attr("rel");
                return (
                    e > 0 &&
                        $.ajax(base_url_admin + "/product/image/sort/" + e, {
                            method: "POST",
                            data: new FormData(this),
                            dataType: "JSON",
                            contentType: !1,
                            cache: !1,
                            processData: !1,
                            success: function (t) {
                                if (t.html) {
                                    $("#skuImages").modal("hide");
                                    var a = ".sku_images_" + e;
                                    $(a).empty(), $(a).html(t.html), o();
                                }
                                KTApp.unblock("body"), toastr.success(t.message);
                            },
                        }),
                    !1
                );
            });
        },
        i = function (e, t = !0) {
            t
                ? $(e).select2({
                      placeholder: "---Chọn danh mục---",
                      allowClear: !0,
                      ajax: {
                          url: base_url_admin + "/product/add_category",
                          global: !1,
                          type: "GET",
                          data: function (e) {
                              return { term: $.trim(e.term), page: e.page || 1 };
                          },
                          processResults: function (e) {
                              return {
                                  results: $.map(e.results, function (e) {
                                      return { text: e.name, id: e.id };
                                  }),
                              };
                          },
                          cache: !0,
                      },
                  })
                : $(e).select2({ placeholder: "---Chọn danh mục---", allowClear: !0 });
        },
        l = function (e) {
            $(e).on("keyup", function (e) {
                if ("" === window.getSelection().toString() && -1 === $.inArray(e.keyCode, [38, 40, 37, 39])) {
                    var t,
                        o = $(this);
                    (t = (t = (t = o.val()).replace(/[\D\s\._\-]+/g, "")) ? parseInt(t, 10) : 0),
                        o.val(function () {
                            return 0 === t ? "" : t.toLocaleString("en-US");
                        });
                }
            });
        };
    $("#btn_selected_categoriesBlog").click(function () {
        KTApp.block("body", { overlayColor: "#000000", state: "success", opacity: 0.1, message: $("#message_loading").val() });
        var e = $('input[name="parent_id"]:checked').val();
        void 0 !== e &&
            $.ajax(base_url_admin + "/blog/categoryselected/" + e, {
                method: "GET",
                success: function (e) {
                    if ((console.log(e), e)) {
                        var t = new Option(e.text, e.id, !0, !0);
                        $("#selected_categories").html(t).trigger("change"), "FOOTER" == e.position ? $("#position_show").show() : $("#position_show").hide();
                    }
                },
            }),
            KTApp.unblock("body");
    });
    var d = function (e) {
            $(e).datetimepicker({ todayHighlight: !0, autoclose: !0, pickerPosition: "bottom-left", todayBtn: !0, format: "yyyy-mm-dd hh:ii" });
        },
        u = function (e, a = !1) {
            if ($(e).length) {
                var r = $(e).attr("rel");
                if (r > 0) {
                    var n = $(e + " .dropzone-item");
                    n.id = "";
                    var s = n.parent(".dropzone-items").html();
                    n.remove();
                    var c = new Dropzone(e, {
                        url: base_url_admin + "/product/dropzone/" + r,
                        method: "POST",
                        headers: { "X-CSRF-TOKEN": $('input[name="_token"]').val() },
                        parallelUploads: 20,
                        previewTemplate: s,
                        acceptedFiles: ".jpeg,.jpg,.png,.gif",
                        maxFilesize: 5,
                        maxFiles: 10,
                        autoQueue: !1,
                        previewsContainer: e + " .dropzone-items",
                        clickable: e + " .dropzone-select",
                        success: function (e, n) {
                            if (n.success) {
                                if (a) {
                                    var s = ".sku_images_" + r;
                                    $(s).empty(), $(s).html(n.html);
                                } else $("#tbl_product_images tr:first").after(n.html), t("#tbl_product_images");
                                p(".drag-body"), m(), o();
                            }
                        },
                    });
                    c.on("addedfile", function (t) {
                        (t.previewElement.querySelector(e + " .dropzone-start").onclick = function () {
                            c.enqueueFile(t);
                        }),
                            $(document)
                                .find(e + " .dropzone-item")
                                .css("display", ""),
                            $(e + " .dropzone-upload, " + e + " .dropzone-remove-all").css("display", "inline-block");
                    }),
                        c.on("totaluploadprogress", function (t) {
                            $(this)
                                .find(e + " .progress-bar")
                                .css("width", t + "%");
                        }),
                        c.on("sending", function (t) {
                            $(e + " .progress-bar").css("opacity", "1"), t.previewElement.querySelector(e + " .dropzone-start").setAttribute("disabled", "disabled");
                        }),
                        c.on("complete", function (t) {
                            var o = e + " .dz-complete";
                            setTimeout(function () {
                                $(o + " .progress-bar, " + o + " .progress, " + o + " .dropzone-start").css("opacity", "0");
                            }, 300);
                        }),
                        (document.querySelector(e + " .dropzone-upload").onclick = function () {
                            c.enqueueFiles(c.getFilesWithStatus(Dropzone.ADDED));
                        }),
                        (document.querySelector(e + " .dropzone-remove-all").onclick = function () {
                            $(e + " .dropzone-upload, " + e + " .dropzone-remove-all").css("display", "none"), c.removeAllFiles(!0);
                        }),
                        c.on("queuecomplete", function (t) {
                            $(e + " .dropzone-upload").css("display", "none");
                        }),
                        c.on("removedfile", function (t) {
                            c.files.length < 1 && $(e + " .dropzone-upload, " + e + " .dropzone-remove-all").css("display", "none");
                        });
                }
            }
        },
        p = function (e) {
            $(e).length && ($(e).sortable({ connectWith: e }).droppable({ greedy: !0 }), $("body").droppable({ drop: function (e, t) {} }));
        },
        m = function () {
            $(".btn-del-image").click(function () {
                if (1 == confirm("Bạn có muốn xoá ảnh?")) {
                    KTApp.block("body", { overlayColor: "#000000", state: "success", opacity: 0.1, message: $("#message_loading").val() });
                    var e = $(this).attr("rel");
                    e > 0 &&
                        $.ajax(base_url_admin + "/product/image/drop/" + e, {
                            method: "POST",
                            headers: { "X-CSRF-TOKEN": $('input[name="_token"]').val() },
                            success: function (t) {
                                KTApp.unblock("body"), $(".tr-" + e).remove(), $("a[class='symbol_image'][rel=" + e + "]").remove();
                            },
                        });
                }
            });
        },
        g = function (e) {
            new KTImageInput(e);
        },
        h = function () {
            if ($("#image_cropper").length > 0) {
                var t = document.getElementById("image_cropper"),
                    o = {
                        crop: function (t) {
                            (document.getElementById("dataX").value = Math.round(t.detail.x)),
                                (document.getElementById("dataY").value = Math.round(t.detail.y)),
                                (document.getElementById("dataWidth").value = Math.round(t.detail.width)),
                                (document.getElementById("dataHeight").value = Math.round(t.detail.height)),
                                (document.getElementById("dataRotate").value = t.detail.rotate),
                                (document.getElementById("dataScaleX").value = t.detail.scaleX),
                                (document.getElementById("dataScaleY").value = t.detail.scaleY);
                            var o = document.getElementById("cropper-preview-lg");
                            (o.innerHTML = ""), o.appendChild(e.getCroppedCanvas({ width: 256, height: 160 }));
                            var a = document.getElementById("cropper-preview-md");
                            (a.innerHTML = ""), a.appendChild(e.getCroppedCanvas({ width: 128, height: 80 }));
                            var r = document.getElementById("cropper-preview-sm");
                            (r.innerHTML = ""), r.appendChild(e.getCroppedCanvas({ width: 64, height: 40 }));
                            var n = document.getElementById("cropper-preview-xs");
                            (n.innerHTML = ""), n.appendChild(e.getCroppedCanvas({ width: 32, height: 20 }));
                        },
                    };
                (e = new Cropper(t, o)),
                    document
                        .getElementById("cropper-buttons")
                        .querySelectorAll("[data-method]")
                        .forEach(function (t) {
                            t.addEventListener("click", function (o) {
                                var a,
                                    r = t.getAttribute("data-method"),
                                    n = t.getAttribute("data-option"),
                                    s = t.getAttribute("data-second-option");
                                try {
                                    n = JSON.parse(n);
                                } catch (o) {}
                                if (((a = s ? (n ? e[r](n) : e[r]()) : e[r](n, s)), "getCroppedCanvas" === r)) {
                                    var c = document.getElementById("getCroppedCanvasModal").querySelector(".modal-body");
                                    (c.innerHTML = ""), c.appendChild(a);
                                }
                                var i = document.querySelector("#putData");
                                try {
                                    i.value = JSON.stringify(a);
                                } catch (o) {
                                    a || (i.value = a);
                                }
                            });
                        }),
                    document
                        .getElementById("setAspectRatio")
                        .querySelectorAll('[name="aspectRatio"]')
                        .forEach(function (t) {
                            t.addEventListener("click", function (t) {
                                e.setAspectRatio(t.target.value);
                            });
                        });
            }
        };
    return {
        init: function () {
            var e, a;
            g("kt_image"),
                (function () {
                    var e = $("#expired_timer").val();
                    if (void 0 !== e)
                        var t,
                            o,
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
                                    n <= 0 && (clearInterval(a), window.location.replace("/admins/product/list"));
                            }, 0);
                })(),
                $("#btn_remove_timer").click(function () {
                    KTApp.block("body", { overlayColor: "#000000", state: "success", message: $("#message_loading").val() });
                    var e = $(this).data("id");
                    $.ajax(base_url_admin + "/product/remove_timer/" + e, {
                        method: "GET",
                        success: function (e) {
                            KTApp.unblock("body"), window.location.replace("/admins/product/list");
                        },
                    });
                }),
                $(".radio_parent_id").click(function () {
                    var e = $(this).attr("rel");
                    $('input[name="id_path"]').val(e);
                }),
                $("#change_categoryblog_banner").change(function () {
                    var e = $(this).val();
                    n(e);
                }),
                $("#product_description").length > 0 &&
                    CKEDITOR.replace("product_description", {
                        filebrowserBrowseUrl: "third/editor/dialog.php?type=2&editor=ckeditor&fldr=" + a,
                        filebrowserImageBrowseUrl: "third/editor/dialog.php?type=1&editor=ckeditor&fldr=" + a,
                        disallowedContent: "img{width,height}[width, height];",
                        global_xss_fitering: !1,
                        allowedContent: !0,
                    }),
                $("#product_note").length > 0 &&
                    CKEDITOR.replace("product_note", {
                        filebrowserBrowseUrl: "third/editor/dialog.php?type=2&editor=ckeditor&fldr=" + a,
                        filebrowserImageBrowseUrl: "third/editor/dialog.php?type=1&editor=ckeditor&fldr=" + a,
                        disallowedContent: "img{width,height}[width, height];",
                        global_xss_fitering: !1,
                        allowedContent: !0,
                    }),
                p(".drag-body"),
                $("#frmAddCategory").submit(function () {
                    if ((KTApp.block("body", { overlayColor: "#000000", state: "success", opacity: 0.1, message: $("#message_loading").val() }), $("#category_des").length > 0)) {
                        var e = CKEDITOR.instances.category_des;
                        $("#category_des").text(e.getData());
                    }
                    return (
                        $.ajax(base_url_admin + "/category/add", {
                            method: "POST",
                            data: new FormData(this),
                            dataType: "JSON",
                            contentType: !1,
                            cache: !1,
                            processData: !1,
                            success: function (e) {
                                if (($(".text-error").text(" "), e.success)) toastr.success(e.toastr), location.reload();
                                else for (var t in (KTApp.unblock("body"), toastr.error(e.toastr), e.errors)) $("." + t + "-error").text(e.errors[t][0]);
                            },
                        }).always(function () {}),
                        !1
                    );
                }),
                $("#frmAddCollection").submit(function () {
                    if ((KTApp.block("body", { overlayColor: "#000000", state: "success", opacity: 0.1, message: $("#message_loading").val() }), $("#category_des").length > 0)) {
                        var e = CKEDITOR.instances.category_des;
                        $("#category_des").text(e.getData());
                    }
                    return (
                        $.ajax(base_url_admin + "/collection/postCollectionAdd", {
                            method: "POST",
                            data: new FormData(this),
                            dataType: "JSON",
                            contentType: !1,
                            cache: !1,
                            processData: !1,
                            success: function (e) {
                                if (($(".text-error").text(" "), e.success)) toastr.success(e.toastr), window.location.href = e.route;
                                else for (var t in (KTApp.unblock("body"), toastr.error(e.toastr), e.errors)) $("." + t + "-error").text(e.errors[t][0]);
                            },
                        }).always(function () {}),
                        !1
                    );
                }),
                $("#frmaddRaiting").submit(function () {
                    if ((KTApp.block("body", { overlayColor: "#000000", state: "success", opacity: 0.1, message: $("#message_loading").val() }), $("#category_des").length > 0)) {
                        var e = CKEDITOR.instances.category_des;
                        $("#category_des").text(e.getData());
                    }
                    return (
                        $.ajax("/evaluate/addRaitingAdmin", {
                            method: "POST",
                            data: new FormData(this),
                            dataType: "JSON",
                            contentType: !1,
                            cache: !1,
                            processData: !1,
                            success: function (e) {
                                if (($(".text-error").text(" "), e.success)) toastr.success(e.toastr), window.location.href = e.route;
                                else for (var t in (KTApp.unblock("body"), toastr.error(e.toastr), e.errors)) $("." + t + "-error").text(e.errors[t][0]);
                            },
                        }).always(function () {}),
                        !1
                    );
                }),

                $("#frmAddFeature").submit(function () {
                    return (
                        KTApp.block("body", { overlayColor: "#000000", state: "success", opacity: 0.1, message: $("#message_loading").val() }),
                        $.ajax(base_url_admin + "/feature/add", {
                            method: "POST",
                            data: new FormData(this),
                            dataType: "JSON",
                            contentType: !1,
                            cache: !1,
                            processData: !1,
                            success: function (e) {
                                if (($(".text-error").text(" "), e.success)) toastr.success(e.toastr), (window.location.href = e.route);
                                else for (var t in (KTApp.unblock("body"), toastr.error(e.toastr), e.errors)) $("." + t + "-error").text(e.errors[t][0]);
                            },
                        }).always(function () {}),
                        !1
                    );
                }),
                $("#frmAddPoint").submit(function () {
                    return (
                        KTApp.block("body", { overlayColor: "#000000", state: "success", opacity: 0.1, message: $("#message_loading").val() }),
                        $.ajax("/admins/tool/addPoint", {
                            method: "POST",
                            data: new FormData(this),
                            dataType: "JSON",
                            contentType: !1,
                            cache: !1,
                            processData: !1,
                            success: function (e) {
                                if (($(".text-error").text(" "), e.success)) toastr.success(e.toastr), (window.location.href = e.route);
                                else for (var t in (KTApp.unblock("body"), toastr.error(e.toastr), e.errors)) $("." + t + "-error").text(e.errors[t][0]);
                            },
                        }).always(function () {}),
                        !1
                    );
                }),
                $("#frmAddDiscount").submit(function () {
                    if ((KTApp.block("body", { overlayColor: "#000000", state: "success", opacity: 0.1, message: $("#message_loading").val() }), $("#product_description").length > 0)) {
                        var e = CKEDITOR.instances.product_description;
                    }
                    return (
                        $.ajax(base_url_admin + "/discount/add", {
                            method: "POST",
                            data: new FormData(this),
                            dataType: "JSON",
                            contentType: !1,
                            cache: !1,
                            processData: !1,
                            success: function (e) {
                                console.log(e);
                                if ((console.log("LOG", e), $(".text-error").text(" "), KTApp.unblock("body"), e.success)) toastr.success(e.toastr), e.flag ? location.reload() : (window.location.href = e.route);
                                else for (var t in (toastr.error(e.toastr), e.errors)) $("." + t + "-error").text(e.errors[t][0]);
                            },
                        }).always(function () {}),
                        !1
                    );
                }),
                $("#frmPreviewExcelModule").submit(function () {
                    if ((KTApp.block("body", { overlayColor: "#000000", state: "success", opacity: 0.1, message: $("#message_loading").val() }), $("#product_description").length > 0)) {
                        var e = CKEDITOR.instances.product_description;
                    }
                    return (
                        $.ajax(base_url_admin + "/dashboard/PreviewExcelModule", {
                            method: "POST",
                            data: new FormData(this),
                            dataType: "JSON",
                            contentType: !1,
                            cache: !1,
                            processData: !1,
                            success: function (e) {
                                console.log(e);
                                if ((console.log("LOG", e), $(".text-error").text(" "), $('#demo_excel').html(e.html), KTApp.unblock("body"), e.success)) toastr.success(e.toastr);
                                else for (var t in (toastr.error(e.toastr), e.errors)) $("." + t + "-error").text(e.errors[t][0]);
                            },
                        }).always(function () {}),
                        !1
                    );
                }),
                $("#frmAddProduct").submit(function () {
                    if ((KTApp.block("body", { overlayColor: "#000000", state: "success", opacity: 0.1, message: $("#message_loading").val() }), $("#product_description").length > 0)) {
                        var e = CKEDITOR.instances.product_description;
                        $("#product_description").text(e.getData());
                    }
                    if ($("#product_note").length > 0) {
                        var t = CKEDITOR.instances.product_note;
                        $("#product_note").text(t.getData());
                    }
                    return (
                        $.ajax(base_url_admin + "/product/add", {
                            method: "POST",
                            data: new FormData(this),
                            dataType: "JSON",
                            contentType: !1,
                            cache: !1,
                            processData: !1,
                            success: function (e) {
                                if ((console.log("LOG", e), $(".text-error").text(" "), KTApp.unblock("body"), e.success)) toastr.success(e.toastr), e.flag ? location.reload() : (window.location.href = e.route);
                                else for (var t in (toastr.error(e.toastr), e.errors)) $("." + t + "-error").text(e.errors[t][0]);
                            },
                        }).always(function () {}),
                        !1
                    );
                }),
                $("#frmAddChildProduct").submit(function () {
                    return (
                        KTApp.block("body", { overlayColor: "#000000", state: "success", opacity: 0.1, message: $("#message_loading").val() }),
                        $.ajax(base_url_admin + "/product/add_child", {
                            method: "POST",
                            data: new FormData(this),
                            dataType: "JSON",
                            contentType: !1,
                            cache: !1,
                            processData: !1,
                            success: function (e) {
                                if ((KTApp.unblock("body"), $(".text-error").text(" "), e.success)) toastr.success(e.toastr), location.reload();
                                else for (var t in (toastr.error(e.toastr), e.errors)) $("." + t + "-error").text(e.errors[t][0]);
                            },
                        }),
                        !1
                    );
                }),
                $("#search_blog").on("input", function () {
                    var e = $(this).val();
                    "" != e &&
                        $.ajax(base_url_admin + "/blog/seachAddCategory/" + e, {
                            method: "GET",
                            dataType: "JSON",
                            contentType: !1,
                            cache: !1,
                            processData: !1,
                            success: function (e) {
                                console.log(e), $(".load_blog_search").html(e.data);
                            },
                        });
                }),
                i("#op_category_product", !0),
                i("#selected_categories", !1),
                $("#op_feature_product").select2({ placeholder: "---Chọn thuộc tính---" }),
                l(".product_sell_price"),
                l(".product_org_price"),
                $("#btnGetParentCategory").click(function () {
                    var e = $("input:radio[name='parent_id']:checked").val();
                    $("#modalTreeCategories").modal("hide"), $("input[name='parent_name']").val($(".category_name_" + e).text()), $("input[name='parent_id']").attr("value", e);
                }),
                d("#dtpk_published_start"),
                d("#dtpk_published_end"),
                d("#dtpk_avail_since"),
                d("#dtpk_avail_to"),
                $("#change_category_banner").change(function () {
                    var e = $(this).val();
                    r(e);
                }),
                $(".category_edit_banner").click(function () {
                    var e = $(this).attr("rel");
                    e > 0 && r("EDIT");
                }),
                $("#btn_selected_categories").click(function () {
                    KTApp.block("body", { overlayColor: "#000000", state: "success", opacity: 0.1, message: $("#message_loading").val() });
                    var e = $('input[name="parent_id"]:checked').val();
                    void 0 !== e &&
                        $.ajax(base_url_admin + "/category/selected/" + e, {
                            method: "GET",
                            success: function (e) {
                                if (e) {
                                    var t = $("#selected_categories").find("option[value='" + e.id + "']");
                                    1 == t.length && t.remove();
                                    var o = new Option(e.text, e.id, !0, !0);
                                    $("#selected_categories").append(o).trigger("change");
                                }
                            },
                        }),
                        KTApp.unblock("body");
                }),
                u(".dropzone_images", !1),
                c("#frmSortImage"),
                c("#frmSortSKUImage"),
                m(),
                t("#tbl_product_images"),
                (function (e) {
                    $(e).length &&
                        (($.fn.editable.defaults.mode = "inline"),
                        $(e + " a.product_qty").editable({
                            type: "text",
                            title: "Cập nhật tồn kho",
                            success: function (e, t) {
                                var o = $(this).data("pk");
                                $.ajax(base_url_admin + "/inventory/editable/" + o + "?qty=" + t, { method: "GET", success: function (e) {} });
                            },
                        }));
                })("#product_inventories"),
                o(),
                $("#change_sku_product").change(function () {
                    var e = $(this).val();
                    s(e);
                }),
                $(".btn-model-images").click(function () {
                    var e = $(this).attr("rel");
                    e > 0 &&
                        (KTApp.block("body", { overlayColor: "#000000", state: "success", opacity: 0.1, message: $("#message_loading").val() }),
                        $.ajax(base_url_admin + "/product/sku/images/" + e, {
                            method: "GET",
                            success: function (o) {
                                KTApp.unblock("body"),
                                    o.success && ($("#skuImages .modal-body").html(o.html), $("#skuTitle").text(o.title), p(".drag-body"), t("#tbl_sku_images"), m(), $("#frmSortSKUImage").attr("rel", e), $("#skuImages").modal("show"));
                            },
                        }));
                }),
                (e = window.location.hash) && $('ul.nav a[href="' + e + '"]').tab("show"),
                $(".nav-tabs a").click(function (e) {
                    $(this).tab("show");
                    var t = $("body").scrollTop() || $("html").scrollTop();
                    (window.location.hash = this.hash), $("html,body").scrollTop(t);
                }),
                $("#frmPreviewInventory").submit(function () {
                    return (
                        KTApp.block("body", { overlayColor: "#000000", state: "success", message: $("#message_loading").val() }),
                        $.ajax(base_url_admin + "/inventory/preview", {
                            method: "POST",
                            data: new FormData(this),
                            dataType: "JSON",
                            contentType: !1,
                            cache: !1,
                            processData: !1,
                            success: function (e) {
                                if ((KTApp.unblock("body"), $(".text-error").text(" "), e.success)) KTApp.unblock("body"), $("#inventory_import_preview").html(e.html);
                                else for (var t in (toastr.error(e.toastr), e.errors)) $("." + t + "-error").text(e.errors[t][0]);
                            },
                        }),
                        !1
                    );
                }),

                $("#frmPreviewExcel").submit(function () {
                    return (
                        KTApp.block("body", { overlayColor: "#000000", state: "success", message: $("#message_loading").val() }),
                        $.ajax(base_url_admin + "/tool/postExcelPoint", {
                            method: "POST",
                            data: new FormData(this),
                            dataType: "JSON",
                            contentType: !1,
                            cache: !1,
                            processData: !1,
                            success: function (e) {
                                if ((KTApp.unblock("body"), $(".text-error").text(" "), e.success)) KTApp.unblock("body"), $("#inventory_import_preview").html(e.html);
                                else for (var t in (toastr.error(e.toastr), e.errors)) $("." + t + "-error").text(e.errors[t][0]);
                            },
                        }),
                        !1
                    );
                }),
                $("#frmPreviewProduct").submit(function () {
                    return (
                        KTApp.block("body", { overlayColor: "#000000", state: "success", message: $("#message_loading").val() }),
                        $.ajax(base_url_admin + "/tool/frmPreviewProduct", {
                            method: "POST",
                            data: new FormData(this),
                            dataType: "JSON",
                            contentType: !1,
                            cache: !1,
                            processData: !1,
                            success: function (e) {
                                if ((KTApp.unblock("body"), $(".text-error").text(" "), e.success)) KTApp.unblock("body"), $("#inventory_import_preview").html(e.html);
                                else for (var t in (toastr.error(e.toastr), e.errors)) $("." + t + "-error").text(e.errors[t][0]);
                            },
                        }),
                        !1
                    );
                }),
                $("#frmPreviewExcelShip").submit(function () {
                    return (
                        KTApp.block("body", { overlayColor: "#000000", state: "success", message: $("#message_loading").val() }),
                        $.ajax(base_url_admin + "/location/postExcelShip", {
                            method: "POST",
                            data: new FormData(this),
                            dataType: "JSON",
                            contentType: !1,
                            cache: !1,
                            processData: !1,
                            success: function (e) {
                                if ((KTApp.unblock("body"), $(".text-error").text(" "), e.success)) KTApp.unblock("body"), $("#inventory_import_preview").html(e.html);
                                else for (var t in (toastr.error(e.toastr), e.errors)) $("." + t + "-error").text(e.errors[t][0]);
                            },
                        }),
                        !1
                    );
                }),
                
                $("#frmAddInventory").submit(function () {
                    return (
                        KTApp.block("body", { overlayColor: "#000000", state: "success", message: $("#message_loading").val() }),
                        $.ajax(base_url_admin + "/inventory/add", {
                            method: "POST",
                            data: new FormData(this),
                            dataType: "JSON",
                            contentType: !1,
                            cache: !1,
                            processData: !1,
                            success: function (e) {
                                KTApp.unblock("body"), toastr.success(e.toastr), location.reload();
                            },
                        }),
                        !1
                    );
                }),
                $("#frmAddShipCompleted").submit(function () {
                    return (
                        KTApp.block("body", { overlayColor: "#000000", state: "success", message: $("#message_loading").val() }),
                        $.ajax(base_url_admin + "/location/postExcelShipCom", {
                            method: "POST",
                            data: new FormData(this),
                            dataType: "JSON",
                            contentType: !1,
                            cache: !1,
                            processData: !1,
                            success: function (e) {
                                KTApp.unblock("body"), toastr.success(e.toastr), location.reload();
                            },
                        }),
                        !1
                    );
                }),
                $("#frmAddPointCompleted").submit(function () {
                    return (
                        KTApp.block("body", { overlayColor: "#000000", state: "success", message: $("#message_loading").val() }),
                        $.ajax("/admins/tool/postExcelPointCompleted", {
                            method: "POST",
                            data: new FormData(this),
                            dataType: "JSON",
                            contentType: !1,
                            cache: !1,
                            processData: !1,
                            success: function (e) {
                                KTApp.unblock("body"), toastr.success(e.toastr), location.reload();
                            },
                        }),
                        !1
                    );
                }),  
                $("#frmAddProductCompleted").submit(function () {
                    return (
                        KTApp.block("body", { overlayColor: "#000000", state: "success", message: $("#message_loading").val() }),
                        $.ajax("/admins/tool/postExcelProductCompleted", {
                            method: "POST",
                            data: new FormData(this),
                            dataType: "JSON",
                            contentType: !1,
                            cache: !1,
                            processData: !1,
                            success: function (e) {
                                KTApp.unblock("body"), toastr.success(e.toastr), location.reload();
                            },
                        }),
                        !1
                    );
                }),                $("#selected_branch")
                    .select2({
                        placeholder: "---Chọn thương hiệu---",
                        selectionTitleAttribute: !1,
                        ajax: {
                            url: base_url_admin + "/product/add_branch",
                            global: !1,
                            type: "GET",
                            data: function (e) {
                                return { term: $.trim(e.term), page: e.page || 1 };
                            },
                            processResults: function (e) {
                                return {
                                    results: $.map(e.results, function (e) {
                                        return { text: e.text, id: e.id, html: e.html };
                                    }),
                                };
                            },
                        },
                        allowClear: !0,
                        templateResult: function (e) {
                            if (void 0 !== e.text) return $(e.text);
                        },
                        templateSelection: function (e) {
                            return e.id ? $(e.text) : e.text;
                        },
                    })
                    .on("select2:selecting", function (e) {}),
                (a = $('input[name="product_id"]').val()),
                $("#selected_image")
                    .select2({
                        placeholder: "---Chọn hình ảnh---",
                        selectionTitleAttribute: !1,
                        ajax: {
                            url: base_url_admin + "/product/select_image_cropper/" + a,
                            global: !1,
                            type: "GET",
                            data: function (e) {
                                return { term: $.trim(e.term), page: e.page || 1 };
                            },
                            processResults: function (e) {
                                return (
                                    console.log("DATA", e),
                                    {
                                        results: $.map(e.results, function (e) {
                                            return { text: e.text, id: e.id, html: e.html };
                                        }),
                                    }
                                );
                            },
                        },
                        allowClear: !0,
                        templateResult: function (e) {
                            if (void 0 !== e.text) return $(e.text);
                        },
                        templateSelection: function (e) {
                            return e.id ? $(e.text) : e.text;
                        },
                    })
                    .on("select2:selecting", function (e) {
                        (data = e.params.args.data), console.log("IMAGE", data);
                    });
        },
    };
})();
function show_trees(e, t = 0) {
    var o = $(".jstree-icon-" + e).attr("expanded"),
        a = "open";
    "open" == o && ((a = "closed"), $(".jstree-children-" + e).empty()),
        $(".jstree-node-" + e)
            .removeClass("jstree-" + o)
            .addClass("jstree-" + a),
        $(".jstree-icon-" + e).attr("expanded", a),
        "closed" == o &&
            (KTApp.block("body", { overlayColor: "#000000", state: "success", message: $("#message_loading").val() }),
            $.ajax(base_url_admin + "/category/tree/" + e + "?flag=" + t, {
                method: "GET",
                success: function (t) {
                    KTApp.unblock("body"), t.success && $(".jstree-children-" + e).html(t.html);
                },
            }).always(function () {}));
}
function show_treesblog(e, t = 0) {
    var o = $(".jstree-icon-" + e).attr("expanded"),
        a = "open";
    "open" == o && ((a = "closed"), $(".jstree-children-" + e).empty()),
        $(".jstree-node-" + e)
            .removeClass("jstree-" + o)
            .addClass("jstree-" + a),
        $(".jstree-icon-" + e).attr("expanded", a),
        "closed" == o &&
            (KTApp.block("body", { overlayColor: "#000000", state: "success", message: $("#message_loading").val() }),
            $.ajax(base_url_admin + "/blog/treeblog/" + e + "?flag=" + t, {
                method: "GET",
                success: function (t) {
                    KTApp.unblock("body"), t.success && $(".jstree-children-" + e).html(t.html);
                },
            }).always(function () {}));
}
function auto_format_price(e) {
    $(e).on("keyup", function (e) {
        if ("" === window.getSelection().toString() && -1 === $.inArray(e.keyCode, [38, 40, 37, 39])) {
            var t,
                o = $(this);
            (t = (t = (t = o.val()).replace(/[\D\s\._\-]+/g, "")) ? parseInt(t, 10) : 0),
                o.val(function () {
                    return 0 === t ? "" : t.toLocaleString("en-US");
                });
        }
    });
}
function active_tab(e) {
    window.location.hash = "#!" + e;
}
KTUtil.ready(function () {
    KTProduct.init();
});
