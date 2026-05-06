<?php
// app/Services/CodeExecutionService.php
namespace App\Services;

class CodeExecutionService
{
    public function executePython($code, $testCases)
    {
        // تأكد أن test_cases مصفوفة
        if (is_string($testCases)) {
            $testCases = json_decode($testCases, true) ?? [];
        }

        $result = [
            'passed' => 0,
            'total' => count($testCases),
            'details' => []
        ];

        // إذا لم توجد اختبارات، ارجع نتيجة فارغة
        if (empty($testCases)) {
            return $result;
        }

        foreach ($testCases as $test) {
            try {
                $output = $this->runPythonCode($code, $test['input']);
                $isPassed = $this->compareOutput($output, $test['expected_output']);
                
                $result['details'][] = [
                    'input' => $test['input'],
                    'expected' => $test['expected_output'],
                    'actual' => $output,
                    'passed' => $isPassed
                ];

                if ($isPassed) {
                    $result['passed']++;
                }
            } catch (\Exception $e) {
                $result['details'][] = [
                    'input' => $test['input'],
                    'expected' => $test['expected_output'],
                    'actual' => 'Error: ' . $e->getMessage(),
                    'passed' => false
                ];
            }
        }

        return $result;
    }

    private function runPythonCode($code, $input)
    {
        // تنظيف الكود وإصلاح المسافات البادئة
        $cleanedCode = $this->cleanAndFixCode($code);
        
        // إنشاء ملف تنفيذ
        $tempFile = tempnam(sys_get_temp_dir(), 'python_') . '.py';
        
        // كتابة الكود الكامل في الملف
        $fullCode = $cleanedCode . "\n\n" . $this->generateTestCall($cleanedCode, $input);
        
        file_put_contents($tempFile, $fullCode);
        
        // تنفيذ الكود
        $command = "python " . escapeshellarg($tempFile) . " 2>&1";
        $output = shell_exec($command);
        
        // تنظيف الملف المؤقت
        if (file_exists($tempFile)) {
            unlink($tempFile);
        }
        
        return trim($output ?? 'No output');
    }

    private function cleanAndFixCode($code)
    {
        // تقسيم الكود إلى أسطر
        $lines = explode("\n", $code);
        $cleanedLines = [];
        $indentationLevel = 0;
        
        foreach ($lines as $line) {
            $trimmedLine = trim($line);
            
            // تجاهل الأسطر الفارغة والتعليقات العربية
            if (empty($trimmedLine) || preg_match('/^\\s*#.*[أ-ي]/u', $trimmedLine)) {
                continue;
            }
            
            // إزالة كلمة pass وحدها
            if ($trimmedLine === 'pass') {
                continue;
            }
            
            // إصلاح المسافات البادئة
            $fixedLine = $this->fixIndentation($line, $indentationLevel);
            
            // تحديث مستوى المسافات البادئة
            $indentationLevel = $this->updateIndentationLevel($trimmedLine, $indentationLevel);
            
            $cleanedLines[] = $fixedLine;
        }
        
        return implode("\n", $cleanedLines);
    }

    private function fixIndentation($line, $currentLevel)
    {
        $trimmedLine = trim($line);
        
        // إذا كان السطر فارغاً بعد التنظيف، تخطيه
        if (empty($trimmedLine)) {
            return '';
        }
        
        // تحديد عدد المسافات البادئة (4 مسافات لكل مستوى)
        $indentation = str_repeat('    ', $currentLevel);
        
        // إذا كان السطر يحتوي على else, elif, except, finally بدون def أو class قبلها
        if (preg_match('/^(else|elif|except|finally):/', $trimmedLine)) {
            // تقليل مستوى المسافات البادئة بمستوى واحد
            $indentation = str_repeat('    ', max(0, $currentLevel - 1));
        }
        
        return $indentation . $trimmedLine;
    }

