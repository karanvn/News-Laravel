var KTSetting = {
    init: function () {
        var e;
        (e = base_url_admin + "/setting/general"),
            $("#frmAddSetting").submit(function () {
                return (
                    KTApp.block("body", { overlayColor: "#000000", state: "success", message: $("#message_loading").val() }),
                    $.ajax(e, {
                        method: "POST",
                        data: new FormData(this),
                        dataType: "JSON",
                        contentType: !1,
                        cache: !1,
                        processData: !1,
                        success: function (e) {
                            if (($(".text-error").text(" "), e.success)) toastr.success(e.toastr), location.reload();
                            else {
                                for (var t in (toastr.error(e.toastr), e.errors)) $("." + t + "-error").text(e.errors[t][0]);
                                KTApp.unblock("body");
                            }
                        },
                    }),
                    !1
                );
            });
    },
};
KTUtil.ready(function () {
    KTSetting.init();
}),
    $("#add_box").click(function (e) {
        $(this).before(
            '<div class="cards card-custom card-stretch bg-light-wh @if($i != 0) mt-5 @endif"><div class="card-body"><div class="col-lg-12"><div class="form-group row add_box"><label class="col-form-label">Tên chính sách</label><input class="form-control form-control-lgs" type="text" name="POLICY[name][]" placeholder="" value=""><label class="col-form-label">Mô tả</label><textarea class="form-control form-control-lgs" name="POLICY[desc][]" placeholder=""></textarea><label class="col-form-label">Icon</label><input class="form-control form-control-lgs" type="text" name="POLICY[icon][]" placeholder="" value=""></div></div></div></div><span title="Remove" class="btn btn-flat btn-sm btn-danger removeBox"><i class="fa fa-times"></i></span>'
        ),
            $(".removeBox").click(function (e) {
                $(this).closest("div").remove();
            });
    }),
    $("#add_boxCount").click(function (e) {
        $(this).before(
            '<div class="card-body"><div class="col-lg-12"><div class="form-group row"><label class="col-form-label">Tên</label><input class="form-control form-control-lgs" type="text" name="COUNTHOT[name][]" placeholder="" value=""><label class="col-form-label">Số lượng</label><input class="form-control form-control-lgs" type="text" name="COUNTHOT[count][]" placeholder="" value=""><label class="col-form-label">Icon</label><input class="form-control form-control-lgs" type="text" name="COUNTHOT[icon][]" placeholder="" value=""> </div></div></div>'
        )
    }),
    $("#add_boxExpertise").click(function (e) {
        $(this).before(
            '<div class="card-body"><div class="col-lg-12"><div class="form-group row"><label class="col-form-label">Tên</label><input class="form-control form-control-lgs" type="text" name="EXPERTISE[name][]" placeholder="" value=""><label class="col-form-label">Phần trăm</label><input class="form-control form-control-lgs" type="text" name="EXPERTISE[count][]" placeholder="" value=""></div></div></div>'
        )
    }),
    $("#add_boxPringcing").click(function (e) {
        $(this).before(
            '<div class="card-body"><div class="col-lg-12"><div class="form-group row"><label class="col-form-label">Loại</label><input class="form-control form-control-lgs" type="text" name="PRICING[type][]" placeholder="" value=""><label class="col-form-label">Tên</label> <input class="form-control form-control-lgs" type="text" name="PRICING[name][]" placeholder="" value=""><label class="col-form-label">Giá</label><input class="form-control form-control-lgs" type="number" name="PRICING[price][]" placeholder="" value=""><label class="col-form-label">Giới thiệu</label><input class="form-control form-control-lgs" type="text" name="PRICING[discription][]" placeholder="" value=""></div></div></div>'
            )
    }),


    $(".removeBox").click(function (e) {
        alert(1), $(this).closest(".add_box").remove();
    });
