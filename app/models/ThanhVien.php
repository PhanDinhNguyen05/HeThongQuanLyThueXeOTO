<?php

class ThanhVien
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function create(string $maTV, string $maKH): void
    {
        $ngayBatDau = date('Y-m-d');
        $ngayHetHan = date('Y-m-d', strtotime('+1 year'));

        $sql = "INSERT INTO THANH_VIEN
                (MaTV, MaKH, TinhTrang, NgayBatDau, NgayHetHan, DiemTichLuy)
                VALUES
                (:MaTV, :MaKH, 'HoatDong', :NgayBatDau, :NgayHetHan, 0)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'MaTV' => $maTV,
            'MaKH' => $maKH,
            'NgayBatDau' => $ngayBatDau,
            'NgayHetHan' => $ngayHetHan
        ]);
    }
}
