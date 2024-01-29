<?php
session_start();
require_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register_courses'])) {
    try {
        // Get form data
        $semesterID = $_POST['semester'];
        $fieldID = $_POST['field_of_study'];
        $selectedCourses = isset($_POST['courses']) ? $_POST['courses'] : [];

        // Update tblstudents table
        $updateStudentSql = "UPDATE tblstudents SET semesterName = (SELECT semesterName FROM tblsemesters WHERE semesterID = ?), fieldName = (SELECT fieldName FROM tblfields WHERE fieldID = ?) WHERE studentID = ?";
        $stmtUpdateStudent = $db->prepare($updateStudentSql);
        $stmtUpdateStudent->execute([$semesterID, $fieldID, $_SESSION['studentID']]);

        // Insert selected courses into tblstudentcourses
        foreach ($selectedCourses as $courseID) {
            $insertCourseSql = "INSERT INTO tblstudentcourses (studentID, courseID) VALUES (?, ?)";
            $stmtInsertCourse = $db->prepare($insertCourseSql);
            $stmtInsertCourse->execute([$_SESSION['studentID'], $courseID]);
        }

        // Redirect to the profile page
        header("Location: profile.php");
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    } catch (Exception $e) {
        // Handle other errors
        echo "Error: " . $e->getMessage();
    }
} else {
    // Redirect to the course registration page if accessed without form submission
    header("Location: courseregistration.php");
    exit();
}
?>
