<?php

return [

'list' => [
    'header_title' => 'Quản lý đánh giá sản phẩm',
    'note' => 'Nhấn chuột vào các trạng thái để đổi trạng thái',
    'code' => 'Mã sản phẩm',
    'status' => [
        'header' => 'Trạng thái',
        'None' => '--Trạng thái--',
        'A' => 'Đã duyệt',
        'D' => 'Chưa duyệt'

    ],
    'review' => [
        'A' => 'Đã chọn làm Review Raiting',
        'D' => 'Chưa chọn làm Review Raiting'
    ]
    ],
    'add' =>[
        'form' =>[
            'errors' =>[
                'title' => 'Đã sảy ra lỗi, đánh giá không thành công',
                'required' => 'Không được để trống',
                'email' => 'Email này không hợp lệ',
                'emailed' => 'Bạn đã từng đánh giá, không thể đánh giá thêm',
                'product_id' => 'Sản phẩm',
                'star' => 'Sao',
                'name' => 'Tên',
            ],
            'success' => [
                'title' => 'Đánh giá thành công'
            ]
        ]
    ]
];
