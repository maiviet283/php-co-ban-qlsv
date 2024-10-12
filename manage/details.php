<?php
    // Trỏ đến file database
    require "../database/database.php";

    // Lấy ID từ URL
    if (isset($_GET['ID'])) {
        $id = $_GET['ID'];

        // Truy vấn lấy thông tin sinh viên dựa trên ID
        $sql = "SELECT * FROM sinhvien WHERE id = $id";
        $result = mysqli_query($conn, $sql);

        // Kiểm tra nếu có dữ liệu trả về
        if ($result && mysqli_num_rows($result) > 0) {
            $student = mysqli_fetch_assoc($result);
        } else {
            echo "<div class='alert alert-danger text-center'>Không tìm thấy sinh viên!</div>";
            exit();
        }
    } else {
        echo "<div class='alert alert-danger text-center'>ID không hợp lệ!</div>";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sinh Viên</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Thông Tin Chi Tiết Sinh Viên</h1>

        <div class="card">
            <div class="card-header">
                Thông tin sinh viên
            </div>
            <div class="card-body">
                <p><strong>ID:</strong> <?php echo $student['id']; ?></p>
                <p><strong>Name:</strong> <?php echo $student['name']; ?></p>
                <p><strong>Age:</strong> <?php echo $student['age']; ?></p>
                <p><strong>Phone Number:</strong> <?php echo $student['phone_number']; ?></p>
                <p><strong>Address:</strong> <?php echo $student['address']; ?></p>
                <p><strong>Username:</strong> <?php echo $student['username']; ?></p>
                <p><strong>Password:</strong> <?php echo $student['password']; ?></p>

                <a href="../index.php" class="btn btn-primary">Quay lại trang chủ</a>
            </div>
        </div>
    </div>

    <!-- Link Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
