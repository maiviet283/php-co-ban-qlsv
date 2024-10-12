<?php
    // Trỏ đến file database
    require "../database/database.php";

    // Lấy ID của sinh viên từ URL
    $id = $_GET['ID'];

    // Lấy thông tin sinh viên hiện tại
    $sql = "SELECT * FROM sinhvien WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);
    $student = mysqli_fetch_assoc($result);

    // Xử lý khi form được submit
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lấy dữ liệu từ form
        $name = $_POST['name'];
        $age = $_POST['age'];
        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Kiểm tra xem username có thay đổi không
        if ($username != $student['username']) {
            // Nếu username thay đổi, kiểm tra xem có bị trùng không
            $check_sql = "SELECT * FROM sinhvien WHERE username = '$username' AND id != '$id'";
            $check_result = mysqli_query($conn, $check_sql);

            if (mysqli_num_rows($check_result) > 0) {
                $error = "Username đã tồn tại. Vui lòng chọn username khác.";
            } else {
                // Nếu username hợp lệ, tiến hành cập nhật thông tin
                $password_hash = password_hash($password, PASSWORD_DEFAULT); // Mã hóa mật khẩu
                $update_sql = "UPDATE sinhvien SET 
                                name = '$name', 
                                age = '$age', 
                                phone_number = '$phone_number', 
                                address = '$address', 
                                username = '$username', 
                                password = '$password_hash' 
                            WHERE id = '$id'";

                if (mysqli_query($conn, $update_sql)) {
                    $success = "Cập nhật thông tin sinh viên thành công!";
                } else {
                    $error = "Có lỗi xảy ra khi cập nhật: " . mysqli_error($conn);
                }
            }
        } else {
            // Nếu username không thay đổi, chỉ cần cập nhật các thông tin khác
            $password_hash = password_hash($password, PASSWORD_DEFAULT); // Mã hóa mật khẩu
            $update_sql = "UPDATE sinhvien SET 
                            name = '$name', 
                            age = '$age', 
                            phone_number = '$phone_number', 
                            address = '$address', 
                            password = '$password_hash' 
                        WHERE id = '$id'";

            if (mysqli_query($conn, $update_sql)) {
                $success = "Cập nhật thông tin sinh viên thành công!";
            } else {
                $error = "Có lỗi xảy ra khi cập nhật: " . mysqli_error($conn);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập Nhật Sinh Viên</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Cập Nhật Sinh Viên</h1>

        <?php if (isset($success)): ?>
            <div class="alert alert-success text-center"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger text-center"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="update.php?ID=<?php echo $id; ?>" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $student['name']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" value="<?php echo $student['age']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" value="<?php echo $student['phone_number']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="<?php echo $student['address']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" value="<?php echo $student['username']; ?>" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary">Cập Nhật</button>
            <a href="../index.php" class="btn btn-secondary">Quay lại Trang Chủ</a>
        </form>
    </div>

    <!-- Link Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
