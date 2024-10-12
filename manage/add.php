<?php
    // Trỏ đến file database
    require "../database/database.php";

    // Xử lý khi form được submit
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lấy dữ liệu từ form
        $name = $_POST['name'];
        $age = $_POST['age'];
        $phone_number = $_POST['phone_number'];
        $address = $_POST['address'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Mã hóa mật khẩu

        // Kiểm tra xem username đã tồn tại chưa
        $check_sql = "SELECT * FROM sinhvien WHERE username = '$username'";
        $check_result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            // Nếu username đã tồn tại, hiển thị lỗi
            $error = "Username đã tồn tại. Vui lòng chọn username khác.";
        } else {
            // Nếu username chưa tồn tại, thêm sinh viên mới
            $sql = "INSERT INTO sinhvien (name, age, phone_number, address, username, password) 
                    VALUES ('$name', '$age', '$phone_number', '$address', '$username', '$password')";

            if (mysqli_query($conn, $sql)) {
                $success = "Thêm sinh viên thành công!";
                header("location:../index.php");
            } else {
                $error = "Có lỗi xảy ra khi thêm sinh viên: " . mysqli_error($conn);
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sinh Viên</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Thêm Sinh Viên Mới</h1>

        <?php if (isset($success)): ?>
            <div class="alert alert-success text-center"><?php echo $success; ?></div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger text-center"><?php echo $error; ?></div>
        <?php endif; ?>

        <form action="add.php" method="POST">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>

            <div class="mb-3">
                <label for="age" class="form-label">Age</label>
                <input type="number" class="form-control" id="age" name="age" required>
            </div>

            <div class="mb-3">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phone_number" name="phone_number" required>
            </div>

            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>

            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>

            <button type="submit" class="btn btn-primary">Thêm Sinh Viên</button>
            <a href="../index.php" class="btn btn-secondary">Quay lại Trang Chủ</a>
        </form>
    </div>

    <!-- Link Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
