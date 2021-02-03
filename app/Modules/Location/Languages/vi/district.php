<?php

return [
    'list' => [
        'header_title' => 'DANH SÁCH QUẬN/HUYỆN',
        'header_total' => 'Tổng',
        'header_add_btn' => 'Thêm',
        'table' => [
            'stt' => 'STT',
            'name' => 'QUẬN/HUYỆN',
            'state_id' => 'TỈNH/THÀNH PHỐ',
            'status' => 'TRẠNG THÁI',
            'user_id' => 'NGƯỜI TẠO'
        ],
        'filter' => [
            'state_id' => 'Tỉnh/Thành Phố',
            'district_id' => ' Quận/Huyện',
            'name' => 'Tên Quận/Huyện',
            'status' => 'Trạng Thái',
            'se_status' => '---Chọn trạng thái---',
            'se_state_id' => '---Chọn tỉnh/thành phố---',
            'btn' => 'TÌM KIẾM'
        ],
        'paginate' => [
            'ward_id' => 'Phường/Xã',
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
        'header_title'        => 'THÊM QUẬN/HUYỆN',
        'header_btn_back'     => 'Trở về',
        'header_btn_save'     => 'Lưu',

        'form' => [

            'name'                  => 'Quận/Huyện',
            'state_id'                  => 'Tỉnh/Thành Phố',
            'btn_close'                 => 'Đóng',
            'btn_save'                 => 'Lưu',
            'status' => 'Trạng thái',
            'statuses' => [
                'D' => 'Vô hiệu',
                'A' => 'Kích hoạt'
            ],

            'errors' => [
                'header' => 'Vui lòng nhập thông tin theo yêu cầu',
                'state_id' => 'Vui lòng nhập tỉnh/thành phố',
                'name' => 'Vui lòng nhập quận/huyện',
            ],
            'success' => [
                'add' => 'Tạo quận/huyện thành công!',
                'edit' => 'Cập nhật quận/huyện thành công'
            ]
        ]
    ],

    'edit' => [
        'header_title' => 'CẬP NHẬT QUẬN/HUYỆN'
    ]

];
