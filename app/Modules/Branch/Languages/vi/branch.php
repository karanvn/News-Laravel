<?php

return [

    'list' => [
        'header_title' => 'THƯƠNG HIỆU',
        'header_total' => 'Tổng',
        'header_add_btn' => 'Thêm',
        'description' => 'Mô tả',
        'filter' => [
            'name' => 'Tên',
            'status' => 'Trạng Thái',
            'se_status' => '---Chọn trạng thái---',
            'btn' => 'TÌM KIẾM'
        ],
        'paginate' => [
            'display' => 'Hiển thị',
            'from' => 'từ',
            'to' => 'đến',
            'of' => 'trên tổng'
        ]
    ],

    'statuses' => [
        'D' => 'Vô hiệu',
        'A' => 'Kích hoạt'
    ],

    'add' => [
        'header_title'        => 'THÊM THƯƠNG HIỆU',
        'header_btn_back'     => 'Trở về',
        'header_btn_save'     => 'Lưu',
        'header_tooltip'      => 'Nhập thông tin thương hiệu và lưu',
        'btn_save_continue'   => 'Lưu và cập nhật',
        'btn_save_new'        => 'Lưu và tạo mới',
        'btn_save_exit'       => 'Lưu và thoát',

        'form' => [

            'header_general_info'   => 'Thông tin chung',
            'header_contact_info'   => 'Thông tin liên hệ',
            'name'                  => 'Tên',
            'nick_name'             => 'Biệt danh',
            'com_name'              => 'Tên công ty',
            'email'                 => 'Địa chỉ email',
            'address'               => 'Địa chỉ',
            'phone'                 => 'Điện thoại',
            'com_site' => 'Website',
            'avatar' => 'Ảnh đại diện',
            'avatar_change' => 'Đổi ảnh',
            'avatar_cancel' => 'Huỷ ảnh',
            'allow_image_extension' => 'Cho phép định dạng: png, jpg, jpeg.',
            'description' => 'Mô tả',
            'status' => 'Trạng thái',
            'statuses' => [
                'D' => 'Vô hiệu',
                'A' => 'Kích hoạt'
            ],

            'errors' => [
                'header' => 'Vui lòng nhập thông tin theo yêu cầu',
                'name' => 'Vui lòng nhập tên',
                'email' => 'Vui lòng nhập tài khoản email',
                'email_format' => 'Tài khoản email không hợp lệ',
                'email_exists' => 'Tài khoản mail đã tồn tài',
                'address' => 'Vui lòng nhập địa chỉ',
                'state_id' => 'Vui lòng tỉnh/thành',
                'district_id' => 'Vui lòng quận/huyện',
                'ward_id' => 'Vui lòng phường/xã',
                'avatar' => 'Vui lòng nhập đúng định dạng file'
            ],
            'success' => [
                'add' => 'Tạo thương hiệu thành công!',
                'edit' => 'Cập nhật thương hiệu thành công'
            ]
        ]
    ],

    'edit' => [
        'header_title' => 'CẬP NHẬT THƯƠNG HIỆU',
        'header_overview' => 'Tổng quan',
        'sub_overview' => 'Thông tin tổng quan thương hiệu',
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
