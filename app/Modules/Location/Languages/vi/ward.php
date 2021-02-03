<?php

return [
    'list' => [
        'header_title' => 'DANH SÁCH PHƯỜNG/XÃ',
        'header_total' => 'Tổng',
        'header_add_btn' => 'Thêm',
        'table' => [
            'stt' => 'STT',
            'name' => 'PHƯỜNG/XÃ',
            'state_id' => 'TỈNH/THÀNH PHỐ',
            'district_id' => 'QUẬN/HUYỆN',
            'status' => 'TRẠNG THÁI',
            'user_id' => 'NGƯỜI TẠO'
        ],
        'filter' => [
            'state_id' => 'Tỉnh/Thành Phố',
            'district_id' => 'Quận/Huyện',
            'ward_id' => 'Phường/Xã',
            'name' => 'Tên Quận/Huyện',
            'status' => 'Trạng Thái',
            'se_status' => '---Chọn trạng thái---',
            'se_state_id' => '---Chọn tỉnh/thành phố---',
            'btn' => 'TÌM KIẾM'
        ],
        'pagiante' => [
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
        'header_title'        => 'THÊM PHƯỜNG/XÃ',
        'header_btn_back'     => 'Trở về',
        'header_btn_save'     => 'Lưu',

        'form' => [

            'name'                  => 'Phường/Xã',
            'state_id'                  => 'Tỉnh/Thành Phố',
            'district_id'                  => 'Quận/Huyện',
            'btn_close'                 => 'Đóng',
            'btn_save'                 => 'Lưu',
            'status' => 'Trạng thái',
            'statuses' => [
                'D' => 'Vô hiệu',
                'A' => 'Kích hoạt'
            ],

            'errors' => [
                'header' => 'Vui lòng nhập thông tin theo yêu cầu',
                'name' => 'Vui lòng nhập phường/xã',
                'state_id' => 'Vui lòng nhập tỉnh/thành phố',
                'district_id' => 'Vui lòng nhập quận/huyện',
            ],
            'success' => [
                'add' => 'Tạo phường/xã phố thành công!',
                'edit' => 'Cập nhật phường/xã thành công'
            ]
        ]
    ],

    'edit' => [
        'header_title' => 'CẬP NHẬT PHƯỜNG/XÃ'
    ]

];
