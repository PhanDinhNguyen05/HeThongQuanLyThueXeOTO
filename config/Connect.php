<?php

class Connect
{
    private $con;

    public function Ketnoi()
    {
        $this->con = mysqli_connect(
            'localhost',
            'root',
            '',
            'quanlythuexeoto'
        );

        if (!$this->con) {
            die("Không thể kết nối với MySQL");
        }

        mysqli_set_charset($this->con, 'utf8mb4');

        return $this->con;
    }

    public function Ngatketnoi()
    {
        if ($this->con) {
            mysqli_close($this->con);
        }
    }
}
?>
