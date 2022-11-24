<?php 

  class reference {

   // DB stuff || Reference
   private $reference_conn;
   private $reference_table = 'reference';

   // Post Properties
   public $id;
   public $site_name;
   public $video;
   public $video_name;
   public $duration;
   public $count; // spots  
   public $category;
   public $video_status;
   public $videojojo_id;
   public $name;

   public $ET_limit;
   public $TT_limit;
   public $TTwo_limit;
   public $TF_limit;
   public $FS_limit;

   public $g_date;

   public $date_published;
   public $days_appearance;

   public $play_start;
   public $end_start;

   
   // Constructor with DB
   public function __construct($reference_db) {
      $this->reference_conn = $reference_db;
  }



// FOR [PLAYLIST] //
public function reference_read() {

// CONTENT INFO FPR PLAY //
  $site = "GP Nagata - Hallway"; 
  $active = "Activate";
  $zero = "0";

// DATE $ HOURS //
  date_default_timezone_set('Asia/Manila');
  $hour = date('H');
  $datenow =  time();
  $date=date('Y-m-d');
   
// 8PM TO 10PM //
if ($hour >= 8 && $hour < 10) {
    $endtime = strtotime('10:00:00');

    $query = "SELECT * FROM " . $this->reference_table . " WHERE site_name = '$site' AND video_status = '$active' AND g_date = '$date' AND ET_limit > '$zero' ";
}

// 10PM TO 12PM //
    else if ($hour >= 10 && $hour < 12 ) {
    $endtime = strtotime('12:00:00');

    $query = "SELECT * FROM " . $this->reference_table . " WHERE site_name = '$site' AND video_status = '$active' AND g_date = '$date' AND ET_limit > '$zero' ";
}

// 12PM TO 2PM //
    else if ($hour >= 12 && $hour < 14) {
    $endtime = strtotime('14:00:00');

    $query = "SELECT * FROM " . $this->reference_table . " WHERE site_name = '$site' AND video_status = '$active' AND g_date = '$date' AND ET_limit > '$zero' ";
}

// 2PM TO 4PM //
    else if ($hour >= 14 && $hour < 16) {
    $endtime = strtotime('16:00:00'); 

    $query = "SELECT * FROM " . $this->reference_table . " WHERE site_name = '$site' AND video_status = '$active' AND g_date = '$date' AND ET_limit > '$zero' ";
}

// 4PM TO 6PM //
    else if ($hour >= 16 && $hour < 18) {
    $endtime = strtotime('18:00:00');

    $query = "SELECT * FROM " . $this->reference_table . " WHERE site_name = '$site' AND video_status = '$active' AND g_date = '$date' AND ET_limit > '$zero' ";
}

      // Prepare statement
      $stmt = $this->reference_conn->prepare($query);

      // Execute query
      $stmt->execute();

      return $stmt;

} // reference_read








// FOR [UPDATE CONTENT] //
public function reference_update() {

if (isset($_GET['save'])) {

// CONTENT INFO FPR PLAY //
  $site = "GP Nagata - Hallway"; 
  $active = "Activate";
  $zero = "0";

// DATE $ HOURS //
  date_default_timezone_set('Asia/Manila');
  $hour = date('H');
  $datenow =  time();
  $date=date('Y-m-d');

// CONTENT UPDATE // 
  $limit = $_GET['limit'];
  $id = $_GET['id'];

  $in = 1;
  $plays = $limit - $in;

// 8PM TO 10PM //
if ($hour >= 8 && $hour < 10) {
    $endtime = strtotime('10:00:00');

    $update_query = "UPDATE " . $this->reference_table . " SET ET_limit = '$plays'  WHERE id = '$id' ";
}

// 10PM TO 12PM //
    else if ($hour >= 10 && $hour < 12 ) {
    $endtime = strtotime('12:00:00');

    $update_query = "UPDATE " . $this->reference_table . " SET TT_limit = '$plays'  WHERE id = '$id' ";
}

// 12PM TO 2PM //
    else if ($hour >= 12 && $hour < 14) {
    $endtime = strtotime('14:00:00');

    $update_query = "UPDATE " . $this->reference_table . " SET TTwo_limit = '$plays'  WHERE id = '$id' ";
}

// 2PM TO 4PM //
    else if ($hour >= 14 && $hour < 16) { 
    $endtime = strtotime('16:00:00');

    $update_query = "UPDATE " . $this->reference_table . " SET TF_limit = '$plays'  WHERE id = '$id' ";    
}

// 4PM TO 6PM //
    else if ($hour >= 16 && $hour < 18) {
    $endtime = strtotime('18:00:00');

    $update_query = "UPDATE " . $this->reference_table . " SET FS_limit = '$plays'  WHERE id = '$id' ";
}

          // Prepare statement
          $stmt = $this->reference_conn->prepare($update_query);

          // Clean data
          $this->ET_limit = htmlspecialchars(strip_tags($this->ET_limit));
          $this->TT_limit = htmlspecialchars(strip_tags($this->TT_limit));
          $this->TTwo_limit = htmlspecialchars(strip_tags($this->TTwo_limit));
          $this->TF_limit = htmlspecialchars(strip_tags($this->TF_limit));
          $this->FS_limit = htmlspecialchars(strip_tags($this->FS_limit));
          $this->id = htmlspecialchars(strip_tags($this->id));

          // Bind data
          $stmt->bindParam('$plays', $this->ET_limit);
          $stmt->bindParam('$plays', $this->TT_limit);
          $stmt->bindParam('$plays', $this->TTwo_limit);
          $stmt->bindParam('$plays', $this->TF_limit);
          $stmt->bindParam('$plays', $this->FS_limit);
          $stmt->bindParam('$id', $this->id);

          // Execute query
          if($stmt->execute()) {
            return true;
          }

          // Print error if something goes wrong
          printf("Error: %s.\n", $stmt->error);

          return false;

  } // save

} // reference_update


} // class reference


