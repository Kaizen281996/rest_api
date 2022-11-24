<?php 

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');

  include_once '../../config/database.php';
  include_once '../../models/data_table_reference.php';

  // Instantiate DB & connect || DATABASE = Reference // PLAYER
  $database = new Database();
  $reference_db = $database->connect();

  // Instantiate blog post object
  $reference_post = new reference($reference_db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

  // Set ID to update
  $reference_post->id = $data->id;

  $reference_post->ET_limit = $data->ET_limit;
  $reference_post->TT_limit = $data->TT_limit;
  $reference_post->TTwo_limit = $data->TTwo_limit;
  $reference_post->TF_limit = $data->TF_limit;
  $reference_post->FS_limit = $data->FS_limit;

  // Update reference_post
  if($reference_post->reference_update()) {
    echo json_encode(
      array('message' => 'Post Updated')
    );

  } else {
    echo json_encode(
      array('message' => 'Post Not Updated')
    );
  }

?>