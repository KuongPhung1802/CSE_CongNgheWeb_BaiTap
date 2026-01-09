<?php
 * ----------------------------------------------------------------------
 * Cấu hình và Xử lý Đọc Tệp CSV
 * ----------------------------------------------------------------------
 */

// 1. Cấu hình Tên Tệp và Xử lý Lỗi Deprecated
$csvFile = '65HTTT_Danh_sach_diem_danh.csv'; 


error_reporting(E_ALL & ~E_DEPRECATED & ~E_NOTICE); 


if (!file_exists($csvFile)) {
    die("<h1>Lỗi</h1><p>Không tìm thấy tệp tin CSV: <strong>" . htmlspecialchars($csvFile) . "</strong>. Vui lòng kiểm tra lại tên và đường dẫn.</p>");
}


$fileHandle = @fopen($csvFile, 'r'); 

if ($fileHandle === FALSE) {
     die("<h1>Lỗi</h1><p>Không thể mở tệp tin: <strong>" . htmlspecialchars($csvFile) . "</strong>. Kiểm tra quyền truy cập (permissions).</p>");
}


$data = [];


while (($row = fgetcsv($fileHandle, 1000, ',', '"', '\\')) !== FALSE) {
    
    if (!empty(array_filter($row))) {
        $data[] = $row;
    }
}


fclose($fileHandle);


if (empty($data)) {
    $headers = [];
    $records = [];
} else {
 
    $headers = $data[0] ?? []; 
   
    $records = array_slice($data, 1);
}


?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hiển Thị Danh Sách Tài Khoản từ CSV</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 20px; background-color: #f4f7f6; }
        h1 { color: #2c3e50; border-bottom: 2px solid #3498db; padding-bottom: 10px; }
        p { color: #555; }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 30px; 
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        th, td { 
            border: 1px solid #e0e0e0; 
            padding: 12px; 
            text-align: left; 
            white-space: nowrap;
        }
        th { 
            background-color: #3498db; 
            color: white; 
            font-weight: bold;
            text-transform: uppercase;
        }
        tr:nth-child(even) { 
            background-color: #ecf0f1; 
        }
        tr:hover { 
            background-color: #d5dbdb; 
            cursor: pointer;
        }
    </style>
</head>
<body>

    <h1>📚 Danh Sách Tài Khoản Đã Đọc từ CSV</h1>
    <p>Nội dung được đọc trực tiếp từ tệp tin: **`<?php echo htmlspecialchars($csvFile); ?>`**.</p>
    <p>Tổng số dòng dữ liệu (không tính tiêu đề): **<?php echo count($records); ?>**</p>

    <?php if (empty($data)): ?>
        <p>⚠️ Không có bất kỳ dữ liệu nào được đọc từ tệp tin. Vui lòng kiểm tra lại nội dung tệp CSV.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <?php 
             
                    foreach ($headers as $header): ?>
                        <th><?php echo htmlspecialchars($header); ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <?php 
             
                foreach ($records as $record): ?>
                    <tr>
                        <?php 
                        
                        foreach ($record as $cell): ?>
                            <td><?php echo htmlspecialchars($cell); ?></td>
                        <?php endforeach; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

</body>
</html>