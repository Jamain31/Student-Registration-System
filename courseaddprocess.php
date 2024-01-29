<?php
session_start();


// Include database connection
require_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addCourse'])) {
    // Get form data
    $semesterID = $_POST['semester'];
    $fieldOfStudy = $_POST['fieldOfStudy'];
    $courseName = $_POST['courseName'];

    // Check if the field of study already exists in tblfields for the selected semester
    $checkFieldSql = "SELECT * FROM tblfields WHERE fieldName = ? AND semesterID = ?";
    $stmtCheckField = $db->prepare($checkFieldSql);
    $stmtCheckField->execute([$fieldOfStudy, $semesterID]);
    $existingField = $stmtCheckField->fetch(PDO::FETCH_ASSOC);

    if (!$existingField) {
        // Field of study doesn't exist, insert into tblfields
        $insertFieldSql = "INSERT INTO tblfields (fieldName, semesterID) VALUES (?, ?)";
        $stmtInsertField = $db->prepare($insertFieldSql);
        $stmtInsertField->execute([$fieldOfStudy, $semesterID]);
    }

    // Get the fieldID for the added/existing field of study
    $getFieldIDSql = "SELECT fieldID FROM tblfields WHERE fieldName = ? AND semesterID = ?";
    $stmtGetFieldID = $db->prepare($getFieldIDSql);
    $stmtGetFieldID->execute([$fieldOfStudy, $semesterID]);
    $fieldID = $stmtGetFieldID->fetchColumn();

    // Insert the course into tblcourses
    $insertCourseSql = "INSERT INTO tblcourses (courseName) VALUES (?)";
    $stmtInsertCourse = $db->prepare($insertCourseSql);
    $stmtInsertCourse->execute([$courseName]);

    // Get the courseID for the added course
    $getCourseIDSql = "SELECT courseID FROM tblcourses WHERE courseName = ?";
    $stmtGetCourseID = $db->prepare($getCourseIDSql);
    $stmtGetCourseID->execute([$courseName]);
    $courseID = $stmtGetCourseID->fetchColumn();

    // Insert into tblfields with courseID
    $updateFieldSql = "UPDATE tblfields SET courseID = ? WHERE fieldID = ?";
    $stmtUpdateField = $db->prepare($updateFieldSql);
    $stmtUpdateField->execute([$courseID, $fieldID]);

    // Redirect to the admin profile page
    header("Location: registrarprofile.php");
    exit();
} else {
    // Redirect to the add course page if accessed without form submission
    header("Location: courseadd.php");
    exit();
}
?>
