<?php
    // Trỏ đến file database
    require "database/database.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chủ</title>
    <!-- Link Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Trang Chủ</h1>

        <?php
            // Chỉ lấy id, name, age từ bảng sinhvien
            $sql = "SELECT id, name, age FROM sinhvien";
            $kq = mysqli_query($conn, $sql);

            // Kiểm tra nếu có dữ liệu trả về
            if ($kq && mysqli_num_rows($kq) > 0) {
        ?>

        <!-- thêm sinh viên -->
        <a href="manage/add.php" class='text-decoration-none'> Add Student </a>

        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>STT</th>
                    <th>Name</th>
                    <th>Age</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $stt = 1;
                    while($row = mysqli_fetch_assoc($kq)) {

                        echo "<tr>";
                        echo "<td>" . $stt . "</td>";
                        echo "<td><a href='manage/details.php?ID=".$row["id"]."' class='text-decoration-none'>" . $row['name'] . "</a></td>";
                        echo "<td>" . $row['age'] . "</td>";
                        echo "<td><a href='manage/update.php?ID=".$row["id"]."' class='text-decoration-none'> Update </a></td>";
                        echo "<td><a href='manage/delete.php?ID=".$row["id"]."' class='text-decoration-none'> Delete </a></td>";
                        echo "</tr>";
                        $stt += 1;
                    }
                ?>
            </tbody>
        </table>

        <?php
            } else {
                echo "<div class='alert alert-warning text-center'>Không có dữ liệu sinh viên</div>";
            }
        ?>
    </div>

    <!-- Link Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
