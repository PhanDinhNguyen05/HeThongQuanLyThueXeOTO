
<?php
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

require __DIR__ . '/app/views/layouts/dau_trang.php';
require __DIR__ . '/app/views/auth/dang_ky.php';
require __DIR__ . '/app/views/layouts/chan_trang.php';