    private function updateIndentationLevel($line, $currentLevel)
    {
        // إذا كان السطر ينتهي بـ : وليس تعليقاً، زد مستوى المسافات البادئة
        if (str_ends_with($line, ':') && !str_starts_with(trim($line), '#')) {
            return $currentLevel + 1;
        }
        
        // إذا كان السطر يبدأ بـ return أو pass أو break أو continue، فقد نحتاج لتقليل المستوى
        if (preg_match('/^(return|pass|break|continue|raise)/', $line)) {
            return max(0, $currentLevel - 1);
        }
        
        return $currentLevel;
    }

    private function generateTestCall($code, $input)
    {
        $functionName = $this->detectFunctionName($code);
        
        if (empty($functionName)) {
            return "# لا يمكن كشف اسم الدالة";
        }

        // معالجة الإدخال بناءً على نوعه
        $input = trim($input);
        
        // إذا كان الإدخال يحتوي على فواصل (معطيات متعددة)
        if (str_contains($input, ',')) {
            $args = explode(',', $input);
            $args = array_map('trim', $args);
            
            $processedArgs = [];
            foreach ($args as $arg) {
                $arg = trim($arg);
                // إذا كان رقم
                if (is_numeric($arg)) {
                    $processedArgs[] = $arg;
                } 
                // إذا كان نصاً بين quotes
                elseif (preg_match('/^[\'\"].*[\'\"]$/', $arg)) {
                    $processedArgs[] = $arg;
                }
                // إذا كان نصاً عادياً
                else {
                    $processedArgs[] = "'" . $arg . "'";
                }
            }
            
            return "result = " . $functionName . "(" . implode(', ', $processedArgs) . ")\nprint(result)";
        }
        
        // معالجة الإدخال الفردي
        if (is_numeric($input)) {
            return "result = " . $functionName . "(" . $input . ")\nprint(result)";
        } elseif (preg_match('/^[\'\"].*[\'\"]$/', $input)) {
            return "result = " . $functionName . "(" . $input . ")\nprint(result)";
        } else {
            return "result = " . $functionName . "('" . $input . "')\nprint(result)";
        }
    }

    private function detectFunctionName($code)
    {
        if (preg_match('/def\s+(\w+)\s*\(/', $code, $matches)) {
            return $matches[1];
        }
        
        // محاولة كشف أسماء الدوال الشائعة من التحديات
        $commonFunctions = [
            'sum', 'longest_word', 'is_prime', 'multiply_list', 'count_words',
            'to_uppercase', 'sum_even', 'reverse_string', 'shortest_word',
            'count_occurrences', 'is_palindrome', 'merge_lists', 'calculate_average',
            'fibonacci', 'sort_list', 'binary_search', 'prime_factors',
            'word_frequency', 'create_matrix', 'is_balanced'
        ];
        
        foreach ($commonFunctions as $func) {
            if (strpos($code, $func) !== false) {
                return $func;
            }
        }
        
        return 'solution';
    }

    private function compareOutput($actual, $expected)
    {
        // تنظيف النتائج قبل المقارنة
        $actual = trim($actual);
        $expected = trim($expected);
        
        // مقارنة مباشرة
        if ($actual === $expected) {
            return true;
        }
        
        // محاولة مقارنة كأرقام
        if (is_numeric($actual) && is_numeric($expected)) {
            return floatval($actual) === floatval($expected);
        }
        
        // مقارنة مع تجاهل الفروق الطفيفة في النصوص
        if (strcasecmp($actual, $expected) === 0) {
            return true;
        }
        
        // مقارنة القوائم (إذا كانت النتائج قوائم)
        if ($this->compareLists($actual, $expected)) {
            return true;
        }
        
        return false;
    }

    private function compareLists($actual, $expected)
    {
        // محاولة تحليل النتائج كقوائم
        try {
            $actualList = json_decode($actual, true);
            $expectedList = json_decode($expected, true);
            
            if (is_array($actualList) && is_array($expectedList)) {
                return $actualList == $expectedList;
            }
        } catch (\Exception $e) {
            // إذا فشل التحليل، استمر بالمقارنة العادية
        }
        
        return false;
    }

    // دالة مساعدة للتحقق من تثبيت Python
    public function isPythonInstalled()
    {
        $output = shell_exec('python --version 2>&1');
        return str_contains($output, 'Python');
    }
}