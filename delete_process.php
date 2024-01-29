<?php
session_start();
require_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_course'])) {
    // Retrieve the selected courseID from the form
    $courseID = $_POST['courseID'];

    try {
        // Start a transaction to ensure atomicity
        $db->beginTransaction();

        // Delete records from tblfields and tblsemesters using inner join
        $sqlDeleteRelated = "DELETE tblfields, tblsemesters
                             FROM tblcourses
                             LEFT JOIN tblfields ON tblcourses.courseID = tblfields.courseID
                             LEFT JOIN tblsemesters ON tblcourses.courseID = tblsemesters.courseID
                             WHERE tblcourses.courseID = ?";
        $stmtDeleteRelated = $db->prepare($sqlDeleteRelated);
        $stmtDeleteRelated->bindParam(1, $courseID, PDO::PARAM_INT);
        $stmtDeleteRelated->execute();

        // Delete record from tblcourses based on courseID
        $sqlDeleteCourse = "DELETE FROM tblcourses WHERE courseID = ?";
        $stmtDeleteCourse = $db->prepare($sqlDeleteCourse);
        $stmtDeleteCourse->bindParam(1, $courseID, PDO::PARAM_INT);
        $stmtDeleteCourse->execute();

        // Commit the transaction
        $db->commit();

        // Redirect after successful deletion
        header("Location: coursedelete.php");
        exit();
    } catch (PDOException $e) {
        // Rollback the transaction on error
        $db->rollBack();
        echo "Error: " . $e->getMessage();
    }
} else {
    // Redirect to an error page or handle the error accordingly
    header("Location: error.php");
    exit();
}
?>
