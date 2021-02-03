<?php

return [

    'list' => [
        'header_title' => 'DANH SÁCH NHÓM QUYỀN',
        'header_total' => 'Tổng',
        'header_add_btn' => 'Thêm',
        'filter' => [
            'name' => 'Tên',
            'status' => 'Trạng thái',
            'se_status' => '---Chọn trạng thái---',
            'btn' => 'TÌM KIẾM'
        ],
        'paginate' => [
            'display' => 'Hiển thị',
            'from' => 'từ',
            'to' => 'đến',
            'of' => 'trên tổng',
            'role' => 'Quyền'
        ]
    ],

    'statuses' => [
        'D' => 'Vô hiệu',
        'A' => 'Kích hoạt'
    ],

    'add' => [
        'header_title'        => 'THÊM NHÓM QUYỀN',
        'header_btn_back'     => 'Trở về',
        'header_btn_save'     => 'Lưu',

        'form' => [
            'name'                  => 'Tên',
            'status' => 'Trạng thái',
            'errors' => [
                'header' => 'Vui lòng nhập thông tin theo yêu cầu',
                'name' => 'Vui lòng nhập tên',
                'name_unique' => 'Tên đã tồn tại'
            ],
            'success' => [
                'add' => 'Tạo nhóm quyền thành công!',
                'edit' => 'Cập nhật nhóm quyền thành công'
            ]
        ]
    ],

    'edit' => [
        'header_title' => 'CẬP NHẬT NHÓM QUYỀN',
        'header_btn_save' => 'Cập Nhật'
    ],

    'user' => [
        'role' => 'ROLES',
        'permission' => 'PERMISSIONS'
    ]
];
