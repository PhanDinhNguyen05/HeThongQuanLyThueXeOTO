<?php

class mTaiKhoan
{
    private $con;

    public function __construct($con)
    {
        $this->con = $con;
    }

    public function KiemTraTenDangNhap($tenDN)
    {
        $sql = "SELECT TenDN FROM TAI_KHOAN WHERE TenDN = ?";

        $stmt = mysqli_prepare($this->con, $sql);
        mysqli_stmt_bind_param($stmt, "s", $tenDN);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_store_result($stmt);

        $tonTai = mysqli_stmt_num_rows($stmt) > 0;

        mysqli_stmt_close($stmt);

        return $tonTai;
    }

    public function ThemTaiKhoan($tenDN, $matKhau, $maKH)
    {
        $sql = "INSERT INTO TAI_KHOAN (TenDN, MatKhau, MaKH)
                VALUES (?, ?, ?)";

        $stmt = mysqli_prepare($this->con, $sql);

        mysqli_stmt_bind_param(
            $stmt,
            "sss",
            $tenDN,
            $matKhau,
            $maKH
        );

        $ketQua = mysqli_stmt_execute($stmt);

        mysqli_stmt_close($stmt);

        return $ketQua;
    }
}
