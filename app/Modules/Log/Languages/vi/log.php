<?php

return [
    'statuses' => [
        'A' => 'Kích hoạt',
        'D' => 'Vô hiệu'
    ],

    'genders' => [
        'M' => 'Nam',
        'F' => 'Nữ',
        'O' => 'Khác'
    ],

    'order_statuses' => [
        'PLN' => 'Mới đặt',
        'PLP' => 'Đã thanh toán',
        'CONF' => 'Xác nhận',
        'SHIP' => 'Đang giao hàng',
        'SHIF' => 'Giao hàng thất bại',
        'CAN' => 'Huỷ',
        'COM' => 'Hoàn tất',
    ],

    'types' => [
        'create_feature' => 'tạo thuộc tính',
        'update_feature' => 'cập nhật thuộc tính',
        'create_category' => 'tạo danh mục',
        'update_category' => 'cập nhật danh mục',
        'create_branch' => 'tạo thương hiệu',
        'update_branch' => 'cập nhật thương hiệu',
        'create_order' => 'tạo đơn hàng',
        'update_order' => 'cập nhật đơn hàng',
        'create_product' => 'thêm sản phẩm',
        'update_product' => 'cập nhật sản phẩm',
        'create_child_product' => 'thêm SKU',
        'update_child_product' => 'cập nhật SKU',
        'create_customer' => 'tạo khách hàng',
        'update_customer' => 'cập nhật khách hàng',
        'create_shipping' => 'tạo địa chỉ giao hàng',
        'update_shipping' => 'cập nhật địa chỉ giao hàng',
        'create_admin' => 'tạo tài khoản quản trị',
        'update_admin' => 'cập nhật tài khoản quản trị',
        'create_banner' => 'tạo banner',
        'update_banner' => 'cập nhật banner',
        'create_rule' => 'tạo nhóm quyền',
        'update_rule' => 'cập nhật nhóm quyền',
        'create_role' => 'tạo vai trò',
        'update_role' => 'cập nhật vai trò',
        'create_permission' => 'tạo quyền',
        'update_permission' => 'cập nhập quyền',
    ],

    'classes' => [
        'PRODUCT' => 'success',
        'ORDER' => 'primary',
        'CATEGORY' => 'info',
        'USER'  => 'warning',
        'BRANCH' => 'danger',
        'CUSTOMER' => 'dark',
        'ADMIN' => 'dark',
        'BANNER' => 'danger'
    ],

    'other' => [
        'title' => 'Hoạt động gần đây',
        'detail' => 'Chi tiết',
        'total' => 'Tổng'
    ],

    'titles' => [
        'rule' => [
            'name' => 'Tên',
            'status' => 'Trạng thái'
        ],
        'role' => [
            'name' => 'Tên',
            'status' => 'Trạng thái',
            'rule_id' => 'Nhóm vai trò',
            'permission_ids' => 'Quyền',
            'del_permission' => 'Xoá',
            'add_permission' => 'Thêm'
        ],
        'permission' => [
            'name' => 'Tên'
        ],
        'banner' => [
            'name' => 'Tên',
            'type' => 'Loại',
            'published_start' => 'Ngày bắt đầu',
            'published_end' => 'Ngày kết thúc',
            'link' => 'Liên kết',
            'object_id' => 'Đối tượng',
            'status' => 'Trạng thái'
        ],
        'branch' => [
            'name' => 'Tên',
            'address' => 'Địa chỉ',
            'status' => 'Trạng thái',
            'description' => 'Mô tả'
        ],
        'category' => [
            'name' => 'Tên',
            'parent_id' => 'Danh mục cha',
            'status' => 'Trạng thái'
        ],
        'feature' => [
            'name' => 'Tên',
            'parent_id' => 'Danh mục cha',
            'status' => 'Trạng thái'
        ],
        'order' => [
            'name' => 'Tên',
            'order' => 'Tạo đơn hàng',
            'cs_notes' => 'Ghi chú',
            'status' => 'Trạng thái',
        ],
        'customer' => [
            'name' => 'Tên',
            'email' => 'Email',
            'phone' => 'Điện thoại',
            'gender' => 'Giới tính',
            'bod' => 'Ngày sinh',
            'status' => 'Trạng thái'
        ],
        'shipping' => [
            'name' => 'Người nhận',
            'phone' => 'Điện thoại',
            'address' => 'Địa chỉ',
            'state_id' => 'Tỉnh/Thành Phố',
            'district_id' => 'Quận/Huyện',
            'ward_id' => 'Phường/Xã',
            'position' => 'Vị trí',
            'status' => 'Trạng thái'
        ],
        'admin' => [
            'name' => 'Tên',
            'email' => 'Email',
            'phone' => 'Điện thoại',
            'position' => 'Vị trí',
            'gender' => 'Giới tính',
            'bod' => 'Ngày sinh',
            'status' => 'Trạng thái'
        ],
        'product' => [
            'avail_since' => 'OnDeal',
            'avail_to' => 'OffDeal',
            'branch_id' => 'Thương hiệu',
            'category_ids' => 'Danh mục',
            'add_category' => 'Thêm danh mục',
            'delete_category' => 'Xoá danh mục',
            'name' => 'Tên',
            'short_name' => 'Tên ngắn',
            'org_price' => 'Giá gốc',
            'sell_price' => 'Giá bán',
            'product_code' => 'SKU',
            'qty' => 'Số lượng',
            'sale_email' => 'Email sale',
            'sale_phone' => 'Điện thoại sale',
            'sale_name' => 'Tên sale',
            'seo_description' => 'Mô tả SEO',
            'seo_link' => 'Liên kết SEO',
            'seo_name' => 'Tên SEO',
            'status' => 'Trạng thái',
            'weight' => 'Trọng lượng',
            'note' => 'Mô tả',
            'description' => 'Chi tiết sản phẩm'
        ]
    ]
];