?>













<?php 

  // INSERT DATA //
  class reference_insert {

   // DB stuff || Playlist_data
   private $playlist_data_conn;
   private $playlist_data_table = 'playlist_data';

   // Post Properties
   public $id;
   public $video;
   public $video_name;
   public $video_status;

   public $duration;
   public $site_name;
   public $date_time;
   public $count;
   public $category;
   public $views;
   public $date_published;
   public $name;
   public $end_start;


    // Constructor with DB
    public function __construct($playlist_data_db) {
      $this->playlist_data_conn = $playlist_data_db;
    }




// FOR [INSERT CONTENT DATA] //
public function reference_create() {

if (isset($_GET['save'])) {

          // Create query
          $insert_query = 'INSERT INTO ' . $this->playlist_data_table . ' SET id = :id, 
                                                                site_name = :site_name,
                                                                video = :video, 
                                                                video_name = :video_name, 
                                                                video_status = :video_status,
                                                                duration = :duration,
                                                                count = :count,
                                                                views = :views,      
                                                                category = :category,           
                                                                date_time = :date_time,
                                                                date_published = :date_published,
                                                                name = :name,
                                                                end_start = :end_start ';

          // Prepare statement
          $stmt = $this->playlist_data_conn->prepare($insert_query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));
          $this->site_name = htmlspecialchars(strip_tags($this->site_name));          
          $this->video = htmlspecialchars(strip_tags($this->video));
          $this->video_name = htmlspecialchars(strip_tags($this->video_name));
          $this->video_status = htmlspecialchars(strip_tags($this->video_status));
          $this->duration = htmlspecialchars(strip_tags($this->duration));
          $this->count = htmlspecialchars(strip_tags($this->count));
          $this->views = htmlspecialchars(strip_tags($this->views));
          $this->category = htmlspecialchars(strip_tags($this->category));
          $this->date_time = htmlspecialchars(strip_tags($this->date_time));
          $this->date_published = htmlspecialchars(strip_tags($this->date_published));
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->end_start = htmlspecialchars(strip_tags($this->end_start));

          // Bind data
          $stmt->bindParam(':id', $this->id);
          $stmt->bindParam(':site_name', $this->site_name);          
          $stmt->bindParam(':video', $this->video);
          $stmt->bindParam(':video_name', $this->video_name);
          $stmt->bindParam(':video_status', $this->video_status);
          $stmt->bindParam(':duration', $this->duration);
          $stmt->bindParam(':count', $this->count);
          $stmt->bindParam(':views', $this->views);
          $stmt->bindParam(':category', $this->category);          
          $stmt->bindParam(':date_time', $this->date_time);
          $stmt->bindParam(':date_published', $this->date_published);
          $stmt->bindParam(':name', $this->name);
          $stmt->bindParam(':end_start', $this->end_start);

          // Execute query
          if($stmt->execute()) {
            return true;
      }

      // Print error if something goes wrong
      printf("Error: %s.\n", $stmt->error);

      return false;
  
  } // save

} // reference_create


} // reference_insert


?>