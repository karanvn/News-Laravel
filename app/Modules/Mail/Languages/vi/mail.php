<?php

return [
    'statuses' => [
        'D' => 'Vô hiệu',
        'A' => 'Kích hoạt'
    ],

    'positions' =>  [
        'H' => 'HEADER',
        'C' => 'CONTENT',
        'F' => 'FOOTER'
    ],

    'shows' => [
        'I' => 'ITEM',
        'L' => 'LIST'
    ],

    'block' => [
        'list' => [
            'header_total' => 'Tổng',
            'header_title' => 'DANH SÁCH BLOCK',
            'header_add_btn' => 'Thêm'
        ],
        'add' => [
            'header_title'        => 'THÊM BLOCK',
            'header_btn_back'     => 'Trở về',
            'header_btn_save'     => 'Lưu',
            'header_btn_add_banner'     => 'Thêm',
            'header_btn_cancel_banner'     => 'Huỷ',

            'form' => [
                'name'                  => 'Tên',
                'file_name' => 'Tên View',
                'position_type'         => 'Vị trí',
                'show_type' => 'Hiển thị',
                'status' => 'Trạng thái',
                'html' => 'Nội dung',
                'errors' => [
                    'header' => 'Vui lòng nhập thông tin theo yêu cầu',
                    'name' => 'Vui lòng nhập tên',
                    'file_name' => 'Vui lòng nhập tên file',
                    'html' => 'Vui lòng nhập nội dung'
                ],
                'success' => [
                    'add' => 'Tạo block thành công!',
                    'edit' => 'Cập nhật block thành công'
                ]
            ]
        ],

        'edit' => [
            'header_title' => 'CẬP NHẬT BLOCK',
            'header_btn_save' => 'Cập Nhật'
        ]
    ],

    'tpl' => [
        'list' => [
            'header_total' => 'Tổng',
            'header_title' => 'DANH SÁCH MẪU',
            'header_add_btn' => 'Thêm'
        ],
        'types' => [
            'ORDER_CREATE' => '---Đặt thành công đơn hàng---',
            'USER_CREATE' => '---Tạo tài khoản---',
            'USER_FORGOT_PASSWORD' => '---Quên mật khẩu---',
            'FEEDBACK_CUSTOMER' => '---Phản hồi khách hàng---',
            'RECIVE_INFO' => '---Đăng ký nhận thông tin---',
            'HAPPY_BIRTHDAY' => '---Chúc mừng sinh nhật---',

        ],

        'add' => [
            'header_title'        => 'THÊM MẪU',
            'header_btn_back'     => 'Trở về',
            'header_btn_save'     => 'Lưu',
            'header_btn_add_banner'     => 'Thêm',
            'header_btn_cancel_banner'     => 'Huỷ',

            'form' => [
                'header_general_info' => 'Thông tin chung',
                'header_parterm' => 'Mẫu',
                'name'                  => 'Tên',
                'subject' => 'Tiêu đề',
                'summary' => 'Tóm tắt',
                'email' => 'Email',
                'type' => 'Loại',
                'status' => 'Trạng thái',
                'errors' => [
                    'header' => 'Vui lòng nhập thông tin theo yêu cầu',
                    'name' => 'Vui lòng nhập tên',
                    'subject' => 'Vui lòng nhập tiêu đề',
                    'type' => 'Loại đã tồn tại',
                    'block-ids' => 'Vui lòng chọn mẫu'
                ],
                'success' => [
                    'add' => 'Tạo mẫu thành công!',
                    'edit' => 'Cập nhật mẫu thành công'
                ]
            ]
        ],

        'edit' => [
            'header_title' => 'CẬP NHẬT MẪU',
            'header_btn_save' => 'Cập Nhật'
        ]
    ]
];
