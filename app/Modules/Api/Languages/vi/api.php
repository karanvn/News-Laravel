<?php

return [
    'statuses' => [
        'D' => 'Vô hiệu',
        'A' => 'Kích hoạt'
    ],

    'genders' => [
        'M' => 'Nam',
        'F' => 'Nữ'
    ],

    'common' => [
        'submit' => 'THỰC HIỆN',
        'get_data' => 'LẤY DỮ LIỆU',
        'input' => 'ĐẦU VÀO',
        'output' => 'ĐẦU RA',
        'url' => 'URL',
        'success' => 'Thành công',
        'error' => 'Thất bại',
        'method' => 'Method',
        'params' => 'Params'
    ],

    'product' => [
        'filters' => [
            'box_products' => '---1. Danh sách sản phẩm---',
            'box_product' => '---2. Chi tiết sản phẩm---',
            'box_categories' => '---3. Danh mục---'
        ],
        'msg' => [
            'empty' => 'Không có dữ liệu'
        ],
        'header_title' => 'APIs SẢN PHẨM',
        'view_detail' => 'Chi tiết',
        'products' => [
            'header' => 'DANH SÁCH SẢN PHẨM',
            'url' => '/api/products',
            'method' => 'GET',
            'params' => [
                'name' => 'Tên sản phẩm',
                'category_ids' => 'Mã danh mục (category_ids=0,1,2)',
                'page' => 'Trang',
                'limit' => 'Giới hạn (Mặc định=20)'
            ],
            'exp' => [
                'header' => 'XEM MẪU',
                'name' => 'Tên',
                'page' => 'Trang'

            ]
        ],

        'product' => [
            'header' => 'CHI TIẾT SẢN PHẨM',
            'url' => '/api/product/{id}',
            'method' => 'GET',
            'params' => [
                'id' => 'id: Mã'
            ],
            'exp' => [
                'header' => 'XEM MẪU',
                'product_id' => 'Mã',
            ],

            'msg' => [
                'product_id' => 'Không tìm thấy sản phẩm'
            ]
        ],

        'categories' => [
            'header' => 'DANH SÁCH DANH MỤC',
            'url' => '/api/categories?category_id=',
            'method' => 'GET',
            'params' => [
                'category_id' => 'category_id : Mã danh mục cha (Mặc định = 0)'
            ],
            'exp' => [
                'header' => 'XEM MẪU',
                'category_id' => 'Danh mục cha'

            ],

            'msg' => [
                'category_id' => 'Không tìm thấy danh mục'
            ]
        ],
    ],

    'banner' => [
        'filters' => [
            'box_banners' => '---1. Danh sách banners---',
        ],
        'msg' => [
            'empty' => 'Không có dữ liệu'
        ],
        'header_title' => 'APIs BANNERS',
        'view_detail' => 'Chi tiết',
        'types' => [
            '0' => '---Chọn loại---',
            'SLIDE' => 'Slide',
            'PRODUCT' => 'Sản phẩm',
            'CATEGORY' => 'Danh mục'
        ],
        'banners' => [
            'header' => 'DANH SÁCH BANNERS',
            'url' => '/api/banners',
            'method' => 'GET',
            'params' => [
                'type' => 'Loại (type=SLIDE, CATEGORY, PRODUCT)',
            ],
            'exp' => [
                'header' => 'XEM MẪU',
                'type' => 'Loại',
                'page' => 'Trang'

            ]
        ],
    ],

    'order' => [
        'filters' => [
            'box_add_order' => '---1. Thêm đơn hàng---',
        ],
        'msg' => [
            'empty' => 'Không có dữ liệu'
        ],
        'header_title' => 'APIs ĐƠN HÀNG',
        'view_detail' => 'Chi tiết',
        'add_order' => [
            'header' => 'TẠO ĐƠN HÀNG',
            'url' => '/api/order',
            'method' => 'POST',
            'params' => [
                'user_id' => 0,
                'name' => 'Phan Nguyên',
                'email' => 'pcnguyen1@gmail.com',
                'shipping' => [
                    's_phone' => '0909090909',
                    's_address' => '70 Lữ Gia',
                    's_state' => 437,
                    's_district' => 512,
                    's_ward' => 140
                ],
                'products' => [
                    [
                        'product_id' => 1,
                        'amount' => 1
                    ],
                    [
                        'product_id' => 2,
                        'amount' => 2
                    ]
                ],
                'notes' => 'Gọi điện trước khi giao 30p'
            ],

            'exp' => [
                'header' => 'XEM MẪU',

            ]
        ],
    ],

    'location' => [
        'filters' => [
            'box_states' => '---1. Danh sách Tỉnh/Thành---',
            'box_districts' => '---2. Danh sách Quận/Huyện---',
            'box_wards' => '---3. Danh sách Phường/Xã---',
        ],
        'msg' => [
            'empty' => 'Không có dữ liệu'
        ],
        'header_title' => 'APIs KHU VỰC',
        'view_detail' => 'Chi tiết',
        'states' => [
            'header' => 'DANH SÁCH TỈNH/THÀNH',
            'url' => '/api/states',
            'method' => 'GET',
            'params' => [

            ],

            'exp' => [
                'header' => 'XEM MẪU',

            ],
            'msg' => [
                'empty' => 'Không có dữ liệu'
            ]
        ],

        'districts' => [
            'header' => 'DANH SÁCH QUẬN/HUYỆN',
            'url' => '/api/{state_id}/districts',
            'method' => 'GET',
            'params' => [

            ],

            'exp' => [
                'header' => 'XEM MẪU',

            ],
            'msg' => [
                'empty' => 'Không có dữ liệu'
            ]
        ],

        'wards' => [
            'header' => 'DANH SÁCH PHƯỜNG/XÃ',
            'url' => '/api/{district_id}/wards',
            'method' => 'GET',
            'params' => [

            ],

            'exp' => [
                'header' => 'XEM MẪU',

            ],
            'msg' => [
                'empty' => 'Không có dữ liệu'
            ]
        ],
    ],

    'user' => [
        'filters' => [
            'box_add_user' => '---1. Thêm khách hàng---',
            'box_update_user' => '---2. Cập nhật khách hàng---',
            'box_user' => '---3. Chi tiết khách hàng---',
            'box_add_shipping' => '---4. Thêm địa chỉ giao hàng---',
            'box_update_shipping' => '---5. Cập nhật địa chỉ giao hàng---',
            'box_update_shipping' => '---6. ---'
            /*'box_users' => '---Danh sách khách hàng---',
            'box_shippings' => '---Danh sách địa chỉ giao hàng---',
            'box_orders' => '---Danh sách đơn hàng---',*/
        ],

        'msg' => [
            'empty' => 'Không có dữ liệu'
        ],
        'header_title' => 'APIs KHÁCH HÀNG',
        'view_detail' => 'Chi tiết',
        'users' => [
            'header' => 'DANH SÁCH KHÁCH HÀNG',
            'url' => '/api/users',
            'method' => 'GET',
            'params' => [
                'email' => 'email (VD: binbin@gmail.com)',
                'name' => 'name (VD: Cuden)',
                'page' => 'page (VD: 1)',
            ]
        ],

        'user' => [
            'header' => 'CHI TIẾT KHÁCH HÀNG',
            'url' => '/api/user/{id}',
            'method' => 'GET',
            'params' => [
                'id' => 'id: Mã KH',
            ]
        ],

        'add_user' => [
            'header' => 'TẠO KHÁCH HÀNG',
            'url' => '/api/user',
            'method' => 'POST',
            'params' => [
                'name' => 'Phan Nguyen',
                'email' => 'phan.nguyen@gmail.com',
                'phone' => '0909090909',
                'password' => '123456',
                're_password' => '123456',
                'gender' => 'M',
                'bod' => '1986-12-20'
            ],

            'exp' => [
                'header' => 'XEM MẪU',

            ]
        ],

        'update_user' => [
            'header' => 'CẬP NHẬT KHÁCH HÀNG',
            'url' => '/api/user/{id}',
            'method' => 'PUT',
            'params' => [
                'name' => 'Phan Nguyen',
                'phone' => '0909090909',
                'gender' => 'M',
                'bod' => '1986-12-20'
            ],

            'exp' => [
                'header' => 'XEM MẪU',

            ]
        ],

        'add_shipping' => [
            'header' => 'TẠO ĐỊA CHỈ GIAO HÀNG',
            'url' => '/api/shipping',
            'method' => 'POST',
            'params' => [
                'user_id' => 0,
                'name' => 'Phan Nguyen',
                'phone' => '0909090909',
                'address' => '70 Lữ Gia',
                'state_id' => 437,
                'district_id' => 512,
                'ward_id' => 140
            ],

            'exp' => [
                'header' => 'XEM MẪU',

            ],

            'response' => [
                'user_not_found' => 'Tài khoản khách hàng không tồn tại'
            ]
        ],

        'update_shipping' => [
            'header' => 'CẬP NHẬT ĐỊA CHỈ GIAO HÀNG',
            'url' => '/api/shipping/{id}',
            'method' => 'PUT',
            'params' => [
                'user_id' => 0,
                'name' => 'Phan Nguyen',
                'phone' => '0909090909',
                'address' => '70 Lữ Gia',
                'state_id' => 437,
                'district_id' => 512,
                'ward_id' => 140
            ],

            'exp' => [
                'header' => 'XEM MẪU',

            ],

            'response' => [
                'user_not_found' => 'Tài khoản khách hàng không tồn tại'
            ]
        ],

        'shippings' => [
            'header' => 'ĐỊA CHỈ KHÁCH HÀNG',
            'url' => '/api/{id}/shippings',
            'method' => 'GET',
            'params' => [
                'id' => 'id: Mã KH',
            ],
            'response' => [
                'empty' => 'Chưa có địa chỉ giao hàng'
            ]
        ],

        'orders' => [
            'header' => 'DANH SÁCH ĐƠN HÀNG',
            'url' => '/api/{id}/orders',
            'method' => 'GET',
            'params' => [
                'id' => 'id: Mã KH',
            ],
            'response' => [
                'empty' => 'Chưa có đơn hàng'
            ]
        ]
    ],
];
