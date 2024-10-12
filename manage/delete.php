<?php
    // Trỏ đến file database
    require "../database/database.php";

    // Lấy ID của sinh viên từ URL
    $id = $_GET['ID'];

    // Xác nhận sinh viên có tồn tại trong database không
    $sql = "SELECT * FROM sinhvien WHERE id = '$id'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Xóa sinh viên dựa trên ID
        $delete_sql = "DELETE FROM sinhvien WHERE id = '$id'";
        if (mysqli_query($conn, $delete_sql)) {
            // Nếu xóa thành công, chuyển hướng về trang chủ
            header("Location: ../index.php");
            exit;
        } else {
            echo "Có lỗi xảy ra khi xóa sinh viên: " . mysqli_error($conn);
        }
    } else {
        echo "Sinh viên không tồn tại.";
    }
?>
