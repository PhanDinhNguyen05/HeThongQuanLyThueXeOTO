
<main class="auth-bg">
    <div class="wrap">
        <section class="register-card">
            <div class="eyebrow">TẠO TÀI KHOẢN</div>
            <h1>Đăng ký khách hàng</h1>
            <p>Nhập thông tin cá nhân theo mẫu đăng ký tài khoản.</p>

            <?php if (!empty($thongBao)): ?>
                <p class="form-message" role="status">
                    <?= htmlspecialchars($thongBao, ENT_QUOTES, 'UTF-8') ?>
                </p>
            <?php endif; ?>

            <?php if (empty($thanhCong)): ?>
                <form id="register-form" class="register-grid"
                      method="POST" action="index.php?page=dang-ky" autocomplete="off">

                    <label class="field">
                        Họ và tên <em>*</em>
                        <input name="HoVaTen" required maxlength="100"
                               value="<?= htmlspecialchars($_POST['HoVaTen'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                               placeholder="Nhập họ và tên">
                    </label>

                    <label class="field">
                        Giới tính
                        <select name="GioiTinh">
                            <option value="">Chọn giới tính</option>
                            <option value="Nam" <?= (($_POST['GioiTinh'] ?? '') === 'Nam') ? 'selected' : '' ?>>Nam</option>
                            <option value="Nu" <?= (($_POST['GioiTinh'] ?? '') === 'Nu') ? 'selected' : '' ?>>Nữ</option>
                            <option value="Khac" <?= (($_POST['GioiTinh'] ?? '') === 'Khac') ? 'selected' : '' ?>>Khác</option>
                        </select>
                    </label>

                    <label class="field">
                        Số điện thoại <em>*</em>
                        <input name="DienThoai" type="tel" required
                               pattern="[0-9]{10,15}" maxlength="15"
                               value="<?= htmlspecialchars($_POST['DienThoai'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                               placeholder="10-15 chữ số">
                    </label>

                    <label class="field">
                        Số CCCD <em>*</em>
                        <input name="SoDinhDanh" required
                               pattern="[0-9]{9,12}" maxlength="12"
                               value="<?= htmlspecialchars($_POST['SoDinhDanh'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                               placeholder="Nhập số định danh">
                    </label>

                    <label class="field wide">
                        Giấy phép lái xe <em>*</em>
                        <input name="GiayPhepLaiXe" required maxlength="20"
                               value="<?= htmlspecialchars($_POST['GiayPhepLaiXe'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                               placeholder="Nhập số giấy phép lái xe">
                    </label>

                    <label class="field wide">
                        Email
                        <input name="Email" type="email" maxlength="100"
                               autocomplete="email"
                               value="<?= htmlspecialchars($_POST['Email'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                               placeholder="example@email.com">
                    </label>

                    <label class="field wide">
                        Địa chỉ
                        <input name="DiaChi" maxlength="255"
                               value="<?= htmlspecialchars($_POST['DiaChi'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                               placeholder="Nhập địa chỉ">
                    </label>

                    <label class="field">
                        Tên đăng nhập <em>*</em>
                        <input name="TenDN" required minlength="4" maxlength="50"
                               autocomplete="username" pattern="[a-zA-Z0-9_]+"
                               value="<?= htmlspecialchars($_POST['TenDN'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                               placeholder="Tên đăng nhập">
                    </label>

                    <label class="field">
                        Mật khẩu <em>*</em>
                        <input name="MatKhau" type="password" required minlength="8"
                               autocomplete="new-password"
                               placeholder="Ít nhất 8 ký tự">
                    </label>

                    <label class="field wide">
                        Xác nhận mật khẩu <em>*</em>
                        <input name="XacNhanMatKhau" type="password" required minlength="8"
                               autocomplete="new-password"
                               placeholder="Nhập lại mật khẩu">
                    </label>

                    <div class="register-actions wide">
                        <a href="index.php" class="button button-muted">HỦY</a>
                        <button class="button button-red" type="submit">ĐĂNG KÝ →</button>
                    </div>
                </form>
            <?php else: ?>
                <div class="auth-bottom">
                    Đăng ký thành công.
                    <a href="index.php?page=dang-nhap">Đăng nhập</a>
                </div>
            <?php endif; ?>

            <div class="auth-bottom">
                Đã có tài khoản? <a href="index.php?page=dang-nhap">Đăng nhập</a>
            </div>
        </section>
    </div>
</main>
