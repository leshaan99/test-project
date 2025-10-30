<?php
class CountryController extends TableController
{
 
    public function __construct(Database $database)
    {

        $this->set_connection($database->get_connection());
        $this->set_table("countries");
        $this->set_primary_key("id");
        // $this->set_foreign_keys(['user','course']);
        parent::__construct($database, $this->table);
        
    }

    public function getCountryNameById($id): array
    {
        $result = array();

        try {
            $query = "SELECT f1,f2  FROM $this->table WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $country = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($country === false) {
                $result['error'] = "Country not found";
            } else {
                $result['name'] = $country['f1'];
                $result['address'] = $country['f2'];
                $result['error'] = null;
            }
        } catch (PDOException $e) {
            $result['error'] = "Database error: " . $e->getMessage();
        }

        return $result;
    }
 }
