<?php
// Kiểm tra xem tệp có được gửi lên không
if (isset($_FILES['fileUpload'])) {
    // Thư mục lưu tệp
    $target_dir = "uploads/"; // Đảm bảo thư mục này tồn tại và có quyền ghi
    // Lấy tên tệp
    $target_file = $target_dir . basename($_FILES["fileUpload"]["name"]);
    // Lấy phần mở rộng của tệp
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Kiểm tra xem tệp có phải là một tệp hợp lệ hay không
    $uploadOk = 1;

    // Kiểm tra nếu tệp đã tồn tại
    if (file_exists($target_file)) {
        echo "Tệp đã tồn tại. Vui lòng chọn tệp khác.";
        $uploadOk = 0;
    }

    // Kiểm tra kích thước tệp (ví dụ, không vượt quá 5MB)
    if ($_FILES["fileUpload"]["size"] > 5000000) {
        echo "Xin lỗi, tệp của bạn quá lớn.";
        $uploadOk = 0;
    }

    // Kiểm tra định dạng tệp (ở đây chỉ cho phép tải lên các tệp hình ảnh .jpg, .png, .jpeg, .gif)
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Xin lỗi, chỉ các tệp JPG, JPEG, PNG và GIF mới được phép tải lên.";
        $uploadOk = 0;
    }

    // Kiểm tra nếu $uploadOk đã được thiết lập là 0 (có lỗi)
    if ($uploadOk == 0) {
        echo "Xin lỗi, tệp của bạn không được tải lên.";
    } else {
        // Nếu mọi thứ đều ổn, di chuyển tệp từ thư mục tạm thời đến thư mục uploads
        if (move_uploaded_file($_FILES["fileUpload"]["tmp_name"], $target_file)) {
            echo "Tệp " . htmlspecialchars(basename($_FILES["fileUpload"]["name"])) . " đã được tải lên thành công.";
        } else {
            echo "Xin lỗi, có lỗi xảy ra khi tải tệp lên.";
        }
    }
} else {
    echo "Không có tệp nào được gửi lên.";
}
?>
