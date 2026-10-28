<?php

class mThanhVien
{
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function ThemThanhVien($maTV, $maKH)
    {
        $sql = "INSERT INTO THANH_VIEN
                (MaTV, MaKH, TinhTrang, NgayBatDau, NgayHetHan)
                VALUES (?, ?, 'HoatDong', CURDATE(),
                        DATE_ADD(CURDATE(), INTERVAL 1 YEAR))";

        $stmt = mysqli_prepare($this->con, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "ss",
            $maTV,
            $maKH
        );

        $ketQua = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        return $ketQua;
    }
}
