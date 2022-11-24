<?php 

  // Headers
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-With');

  include_once '../../config/database.php';
  include_once '../../models/data_table_reference.php';

  // Instantiate DB & connect || DATABASE = Reference // PLAYER
  $database = new Database();
  $playlist_data_db = $database->connect();

  // Instantiate blog post object
  $reference_post = new reference_insert($playlist_data_db);

  // Get raw posted data
  $data = json_decode(file_get_contents("php://input"));

    // Post Properties
    $reference_post->id = $id;
    $reference_post->site_name = $site_name;    
    $reference_post->video = $video;
    $reference_post->video_name = $video_name;
    $reference_post->video_status = $video_status;
    $reference_post->duration = $duration;
    $reference_post->count = $count;    
    $reference_post->views = $views;    
    $reference_post->category = $category;
    $reference_post->date_time = $date_time;
    $reference_post->date_published = $date_published;
    $reference_post->name = $name;
    $reference_post->end_start = $end_start;

  // Create post
  if($reference_post->reference_create()) {
    echo json_encode(
      array('message' => 'Post Created')
    );

  } else {
    echo json_encode(
      array('message' => 'Post Not Created')
    );
  }

?>
