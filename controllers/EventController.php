<?php

class EventController extends TableController
{


 
    public function __construct(Database $database)
    {
  

        $this->set_connection($database->get_connection());
        $this->set_table("events");
        $this->set_primary_key("id");
        // $this->set_foreign_keys(['user','course']);
        parent::__construct($database, $this->table);

        
    }
    public function getEventById($event_id): array
    {
        $result = ['data' => null, 'error' => null];
    
        try {
            $query = "SELECT * FROM $this->table WHERE id = :event_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':event_id', $event_id, PDO::PARAM_INT);
            $stmt->execute();
    
            $event = $stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($event) {
                $result['data'] = $event;
            } else {
                $result['error'] = "Event not found";
            }
        } catch (PDOException $e) {
            $result['error'] = "Database error: " . $e->getMessage();
        }
    
        return $result;
    }
    
 }
