<?php
header('Content-Type: application/json');

// الحصول على الاسم من المعلمة GET
$name = isset($_GET['name']) ? $_GET['name'] : '';

$response = [];

// البحث في جميع ملفات الـ JSON
for ($i = 1; $i <= 100; $i++) {
    $fileName = "chunk_$i.json";
    
    if (file_exists($fileName)) {
        // قراءة بيانات الطلاب من ملف JSON
        $data = file_get_contents($fileName);
        $students = json_decode($data, true);
        
        // البحث عن الطلاب الذين تبدأ أسماؤهم بالاسم المقدم
        foreach ($students as $student) {
            if (strpos($student['الاسم'], $name) === 0) {
                $response[] = [
                    'الاسم' => $student['الاسم'],
                    'رقم الجلوس' => $student['رقم الجلوس'],
                    'الدرجه' => $student['الدرجة']
                ];
            }
        }
    }
}

// إرجاع البيانات بصيغة JSON
echo json_encode($response, JSON_UNESCAPED_UNICODE);
?>