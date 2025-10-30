<?php
class UniversityController extends TableController
{
 
    public function __construct(Database $database)
    {
   

        $this->set_connection($database->get_connection());
        $this->set_table("universities");
        $this->set_primary_key("id");
        // $this->set_foreign_keys(['user','course']);
        parent::__construct($database, $this->table);
    }

    public function getUniversityCountryIdNameImageById($id): array
    {
        $result = array();

        try {
            $query = "SELECT f1 , img1 , country , f6 FROM $this->table WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $university = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($university === false) {
                $result['error'] = "University not found";
            } else {
                $result['name'] = $university['f1'];
                $result['img'] = $university['img1'];
                $result['country'] = $university['country'];
                $result['location'] = $university['f6'];

                $result['error'] = null;
            }
        } catch (PDOException $e) {
            $result['error'] = "Database error: " . $e->getMessage();
        }

        return $result;
    }
    public function get_all_by_country(string $country): array
    {
        $result = array(
            'data' => [],
            'error' => null,
        );

        try {
            // Prepare the query with a WHERE clause for the country
            $query = "SELECT * FROM $this->table WHERE status=1 AND country = :country";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':country', $country, PDO::PARAM_STR); // Bind the country parameter
            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($data) {
                $result['data'] = $data;
                $result['error'] = null;
             } else {
                $result['error'] = "No data found";
                 }
        } catch (PDOException $e) {
                $result['error'] = $e->getMessage();
            }   

        // Store the error message in the session if there is an error other than "No data found"
        if ($result['error'] !== "No data found") {
            $_SESSION['error'] = $result['error'];
              }

        return $result;
            }
}