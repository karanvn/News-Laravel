<?php

return [

    'list' => [
        'header_title' => 'DANH SÁCH PERMISSION',
        'header_total' => 'Tổng',
        'header_add_btn' => 'Thêm',
        'filter' => [
            'name' => 'Tên',
            'btn' => 'TÌM KIẾM'
        ],
        'paginate' => [
            'display' => 'Hiển thị',
            'from' => 'từ',
            'to' => 'đến',
            'of' => 'trên tổng'
        ]
    ],

    'add' => [
        'header_title'        => 'THÊM PERMISSION',
        'header_btn_back'     => 'Trở về',
        'header_btn_save'     => 'Lưu',

        'form' => [
            'name'                  => 'Quyền',
            'title' => 'Tên',
            'errors' => [
                'header' => 'Vui lòng nhập thông tin theo yêu cầu',
                'name' => 'Vui lòng nhập quyền',
                'title' => 'Vui lòng nhập tên',
                'name_unique' => 'Quyền đã tồn tại'
            ],
            'success' => [
                'add' => 'Tạo permission thành công!',
                'edit' => 'Cập nhật permission thành công'
            ]
        ]
    ],

    'edit' => [
        'header_title' => 'CẬP NHẬT PERMISSION',
        'header_btn_save' => 'Cập Nhật'
    ]
];
