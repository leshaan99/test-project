<?php

class CategoryController extends TableController
{

  
    public function __construct(Database $database)
    {
        $this->set_connection($database->get_connection());
        $this->set_table("categories");
        $this->set_primary_key("id");
        parent::__construct($database, $this->table);
    }

    public function getCategoryNameById($id): array
    {
        $result = array();

        try {
            $query = "SELECT f1  FROM $this->table WHERE id = :id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $category = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($category === false) {
                $result['error'] = "Not found";
            } else {
                $result['name'] = $category['f1'];
                $result['error'] = null;
            }
        } catch (PDOException $e) {
            $result['error'] = "Database error: " . $e->getMessage();
        }

        return $result;
    }

 }
