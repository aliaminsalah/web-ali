<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $targetDir = "../public/images/"; // المسار حيث سيتم حفظ الصورة
    $targetFile = $targetDir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // تحقق مما إذا كانت الصورة هي صورة فعلية
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if ($check !== false) {
            $uploadOk = 1;
        } else {
            echo json_encode(['success' => false]);
            $uploadOk = 0;
        }
    }

    // تحقق إذا كانت الصورة موجودة بالفعل
    if (file_exists($targetFile)) {
        echo json_encode(['success' => false]);
        $uploadOk = 0;
    }

    // تحقق من حجم الصورة
    if ($_FILES["image"]["size"] > 500000) {
        echo json_encode(['success' => false]);
        $uploadOk = 0;
    }

    // السماح بأنواع الملفات
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo json_encode(['success' => false]);
        $uploadOk = 0;
    }

    // حاول رفع الصورة
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false]);
        }
    }
}
?>
