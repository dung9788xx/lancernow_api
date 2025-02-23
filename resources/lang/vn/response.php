<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authentication Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used during authentication for various
    | messages that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'invalidEmailPassword' => 'Email hoặc mật khẩu không đúng!',
    'need_login' => 'Vui lòng đăng nhập!',
    'email_not_found' => 'Không tìm thấy email!',
    'try_after' => 'Vui lòng thử lại sau :minutes phút!',
    'something_wrong' => 'Xảy ra lỗi vui lòng thử lại sau!',
    'mail_sent' => 'Thư đã được gửi đến email của bạn, nếu không thấy vui lòng kiểm tra trong spam.',
    'forgot_password_mail_subject' => 'Yêu cầu khôi phục lại mật khẩu từ '.config('app.name'),
    'forgot_password_mail_content' => 'Vui lòng bấm vào đường dẫn dưới đây để đặt lại mật khẩu, không chia sẻ đường dẫn này cho bất cứ ai, đường dẫn sẽ hết hạn trong vòng '.config('mail.timeout_link_reset_password').' phút.',
    'reset_password_button' => 'Khôi phục lại mật khẩu',
    'thanks' => 'Cảm ơn',
    'token_expired' => "Token đã hết hạn, vui lòng quay lại trang khôi mật khẩu",
    'password_changed' => "Mật khẩu đã được đặt lại ",
    'email_existed' => 'Email đã tồn tại vui lòng thử email khác hoặc khôi phục lại mật khẩu',
    'verify_email' => 'Xác thực email từ '.config('app.name'),
    'register_success' => 'Đăng ký thành công vui lòng kiểm tra email để kích hoạt tài khoản',
    'verify_account_mail_subject' => 'Xác thực tài khoản '.config('app.name'),
    'verify_account_mail_content' => 'Cảm ơn bạn đã đăng ký tài khoản, vui lòng bấm vào link dưới đây để click hoạt tài khoản: ',
    'verify' => 'Xác thực email'
];
