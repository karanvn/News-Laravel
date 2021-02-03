<?php

return [

    'list' => [
        'header_title' => 'DANH SÁCH ROLE',
        'header_total' => 'Tổng',
        'header_add_btn' => 'Thêm',
        'permission' => 'Quyền',
        'rule' => 'Nhóm',
        'filter' => [
            'name' => 'Tên',
            'rule_id' => 'Nhóm Quyền',
            'se_rule_id' => '--- Chọn nhóm quyền---',
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
        'header_title'        => 'THÊM ROLE',
        'header_btn_back'     => 'Trở về',
        'header_btn_save'     => 'Lưu',

        'form' => [
            'name'                  => 'Tên',
            'rule_id' => 'Nhóm quyền',
            'permission_id' => 'Quyền',
            'errors' => [
                'header' => 'Vui lòng nhập thông tin theo yêu cầu',
                'name' => 'Vui lòng nhập tên',
                'name_unique' => 'Tên đã tồn tại'
            ],
            'success' => [
                'add' => 'Tạo role thành công!',
                'edit' => 'Cập nhật role thành công'
            ]
        ]
    ],

    'edit' => [
        'header_title' => 'CẬP NHẬT ROLE',
        'header_btn_save' => 'Cập Nhật'
    ]
];
