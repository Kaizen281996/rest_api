<?php 

  class Post {

   // DB stuff
   private $conn;
   private $table = 'playlist_data';

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
    public function __construct($db) {
      $this->conn = $db;
    }

      // Create Post
    public function create() {
      
          // Create query
          $query = 'INSERT INTO ' . $this->table . ' SET id = :id, 
                                                         video = :video, 
                                                         video_name = :video_name, 
                                                         video_status = :video_status,

                                                         duration = :duration,
                                                         site_name = :site_name,
                                                         date_time = :date_time,
                                                         count = :count,
                                                         category = :category,
                                                         views = :views,
                                                         date_published = :date_published,
                                                         name = :name,
                                                         end_start = :end_start ';

          // Prepare statement
          $stmt = $this->conn->prepare($query);

          // Clean data
          $this->id = htmlspecialchars(strip_tags($this->id));
          $this->video = htmlspecialchars(strip_tags($this->video));
          $this->video_name = htmlspecialchars(strip_tags($this->video_name));
          $this->video_status = htmlspecialchars(strip_tags($this->video_status));

          $this->duration = htmlspecialchars(strip_tags($this->duration));
          $this->site_name = htmlspecialchars(strip_tags($this->site_name));
          $this->date_time = htmlspecialchars(strip_tags($this->date_time));
          $this->count = htmlspecialchars(strip_tags($this->count));
          $this->category = htmlspecialchars(strip_tags($this->category));
          $this->views = htmlspecialchars(strip_tags($this->views));
          $this->date_published = htmlspecialchars(strip_tags($this->date_published));
          $this->name = htmlspecialchars(strip_tags($this->name));
          $this->end_start = htmlspecialchars(strip_tags($this->end_start));


          // Bind data
          $stmt->bindParam(':id', $this->id);
          $stmt->bindParam(':video', $this->video);
          $stmt->bindParam(':video_name', $this->video_name);
          $stmt->bindParam(':video_status', $this->video_status);

          $stmt->bindParam(':duration', $this->duration);
          $stmt->bindParam(':site_name', $this->site_name);
          $stmt->bindParam(':date_time', $this->date_time);
          $stmt->bindParam(':count', $this->count);
          $stmt->bindParam(':category', $this->category);
          $stmt->bindParam(':views', $this->views);
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
    }


  }

  ?>


