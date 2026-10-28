<?php

class TaiKhoan
{
    private PDO $db;

    public function __construct(PDO $db)
    {
        $this->db = $db;
    }

    public function exists(string $tenDN): bool
    {
        $stmt = $this->db->prepare(
            "SELECT COUNT(*) FROM TAI_KHOAN WHERE TenDN = :TenDN"
        );

        $stmt->execute(['TenDN' => $tenDN]);

        return (int) $stmt->fetchColumn() > 0;
    }

    public function create(string $tenDN, string $matKhauHash, string $maKH): void
    {
        $sql = "INSERT INTO TAI_KHOAN (TenDN, MatKhau, MaKH)
                VALUES (:TenDN, :MatKhau, :MaKH)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            'TenDN' => $tenDN,
            'MatKhau' => $matKhauHash,
            'MaKH' => $maKH
        ]);
    }
}
