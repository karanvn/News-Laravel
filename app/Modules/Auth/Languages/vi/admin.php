<?php

return [
    'list' => [
        'header_title' => 'TÀI KHOẢN QUẢN TRỊ',
        'header_total' => 'Tổng',
        'header_add_btn' => 'Thêm',
        'filter' => [
            'id' => 'Mã',
            'name' => 'Tên',
            'email' => 'Email',
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

    'genders' => [
        'M' => 'Nam',
        'F' => 'Nữ',
        'O' => 'Khác'
    ],

    'add' => [
        'header_title'        => 'THÊM TÀI KHOẢN QUẢN TRỊ',
        'header_btn_back'     => 'Trở về',
        'header_btn_save'     => 'Lưu',

        'form' => [

            'header_general_info'   => 'Thông tin chung',
            'header_contact_info'   => 'Thông tin liên hệ',
            'name'                  => 'Tên',
            'password'              => 'Mật khẩu',
            're_password'           => 'Nhập lại mật khẩu',
            'email'                 => 'Email',
            'partner'                 => 'Nhà cung cấp',
            'avatar' => 'Ảnh đại diện',
            'avatar_change' => 'Đổi ảnh',
            'avatar_cancel' => 'Huỷ ảnh',
            'allow_image_extension' => 'Cho phép định dạng: png, jpg, jpeg.',
            'status' => 'Trạng thái',
            'gender' => 'Giới tính',
            'position' => 'Vị trí',
            'genders' => [
                'M' => 'Nam',
                'F' => 'Nữ',
                'O' => 'Khác'
            ],
            'bod' => 'Ngày sinh',
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
                'password' => 'Vui lòng nhập mật khẩu',
                'password_min' => 'Chiều dài mật khẩu tối thiểu là 6',
                're_password' => 'Vui lòng nhập lại mật khẩu',
                're_password_same' => 'Mật khẩu không giống nhau',
                'avatar' => 'Vui lòng nhập đúng định dạng file'
            ],
            'success' => [
                'add' => 'Tạo tài khoản thành công!',
                'edit' => 'Cập nhật tài khoản thành công',
                'rule' => 'Xét quyền cho tài khoản thành công'
            ]
        ]
    ],

    'edit' => [
        'header_title' => 'CẬP NHẬT TÀI KHOẢN QUẢN TRỊ',
        'header_general' => 'Thông tin chung',
        'sub_general' => 'Thông tin chung của tài khoản',
        'header_password' => 'Đổi mật khẩu',
        'sub_password' => 'Thay đổi mật khẩu',
        'header_rule' => 'Phân quyền',
        'sub_rule' => 'Phân quyền tài khoản',
        'header_rule_btn' => 'Cấp quyền',
        'header_btn_save' => 'Lưu',
        'header_history' => 'Lịch sử',
        'profile' => [
            'gender' => 'Giới tính',
            'email' => 'Tài khoản',
            'created_at' => 'Ngày tạo',
            'created_by' => 'Người tạo',
            'last_login' => 'Truy cập'
        ]
    ]

];
