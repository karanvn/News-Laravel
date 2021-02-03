<?php

return [

    'list' => [
        'header_title' => 'DANH SÁCH TRANG TĨNH',
        'header_total' => 'Tổng',
        'header_add_btn' => 'Thêm',
        'header_sort_btn' => 'Sắp Xếp',
        'filter' => [
            'name' => 'Tên',
            'status' => 'Trạng Thái',
            'type' => 'Loại',
            'published' => 'Xuất Bản',
            'sort' => 'Kiểu xem',
            'sort_note' => 'Ghê chuột vào item kéo thả và bấm cập nhật để sắp xếp',
            'se_status' => '---Chọn trạng thái---',
            'se_type' => '---Chọn loại---',
            'se_published' => '---Chọn xuất bản---',
            'btn' => 'TÌM KIẾM'
        ],
        'item' => [

        ],
        'paginate' => [
            'display' => 'Hiển thị',
            'from' => 'từ',
            'to' => 'đến',
            'of' => 'trên tổng'
        ]
    ],

    'statuses' => [
        '1' => 'Kích hoạt',
        '2' => 'Vô hiệu'
    ],

    'published' => [
        'H' => 'Ẩn',
        'E' => 'Quá hạn',
        'A' => 'Hiện'
    ],

    'published_labels' => [
        'H' => 'warning',
        'E' => 'danger',
        'A' => 'primary'
    ],

    'sorts' => [
        '0' => 'Bình thường',
        '1' => 'Sắp xếp'
    ],

    'add' => [
        'header_title'        => 'THÊM TRANG TĨNH',
        'header_btn_back'     => 'Trở về',
        'header_btn_save'     => 'Lưu',

        'form' => [
            'name'      => 'Tên',
            'type'      => 'Loại',
            'extension' => 'Định dạng',
            'object_id' => 'Đối tượng',
            'titlebutton' => 'Nhãn nút',
            'link' => 'Liên kết',
            'avatar' => 'Ảnh',
            'avatar_change' => 'Đổi ảnh',
            'avatar_cancel' => 'Huỷ ảnh',
            'allow_image_extension' => 'Cho phép định dạng: png, jpg, jpeg.',
            'status' => 'Trạng thái',
            'published_start' => 'Ngày bắt đầu',
            'published_end' => 'Ngày kết thúc',
            'status' => 'Trạng thái',
            'link_youtube' => 'Đường link video youtube',
            'description' => 'Mô tả',
            'statuses' => [
                '2' => 'Vô hiệu',
                '1' => 'Kích hoạt'
            ],

            'errors' => [
                'header' => 'Vui lòng nhập thông tin theo yêu cầu',
                'name' => 'Vui lòng nhập tên',
                'published_start' => 'Ngày bắt đầu không được lớn hơn ngày kết thúc',
                'published_end' => 'Ngày kết thúc không được nhỏ hơn ngày bắt đầu',
                'avatar' => 'Vui lòng nhập ảnh',
                'avatar_format' => 'Vui lòng nhập ảnh đúng định dạng file',
                'object_id' => 'Vui lòng nhập đối tượng',
                'object_id_exists' => 'Đối tượng không tồn tại',
            ],
            'success' => [
                'add' => 'Tạo trang tĩnh thành công!',
                'edit' => 'Cập nhật trang tĩnh thành công'
            ]
        ]
    ],

    'edit' => [
        'header_title' => 'CẬP NHẬT TRANG TĨNH',
        'header_overview' => 'Tổng quan',
        'sub_overview' => 'Thông tin tổng quan trang tĩnh',
        'header_personal' => 'Thông tin cá nhân',
        'sub_personal' => 'Cập nhật thông tin cá nhân',
        'header_payment' => 'Thanh toán',
        'sub_payment' => 'Thông tin thanh toán',
        'header_invoice' => 'Hoá đơn',
        'sub_invoice' => 'Thông tin xuất hoá đơn',
        'header_picking_address' => 'Địa chỉ lấy hàng',
        'sub_picking_address' => 'Thông tin địa chỉ lấy hàng',
        'header_user' => 'Tài khoản',
        'sub_user' => 'Các tài khoản',
        'header_btn_save' => 'Cập Nhật'
    ]
];
