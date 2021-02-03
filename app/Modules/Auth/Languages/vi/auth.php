<?php

return [
    'login' => [
        'title' => 'ĐĂNG NHẬP',
        'sub_login' => 'Đăng nhập',
        'header' => 'ĐĂNG NHẬP VÀO QUẢN TRỊ',
        'email' => 'Tài khoản email',
        'placeholder_email' => 'Nhập email của bạn...',
        'password' => 'Mật khẩu',
        'remember' => 'Ghi nhớ',
        'submit' => 'Đăng Nhập',
        'msg_login' => 'Đăng nhập?',
        'msg_login_fail' => 'Tài khoản email hoặc mật khẩu không hợp lệ!',
        'msg_login_true' => 'Đăng nhập thành công'

    ],

    'reset' => [
        'title' => 'QUÊN MẬT KHẨU',
        'header' => 'QUÊN MẬT KHẨU',
        'email' => 'Tài khoản email',
        'forget_password' => 'Quên mật khẩu',
        'submit' => 'Thực Hiện',
        'msg_email_empty' => 'Vui lòng nhập email',
        'msg_email_not_found' => 'Email không tồn tại',
        'msg_reset_success' => 'Hệ thống đã gửi mail cho bạn. Vui lòng kiểm tra hộp thư!'
    ],

    'password' => [
        'title' => 'NHẬP MẬT KHẨU',
        'header' => 'THÔNG TIN MẬT KHẨU',
        'email' => 'Email',
        'password' => 'Mật khẩu',
        're_password' => 'Nhập lại mật khẩu',
        'submit' => 'Đổi mật khẩu',
        'errors' => [
            'token_expire' => 'Yêu cầu đã hết hạn',
            'token_not_found' => 'Mã token không hợp lệ',
            'email' => 'Vui lòng nhập tài khoản email',
            'email_format' => 'Tài khoản email không hợp lệ',
            'email_exists' => 'Tài khoản mail đã tồn tài',
            'email_token_not_match' => 'Email và token không khớp nhau',
            'password' => 'Vui lòng nhập mật khẩu',
            'password_min' => 'Chiều dài mật khẩu tối thiểu là 6',
            're_password' => 'Vui lòng nhập lại mật khẩu',
            're_password_same' => 'Mật khẩu không giống nhau',
        ],
        'success' => 'Tạo mật khẩu mới thành công'
    ],

    'register' => [
        'title' => 'ĐĂNG KÝ',
        'sub_register' => 'Đăng ký',
        'header' => 'ĐĂNG KÝ TÀI KHOẢN QUẢN TRỊ',
        'note' => 'Chấp nhận',
        'notes' => 'Các điều khoản',
        'btn_re' => 'ĐĂNG KÝ',
        'btn_cancel' => 'Hủy bỏ'
    ],

    'logout' => 'Đăng xuất',
    'withlist' => 'Yêu thích',
    'history' => 'Lịch sử mua hàng',
    'editaccount' => 'Thông tin',
    'validator' => [
        'required' => 'Không được để trống',
        'regex' => 'Không đúng định dạng',
        'email' => 'Email không đúng',
        'same' => 'Không trùng khớp',
        'fullname' => ' Họ tên',
        'password' => 'Mật khẩu',
        'phone' => 'Số điện thoại',
        'cpassword' => 'Nhập lại mật khẩu',
        'birthday' => 'Ngày sinh',
        'agree' => 'Điều khoản',
        'agreed' =>'Chấp nhận các điều khoản',
        'accepted' => 'Phải được chấp nhận',
        'min' => 'Tối thiểu 6 ký tự',
        'emailused' => 'Email này đã được đăng ký',
        'success' => 'Đăng ký tài khoản thành công'
    ]
];
