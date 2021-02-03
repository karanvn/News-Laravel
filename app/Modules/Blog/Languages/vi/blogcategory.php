<?php

return [
    'breadcrumb' =>[
        'profile-customer'  => 'Thông tin tài khoản',
        'orders-customer'   => 'Đơn hàng đã đặt',
        'order-detail'      =>  'Chi tiết đơn hàng'
    ],
    'list' => [
        'header_title' => 'DANH MỤC BÀI VIẾT',
        'header_title_info'=> 'Danh sách bài viết',
        'header_total' => 'Tổng',
        'header_add_btn' => 'Thêm',
        'filter' => [
            'id' => 'Mã',
            'title' => 'Tên danh mục',
            'slug' => 'slug',
            'status' => 'Trạng Thái',
            'se_status' => '---Chọn trạng thái---',
            'btn' => 'TÌM KIẾM'
        ],
        'paginate' => [
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
    'positions' => [
        'BLOG'   => 'BLOG',
        'FOOTER' => 'FOOTER',
        'NONE'   => 'NONE'
    ],
    'genders' => [
        'M' => 'Nam',
        'F' => 'Nữ',
        'O' => 'Khác'
    ],

    'add' => [
        'header_title'        => 'THÊM DANH MỤC',
        'header_btn_back'     => 'Trở về',
        'header_btn_save'     => 'Lưu',
        'header_btn_delete'   => 'Xóa',  
        'form' => [

            'header_status'         => '---Chọn Trạng Thái---',
            'header_general_info'   => 'Thông tin chung',
            'header_contact_info'   => 'Thông tin liên hệ',
            'header_add'            => 'Thêm',
            'header_avatar_allow'   => 'Cho phép định dạng',
            'header_category_parent_select'=> '---Chọn Danh Mục Cha (Nếu Có)---',
            'header_category_parent'=> 'Danh mục',
            'select_position'       => '--Chọn Vị Trí--',
            'position'              => 'Vị trí',
            'title'                 => 'Tiêu đề',
            'title_short'           => 'Tên danh mục ngắn',
            'slug'                  => 'Slug',
            'description'           => 'Mô tả',
            'content'               => 'Nội dung bài viết',
            'seo_optimization'      => 'Tối ưu SEO',
            'header_seo_add'        => 'Thêm thông tin SEO',
            'seo_title'             => 'Tiêu đề trang',
            'seo_description'       => 'Mô tả trang',
            'seo_link'              => 'Đường dẫn',
            'seo_keywords'          => 'Từ khóa',
            'change_password'       => 'Thay đổi mật khẩu',
            'password_quest'        => 'Bạn có muốn thay đổi mật khẩu',
            'password'              => 'Mật khẩu',
            'password_current'      => 'Mật khẩu hiện tại',
            'password_new'          => 'Mật khẩu mới',
            'placeholder_password'  => 'Vui lòng chọn thay đổi mật khẩu',
            're_password'           => 'Nhập lại mật khẩu',
            'email'                 => 'Email',
            'email_title'           => 'Bạn ',
            'partner'               => 'Nhà cung cấp',
            'address'               => 'Địa chỉ',
            'phone'                 => 'Điện thoại',
            'avatar' => 'Ảnh đại diện',
            'avatar_change' => 'Đổi ảnh',
            'avatar_cancel' => 'Huỷ ảnh',
            'allow_image_extension' => 'Cho phép định dạng: png, jpg, jpeg.',
            'status' => 'Trạng thái',
            'gender' => 'Giới tính',
            'position' => 'Nhóm page',
            'shipping' => [
                'header_action' => 'Thêm/Sửa',
                'header_list'   => 'Địa chỉ giao hàng',
                'action_list'   => '---Danh sách----',
                'action_ad_new' => 'Thêm mới',
            ],
            'order' => [
                'header_list'   => 'Đơn hàng đã đặt',
                'order'         => 'Đơn hàng',
                'date'          => 'Ngày đặt',
                'updated_at'    => 'Ngày xử lý',
                'status'        => 'Trạng thái',
                'total'         => 'Thành tiền',
                'actions'       => 'Chi tiết',
                'view'          => 'Xem',
                'item'          => 'món'
            ],
            'genders' => [
                'M' => 'Nam',
                'F' => 'Nữ',
                'O' => 'Khác'
            ],
            'bod' => 'Ngày sinh',
            'statuses' => [
                'D' => 'Vô hiệu',
                'A' => 'Kích hoạt'
            ],

            'errors' => [
                'required' => 'không được để trống!',
                'unique'   => 'đã tồn tại!',
                'max'      => 'tối đa là 255 ký tự',
                'header' => 'Vui lòng nhập thông tin theo yêu cầu',
                'user_id' => 'Vui lòng nhập mã bài viết',
                'user_id_exists' => 'Mã bài viết không tồn tại',
                'name' => 'Vui lòng nhập tên',
                'email' => 'Vui lòng nhập tài khoản email',
                'email_format' => 'Tài khoản email không hợp lệ',
                'email_exists' => 'Tài khoản mail đã tồn tài',
                'password' => 'Vui lòng nhập mật khẩu',
                'password_min' => 'Chiều dài mật khẩu tối thiểu là 6',
                're_password' => 'Vui lòng nhập lại mật khẩu',
                're_password_same' => 'Mật khẩu không giống nhau',
                'avatar' => 'Vui lòng nhập đúng định dạng file',
                'address' => 'Vui lòng nhập địa chỉ',
                'state_id' => 'Vui lòng nhập tỉnh/thành',
                'phone'     => 'Vui lòng nhập điện thoại',
                'phone_min' => 'không hợp lệ!',
                'phone_max' => 'không hợp lệ!',
                'district_id' => 'Vui lòng nhập quận/huyện',
                'ward_id' => 'Vui lòng nhập phường/xã',
                'state_id_exists' => 'Tỉnh/thành không tồn tại',
                'district_id_exists' => 'Quận/huyện không tồn tại',
                'ward_id_exists' => 'Phường/xã không tồn tại',
                'district_id_not_match' => 'Quận/huyện không thuộc về tỉnh/thành',
                'ward_id_not_match' => 'Phường/xã không thuộc về quận/huyện',
                'shipping_not_found' => 'Địa chỉ giao hàng không tồn tại',
                'user_not_found' => 'Địa chỉ giao hàng không thuộc về bài viết'
            ],
            'success' => [
                'add' => 'Tạo tài khoản thành công!',
                'edit' => 'Cập nhật tài khoản thành công',
                'rule' => 'Xét quyền cho tài khoản thành công',
                'add_shipping' => 'Tạo địa chỉ giao hàng thành công',
                'edit_shipping' => 'Cập nhật địa chỉ giao hàng thành công'
            ]
        ]
    ],

    'edit' => [
        'header_title' => 'CẬP NHẬT DANH MỤC BÀI VIẾT',
        'header_general' => 'Thông tin chung',
        'sub_general' => 'Thông tin chung của tài khoản',
        'header_password' => 'Đổi mật khẩu',
        'sub_password' => 'Thay đổi mật khẩu',
        'header_rule' => 'Phân quyền',
        'sub_rule' => 'Phân quyền tài khoản',
        'header_rule_btn' => 'Cấp quyền',
        'header_btn_save' => 'Lưu',
        'header_shipping' => 'Địa chỉ giao hàng',
        'header_order' => 'Đơn hàng',
        'header_history' => 'Lịch sử',
        'sub_shipping' => 'Thông tin địa chỉ giao hàng',
        'profile' => [
            'gender' => 'Giới tính',
            'email' => 'Tài khoản',
            'created_at' => 'Ngày tạo',
            'created_by' => 'Người tạo'
        ]
    ]

];
