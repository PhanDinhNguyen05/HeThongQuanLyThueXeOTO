<?php

require_once __DIR__ . '/../models/KhachHang.php';
require_once __DIR__ . '/../models/TaiKhoan.php';
require_once __DIR__ . '/../models/ThanhVien.php';

class DangKyController
{
    private PDO $db;
    private KhachHang $khachHang;
    private TaiKhoan $taiKhoan;
    private ThanhVien $thanhVien;

    public function __construct(PDO $db)
    {
        $this->db = $db;
        $this->khachHang = new KhachHang($db);
        $this->taiKhoan = new TaiKhoan($db);
        $this->thanhVien = new ThanhVien($db);
    }

    public function register(array $data): array
    {
        $required = [
            'HoVaTen', 'DienThoai', 'SoDinhDanh',
            'GiayPhepLaiXe', 'TenDN', 'MatKhau', 'XacNhanMatKhau'
        ];

        foreach ($required as $field) {
            if (trim($data[$field] ?? '') === '') {
                return [
                    'success' => false,
                    'message' => 'Vui long nhap day du thong tin bat buoc.'
                ];
            }
        }

        $data['HoVaTen'] = trim($data['HoVaTen']);
        $data['DienThoai'] = trim($data['DienThoai']);
        $data['SoDinhDanh'] = trim($data['SoDinhDanh']);
        $data['GiayPhepLaiXe'] = trim($data['GiayPhepLaiXe']);
        $data['TenDN'] = trim($data['TenDN']);
        $data['Email'] = trim($data['Email'] ?? '');
        $data['DiaChi'] = trim($data['DiaChi'] ?? '');
        $data['GioiTinh'] = trim($data['GioiTinh'] ?? '');

        if (!filter_var($data['Email'], FILTER_VALIDATE_EMAIL)
            && $data['Email'] !== '') {
            return ['success' => false, 'message' => 'Email khong hop le.'];
        }

        if (strlen($data['TenDN']) < 4 || strlen($data['TenDN']) > 50
            || !preg_match('/^[a-zA-Z0-9_]+$/', $data['TenDN'])) {
            return [
                'success' => false,
                'message' => 'Ten dang nhap phai co 4-50 ky tu, chi gom chu, so va dau _.'
            ];
        }

        if (strlen($data['MatKhau']) < 8) {
            return [
                'success' => false,
                'message' => 'Mat khau phai co it nhat 8 ky tu.'
            ];
        }

        if ($data['MatKhau'] !== $data['XacNhanMatKhau']) {
            return [
                'success' => false,
                'message' => 'Xac nhan mat khau khong khop.'
            ];
        }

        if (strlen($data['DienThoai']) > 15
            || !preg_match('/^[0-9]{10,15}$/', $data['DienThoai'])) {
            return ['success' => false, 'message' => 'So dien thoai khong hop le.'];
        }

        if (strlen($data['SoDinhDanh']) > 20
            || !preg_match('/^[0-9]{9,12}$/', $data['SoDinhDanh'])) {
            return ['success' => false, 'message' => 'So dinh danh khong hop le.'];
        }

        if (strlen($data['GiayPhepLaiXe']) > 20) {
            return [
                'success' => false,
                'message' => 'So giay phep lai xe khong duoc qua 20 ky tu.'
            ];
        }

        if ($this->taiKhoan->exists($data['TenDN'])) {
            return ['success' => false, 'message' => 'Ten dang nhap da ton tai.'];
        }

        if ($this->khachHang->exists(
            $data['DienThoai'],
            $data['SoDinhDanh'],
            $data['GiayPhepLaiXe'],
            $data['Email'] !== '' ? $data['Email'] : null
        )) {
            return [
                'success' => false,
                'message' => 'So dien thoai, dinh danh, giay phep lai xe hoac email da duoc su dung.'
            ];
        }

        $maKH = 'KH' . bin2hex(random_bytes(4));
        $maTV = 'TV' . bin2hex(random_bytes(4));
        $matKhauHash = password_hash($data['MatKhau'], PASSWORD_DEFAULT);

        try {
            $this->db->beginTransaction();

            $this->khachHang->create([
                'MaKH' => $maKH,
                'HoVaTen' => $data['HoVaTen'],
                'GioiTinh' => $data['GioiTinh'],
                'DienThoai' => $data['DienThoai'],
                'SoDinhDanh' => $data['SoDinhDanh'],
                'GiayPhepLaiXe' => $data['GiayPhepLaiXe'],
                'Email' => $data['Email'],
                'DiaChi' => $data['DiaChi']
            ]);

            $this->taiKhoan->create(
                $data['TenDN'],
                $matKhauHash,
                $maKH
            );

            $this->thanhVien->create($maTV, $maKH);

            $this->db->commit();

            return [
                'success' => true,
                'message' => 'Dang ky thanh vien thanh cong.'
            ];
        } catch (Throwable $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            error_log($e->getMessage());

            return [
                'success' => false,
                'message' => 'Dang ky that bai. Vui long kiem tra du lieu hoac thu lai.'
            ];
        }
    }
}
