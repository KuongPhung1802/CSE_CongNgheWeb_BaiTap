<?php
// 1. Dữ liệu thô mô phỏng nội dung được đọc từ tệp tin Quiz.txt
// Sử dụng HEREDOC (<<<EOT) để dễ dàng chèn nội dung nhiều dòng.
$rawData = <<<EOT
Thành phần nào sau đây KHÔNG phải là một thành phần giao diện người dùng (UI) trong Android
A. TextView
B. Button
C. Service
D. ImageView
ANSWER: C

Layout nào thường được sử dụng để sắp xếp các thành phần UI theo chiều dọc hoặc chiều ngang
A. RelativeLayout
B. LinearLayout
C. FrameLayout
D. ConstraintLayout
ANSWER: B

Intent trong Android được sử dụng để làm gì?
A. Hiển thị thông báo cho người dùng.
B. Lưu trữ dữ liệu.
C. Khởi chạy Activity.
D. Xử lý sự kiện chạm.
ANSWER: C

Vòng đời của một Activity bắt đầu bằng phương thức nào?
A. onStart()
B. onResume()
ANSWER: 
EOT;

// 2. Hàm phân tích dữ liệu thô thành cấu trúc mảng dễ xử lý
function parseQuizData($rawData) {
    $questions = [];
    // Tách các khối câu hỏi dựa trên dòng trống hoặc nhiều dòng xuống dòng liên tiếp
    // Regex: /\n\s*\n/ tìm kiếm ít nhất một dòng trống giữa các khối.
    $questionBlocks = preg_split('/\n\s*\n/', trim($rawData));

    foreach ($questionBlocks as $block) {
        $lines = array_map('trim', explode("\n", trim($block)));
        if (empty($lines[0])) continue;

        $question = [
            'text' => $lines[0],
            'options' => [],
            'answer' => ''
        ];

        // Duyệt qua các dòng còn lại để tìm options và đáp án
        for ($i = 1; $i < count($lines); $i++) {
            $line = $lines[$i];
            
            // Nếu tìm thấy dòng ANSWER
            if (strpos($line, 'ANSWER:') === 0) {
                // Lấy giá trị sau 'ANSWER:' và loại bỏ khoảng trắng
                $question['answer'] = trim(str_replace('ANSWER:', '', $line));
                break; // Dừng lại sau khi tìm thấy đáp án
            }
            
            // Nếu không phải là ANSWER, thì là Options
            if (!empty($line)) {
                $question['options'][] = $line;
            }
        }

        $questions[] = $question;
    }

    return $questions;
}

// 3. Gọi hàm để lấy dữ liệu đã được phân tích
$quizItems = parseQuizData($rawData);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài Thi Trắc Nghiệm PHP</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f4f9; margin: 0; padding: 20px; display: flex; justify-content: center; }
        .quiz-container { background-color: #ffffff; padding: 30px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); max-width: 800px; width: 100%; }
        h1 { text-align: center; color: #333; margin-bottom: 30px; }
        .question-block { margin-bottom: 25px; padding: 15px; border: 1px solid #ddd; border-radius: 8px; background-color: #f9f9f9; }
        .question-text { font-weight: bold; margin-bottom: 10px; color: #0056b3; }
        .options p { margin: 5px 0; padding-left: 10px; }
        .answer { margin-top: 10px; font-weight: bold; color: #28a745; border-top: 1px dashed #ccc; padding-top: 5px; }
    </style>
</head>
<body>
    <div class="quiz-container">
        <h1>Danh Sách Câu Hỏi Trắc Nghiệm Android</h1>
        
        <?php foreach ($quizItems as $index => $item): ?>
            <div class="question-block">
                <div class="question-text">
                    Câu <?php echo $index + 1; ?>: <?php echo htmlspecialchars($item['text']); ?>
                </div>

                <div class="options">
                    <?php foreach ($item['options'] as $option): ?>
                        <p><?php echo htmlspecialchars($option); ?></p>
                    <?php endforeach; ?>
                </div>

                <?php if (!empty($item['answer'])): ?>
                    <div class="answer">
                        Đáp án: **<?php echo htmlspecialchars($item['answer']); ?>**
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>

    </div>
</body>
</html>