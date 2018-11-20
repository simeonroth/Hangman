<?php 
include DBWordsAdapter.php;

$theDBA = new DatabaseAdapter();
echo json_encode($theDBA->getAllRecords());

?>