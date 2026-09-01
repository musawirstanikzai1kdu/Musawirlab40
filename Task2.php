<?php
// Musawirullah Stanikzai - 1234

// Task 2
class StudentCounter {
    public static $count = 0;

    public static function addStudent() {
        self::$count++;
    }
}

StudentCounter::addStudent();
StudentCounter::addStudent();
StudentCounter::addStudent();

echo "Total students: " . StudentCounter::$count;
?>
