<?php
include 'flowers.php';

// Đổi false thành true nếu muốn xem dạng admin
$isAdmin = false;
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách các loài hoa</title>
    <style>
        body { font-family: Arial; margin: 20px; }
        .flower-list { display: flex; flex-wrap: wrap; gap: 20px; }
        .flower-item { width: 250px; border: 1px solid #ddd; padding: 10px; border-radius: 5px; }
        .flower-item img { width: 100%; border-radius: 5px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; }
    </style>
</head>
<body>

<h1>14 loại hoa tuyệt đẹp thích hợp trồng để khoe hương sắc dịp xuân hè </h1>

<?php if (!$isAdmin): ?>
    <div class="flower-list">
        <?php foreach ($flowers as $flower): ?>
            <div class="flower-item">
                <img src="<?= $flower['img'] ?>" alt="<?= $flower['name'] ?>">
                <h3><?= $flower['name'] ?></h3>
                <p><?= $flower['desc'] ?></p>
            </div>
        <?php endforeach; ?>
    </div>

<?php else: ?>
    <table>
        <tr>
            <th>#</th>
            <th>Tên Hoa</th>
            <th>Mô Tả</th>
            <th>Ảnh</th>
            <th>Hành động</th>
        </tr>

        <?php foreach ($flowers as $i => $flower): ?>
        <tr>
            <td><?= $i+1 ?></td>
            <td><?= $flower['name'] ?></td>
            <td><?= $flower['desc'] ?></td>
            <td><img src="<?= $flower['img'] ?>" width="100"></td>
            <td>
                <button>Sửa</button>
                <button>Xóa</button>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

</body>
</html>
