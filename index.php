<?php
$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'home':
        $pageTitle = 'Trang chủ';
        $view = __DIR__ . '/app/views/home/trang_chu.php';
        break;

    case 'dang-ky':
        $pageTitle = 'Đăng ký khách hàng';

        require_once __DIR__ . '/app/controllers/cDangKy.php';

        $thongBao = '';
        $thanhCong = false;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $controller = new cDangKy();
            $ketQua = $controller->DangKy($_POST);

            $thongBao = $ketQua['message'] ?? '';
            $thanhCong = $ketQua['success'] ?? false;
        }

        $view = __DIR__ . '/app/views/auth/dang_ky.php';
        break;

    case 'dang-nhap':
        http_response_code(404);
        $pageTitle = 'Đăng nhập';
        echo 'Chức năng đăng nhập chưa được xây dựng.';
        exit;

    default:
        http_response_code(404);
        $pageTitle = 'Không tìm thấy trang';
        echo 'Trang bạn yêu cầu không tồn tại.';
        exit;
}

require __DIR__ . '/app/views/layouts/dau_trang.php';
require $view;
require __DIR__ . '/app/views/layouts/chan_trang.php';
