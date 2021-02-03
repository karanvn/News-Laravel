<?php

return [
    'list' => [
        'header_title' => 'DANH SÁCH TỈNH/THÀNH PHỐ',
        'header_total' => 'Tổng',
        'header_add_btn' => 'Thêm',
        'table' => [
            'stt' => 'STT',
            'name' => 'QUẬN/HUYỆN',
            'status' => 'TRẠNG THÁI',
            'user_id' => 'NGƯỜI TẠO'
        ],
        'filter' => [
            'state_id' => 'Tỉnh/Thành Phố',
            'status' => 'Trạng Thái',
            'se_status' => '---Chọn trạng thái---',
            'btn' => 'TÌM KIẾM'
        ],
        'paginate' => [
            'district_id' => 'Quận/Huyện',
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
        'header_title'        => 'THÊM TỈNH/THÀNH PHỐ',
        'header_btn_back'     => 'Trở về',
        'header_btn_save'     => 'Lưu',

        'form' => [

            'name'                  => 'Tỉnh/Thành Phố',
            'shipping'              => 'Phí ship',
            'freeship'              => 'Free ship với các đơn hàng từ',
            'select_state_id'                  => '---Chọn tỉnh/thành phố---',
            'btn_close'                 => 'Đóng',
            'btn_save'                 => 'Lưu',
            'status' => 'Trạng thái',
            'statuses' => [
                'D' => 'Vô hiệu',
                'A' => 'Kích hoạt'
            ],

            'errors' => [
                'header' => 'Vui lòng nhập thông tin theo yêu cầu',
                'name' => 'Vui lòng nhập tên',
            ],
            'success' => [
                'add' => 'Tạo tỉnh/thành phố thành công!',
                'edit' => 'Cập nhật tỉnh/thành phố thành công'
            ]
        ]
    ],

    'edit' => [
        'header_title' => 'CẬP NHẬT TỈNH/THÀNH PHỐ'
    ]

];
