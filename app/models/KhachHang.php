<?php

class KhachHang
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function exists(string $dienThoai, string $soDinhDanh, string $giayPhepLaiXe, ?string $email): bool
    {
        $sql = "SELECT COUNT(*) FROM KHACH_HANG
                WHERE DienThoai = :dienThoai
                   OR SoDinhDanh = :soDinhDanh
                   OR GiayPhepLaiXe = :giayPhepLaiXe";

        $params = [
            'dienThoai' => $dienThoai,
            'soDinhDanh' => $soDinhDanh,
            'giayPhepLaiXe' => $giayPhepLaiXe
        ];

        if ($email !== null && $email !== '') {
            $sql .= " OR Email = :email";
            $params['email'] = $email;
        }

        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return (int) $stmt->fetchColumn() > 0;
    }

    public function create(array $data): void
    {
        $sql = "INSERT INTO KHACH_HANG
                (MaKH, HoVaTen, GioiTinh, DienThoai, SoDinhDanh,
                 GiayPhepLaiXe, Email, DiaChi)
                VALUES
                (:MaKH, :HoVaTen, :GioiTinh, :DienThoai, :SoDinhDanh,
                 :GiayPhepLaiXe, :Email, :DiaChi)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'MaKH' => $data['MaKH'],
            'HoVaTen' => $data['HoVaTen'],
            'GioiTinh' => $data['GioiTinh'] ?: null,
            'DienThoai' => $data['DienThoai'],
            'SoDinhDanh' => $data['SoDinhDanh'],
            'GiayPhepLaiXe' => $data['GiayPhepLaiXe'],
            'Email' => $data['Email'] ?: null,
            'DiaChi' => $data['DiaChi'] ?: null
        ]);
    }
}
