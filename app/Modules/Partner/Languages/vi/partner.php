<?php

return [

    'list' => [
        'header_title' => 'NHÀ CUNG CẤP',
        'header_add_btn' => 'Thêm',
        'header_total' => 'Tổng',
        'filter' => [
            'name' => 'Tên',
            'email' => 'Email',
            'phone' => 'Điện Thoại',
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
        'header_title'        => 'THÊM NHÀ CUNG CẤP',
        'header_btn_back'     => 'Trở về',
        'header_btn_save'     => 'Lưu',
        'header_tooltip'      => 'Nhập thông tin nhà cung cấp và lưu',
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
            'partner'               => 'Nhà cung cấp',
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

            'payment_type' => 'Loại thanh toán',
            'payment_period' => 'Ngày chốt thanh toán',
            'payment_bank_user' => 'Tên tài khoản',
            'payment_bank_name' => 'Tên ngân hàng',
            'payment_bank_branch' => 'Tên chi nhánh',
            'payment_bank_account' => 'Số tài khoản',
            'payment_type_values' => [
                'one' => 'Hàng tháng',
                'three' => 'Hàng quý'
            ],
            'payment_period_values' => [
                'half' => 'Giữa tháng',
                'end' => 'Cuối tháng'
            ],

            'invoice_name' => 'Người nhận',
            'invoice_code' => 'Mã số thuế',
            'invoice_address' => 'Địa chỉ',

            'picking_address' => 'Địa chỉ lấy hàng',


            'errors' => [
                'header' => 'Vui lòng nhập thông tin theo yêu cầu',
                'name' => 'Vui lòng nhập tên',
                'email' => 'Vui lòng nhập tài khoản email',
                'email_format' => 'Tài khoản email không hợp lệ',
                'email_exists' => 'Tài khoản mail đã tồn tài',
                'com_name' => 'Vui lòng nhập tên công ty',
                'address' => 'Vui lòng nhập địa chỉ',
                'address' => 'Vui lòng nhập địa chỉ',
                'state_id' => 'Vui lòng tỉnh/thành',
                'district_id' => 'Vui lòng quận/huyện',
                'ward_id' => 'Vui lòng phường/xã',
                'avatar' => 'Vui lòng nhập đúng định dạng file'
            ],
            'success' => [
                'add' => 'Tạo nhà cung cấp thành công!',
                'edit' => 'Cập nhật nhà cung cấp thành công'
            ]
        ]
    ],

    'edit' => [
        'header_title' => 'CẬP NHẬT NHÀ CUNG CẤP',
        'header_overview' => 'Tổng quan',
        'sub_overview' => 'Thông tin tổng quan nhà cung cấp',
        'header_personal' => 'Thông tin chung',
        'sub_personal' => 'Cập nhật thông tin chung',
        'header_payment' => 'Thanh toán',
        'sub_payment' => 'Thông tin thanh toán',
        'header_invoice' => 'Hoá đơn',
        'sub_invoice' => 'Thông tin xuất hoá đơn',
        'header_picking_address' => 'Địa chỉ lấy hàng',
        'sub_picking_address' => 'Thông tin địa chỉ lấy hàng',
        'header_user' => 'Tài khoản',
        'sub_user' => 'Các tài khoản',
        'header_btn_save' => 'Cập Nhật',
        'profile' => [
            'email' => 'Tài khoản',
            'phone' => 'Điện thoại',
            'address' => 'Địa điểm',
            'created_by' => 'Người tạo'
        ]
    ]
];
