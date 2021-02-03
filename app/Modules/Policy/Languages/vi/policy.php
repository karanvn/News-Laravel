<?php

return [

    'list' => [
        'header_title'   => 'CHÍNH SÁCH',
        'header_total'   => 'Tổng',
        'header_add_btn' => 'Thêm',
        'description'    => 'Mô tả',
        'filter' => [
            'name'      => 'Tên',
            'status'    => 'Trạng Thái',
            'se_status' => '---Chọn trạng thái---',
            'btn'       => 'TÌM KIẾM'
        ],
        'paginate' => [
            'display' => 'Hiển thị',
            'from'    => 'từ',
            'to'      => 'đến',
            'of'      => 'trên tổng'
        ]
    ],

    'statuses' => [
        '1' => 'Kích hoạt',
        '0' => 'Chưa kích hoạt',
    ],

    'add' => [
        'header_title'      => 'THÊM CHÍNH SÁCH',
        'header_btn_back'   => 'Trở về',
        'header_btn_save'   => 'Lưu',
        'header_tooltip'    => 'Nhập thông tin chính sách và lưu',
        'btn_save_continue' => 'Lưu và cập nhật',
        'btn_save_new'      => 'Lưu và tạo mới',
        'btn_save_exit'     => 'Lưu và thoát',

        'form' => [
            'header_general_info' => 'Thông tin chung',
            'header_contact_info' => 'Thông tin liên hệ',
            'name'                => 'Tên chính sách',
            'nick_name'           => 'Biệt danh',
            'com_name'            => 'Tên công ty',
            'email'               => 'Địa chỉ email',
            'icon'                => 'Icon',
            'phone'               => 'Điện thoại',
            'com_site'     => 'Website',
            'image'        => 'Hình ảnh',
            'image_change' => 'Đổi ảnh',
            'image_cancel' => 'Huỷ ảnh',
            'description'  => 'Mô tả',
            'status'       => 'Trạng thái',
            'allow_image_extension' => 'Cho phép định dạng: png, jpg, jpeg.',
            'statuses' => [
                '0' => 'Chưa kích hoạt',
                '1' => 'Kích hoạt'
            ],

            'errors' => [
                'header'       => 'Vui lòng nhập thông tin theo yêu cầu',
                'name'         => 'Vui lòng nhập tên',
                'email'        => 'Vui lòng nhập tài khoản email',
                'email_format' => 'Tài khoản email không hợp lệ',
                'email_exists' => 'Tài khoản mail đã tồn tài',
                'address'      => 'Vui lòng nhập địa chỉ',
                'state_id'     => 'Vui lòng tỉnh/thành',
                'district_id'  => 'Vui lòng quận/huyện',
                'ward_id'      => 'Vui lòng phường/xã',
                'avatar'       => 'Vui lòng nhập đúng định dạng file'
            ],
            'success' => [
                'add'  => 'Tạo chính sách thành công!',
                'edit' => 'Cập nhật chính sách thành công'
            ]
        ]
    ],

    'edit' => [
        'header_title'    => 'CẬP NHẬT CHÍNH SÁCH',
        'header_overview' => 'Tổng quan',
        'sub_overview'    => 'Thông tin tổng quan chính sách',
        'header_personal' => 'Thông tin cá nhân',
        'sub_personal'    => 'Cập nhật thông tin cá nhân',
        'header_payment'  => 'Thanh toán',
        'sub_payment'     => 'Thông tin thanh toán',
        'header_invoice'  => 'Hoá đơn',
        'sub_invoice'     => 'Thông tin xuất hoá đơn',
        'sub_user'        => 'Các tài khoản',
        'header_user'     => 'Tài khoản',
        'header_btn_save' => 'Cập Nhật',
        'header_picking_address' => 'Địa chỉ lấy hàng',
        'sub_picking_address'    => 'Thông tin địa chỉ lấy hàng',
    ]
];
