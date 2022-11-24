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

  // Blog post query
  $reference_result = $reference_post->reference_read();

  // Get row count
  $reference_num = $reference_result->rowCount();

  // Check if any posts
  if($reference_num > 0) {

    // Post array
    $posts_arr['platlist'] = array();

    while($row = $reference_result->fetch(PDO::FETCH_ASSOC)) {
      
      extract($row);

      $post_item = array(

        'id' => $id,
        'site_name' => $site_name,
        'video' => $video,
        'video_name' => $video_name,
        'duration' => $duration,
        'count' => $count, // spots        
        'category' => $category,
        'video_status' => $video_status,
        'videojojo_id' => $videojojo_id,
        'name' => $name,

        'ET_limit' => $ET_limit,
        'TT_limit' => $TT_limit,
        'TTwo_limit' => $TTwo_limit,
        'TF_limit' => $TF_limit,
        'FS_limit' => $FS_limit,

        'g_date' => $g_date,

        'date_published' => $date_published,
        'days_appearance' => $days_appearance,

        'play_start' => $play_start,
        'end_start' => $end_start

      );

      // Push to "data"
      array_push($posts_arr['platlist'], $post_item);
    }

    // Turn to JSON & output
    echo json_encode($posts_arr);

  } else {

    // No Posts
    echo json_encode(
      array('message' => 'No Posts Found')
    );


  }

?>