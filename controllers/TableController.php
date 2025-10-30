<?php

class TableController
{

    protected array $foreignKeys = [];

    protected PDO $conn;
    protected string $table;
    protected string $primaryKey;
    private $id;

    public function __construct(Database $database, string $table, string $primaryKey = 'id', array $foreignKeys = [])
    {
        $this->conn = $database->get_connection();
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->foreignKeys = $foreignKeys;
    }

    public function set_id(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function get_id(): ?int
    {
        return $this->id;
    }

    public function set_foreign_keys(array $keys): self
    {
        $this->foreignKeys = array_unique(array_merge($this->foreignKeys, $keys));
        return $this;
    }

    public function get_connection(): PDO
    {
        return $this->conn;
    }

    public function set_connection($conn): self
    {
        $this->conn =  $conn;
        return $this;
    }

    public function get_table(): string
    {
        return $this->table;
    }

    public function set_table(string $table): self
    {
        $this->table = $table;
        return $this;
    }

    public function get_primary_key(): string
    {
        return $this->primaryKey;
    }

    public function set_primary_key(string $primaryKey): self
    {
        $this->primaryKey = $primaryKey;
        return $this;
    }

    // Main Db Execution Method

    public function execute_query(string $query, array $params = [], string $queryType = 'SELECT'): array
    {
        try {
            $stmt = $this->conn->prepare($query);

            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
            }

            $stmt->execute();

            return match (strtoupper($queryType)) {
                'SELECTONE' => ['data' => $stmt->fetch(PDO::FETCH_ASSOC), 'error' => null],
                'SELECT' => ['data' => ($queryType === 'SELECT' ? $stmt->fetchAll(PDO::FETCH_ASSOC) : []), 'error' => null],
                'INSERT' => ['data' => ['last_insert_id' => $this->conn->lastInsertId()], 'error' => null, 'message' => "Record successfully inserted", 'code' => 200],
                'DELETE' => ['data' => ['affected_rows' => $stmt->rowCount()], 'error' => null, 'message' => "successfully updated", 'code' => 200],
                'UPDATE' => ['data' => ['affected_rows' => $stmt->rowCount()], 'error' => null, 'message' => "successfully Deleted", 'code' => 200],
                'SCALAR' => ['data' => ['value' => $stmt->fetchColumn()], 'error' => null],
                default => ['data' => [], 'error' => 'Invalid query type'],
            };
        } catch (PDOException $e) {
            return ['data' => [], 'error' => $e->getMessage(), 'code' => 200];
        }
    }

    public function get_by_id(int $id, string $orderBy = ''): array
    {
        $query = "SELECT * FROM {$this->table} WHERE  {$this->primaryKey} = :id";
        if ($orderBy) {
            $query .= " ORDER BY {$orderBy}";
        }

        $result = $this->execute_query($query, [':id' => $id], 'SELECTONE');

        // Handle case where no data is found
        if (!$result['data']) {
            $result['error'] = "No data found";
            $result['data'] = []; // Ensure data key is always present
        }

        return $result;
    }


    public function get_one_by_id(int $id, string $orderBy = ''): array
    {
        $query = "SELECT * FROM {$this->table} WHERE status = 1 AND {$this->primaryKey} = :id";
        if ($orderBy) {
            $query .= " ORDER BY {$orderBy}";
        }

        $result = $this->execute_query($query, [':id' => $id], 'SELECTONE');

        // Handle case where no data is found
        if (!$result['data']) {
            $result['error'] = "No data found";
            $result['data'] = []; // Ensure data key is always present
        }

        return $result;
    }



    public function get_by_foreignKey(string $foreignKey, mixed $value, string $orderBy = ''): array
    {
        $query = "SELECT * FROM {$this->table} WHERE status = 1 AND {$foreignKey} = :value";

        if ($orderBy) {
            $query .= " ORDER BY {$orderBy}";
        }

        $result = $this->execute_query($query, [':value' => $value], 'SELECT');

        if (!$result['data']) {
            $result['error'] = "No data found";
            $result['data'] = [];
        }

        return $result;
    }


    public function is_registerd($data, $chek_keys = []): bool
    {

        $query = "SELECT * FROM $this->table ";
        if ($chek_keys) {
            $i = 0;
            foreach ($chek_keys as $key) {

                if ($i > 0) {
                    $query .= " AND ";
                } else {
                    $query .= " WHERE ";
                }

                $query .= "{$key} = '$data[$key]'";
                $i++;
            }
        }




        $result = $this->execute_query($query, [], 'SELECT');


        if ($result['data'] == false) {
            return false;
        } else {
            return true;
        }
    }


    public function get_all(): array
    {
        $result = array(
            'data' => [],
            'error' => null,
        );


        try {
            $query = "SELECT * FROM $this->table where status=1";

            $stmt = $this->conn->prepare($query);
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

        return $result;
    }

    public function get_all_with_delete(): array
    {
        $result = array(
            'data' => [],
            'error' => null,
        );


        try {
            $query = "SELECT * FROM $this->table ";

            $stmt = $this->conn->prepare($query);
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
        if ($result['error'] != 'No data found') {
            $_SESSION['error'] = $result['error'];
        }
        return $result;
    }


    public function get_all_tops($tops = 10): array
    {
        $result = array(
            'data' => [],
            'error' => null,
        );


        try {
            $query = "SELECT * FROM $this->table where status=1  LIMIT $tops";

            $stmt = $this->conn->prepare($query);
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
        if ($result['error'] != 'No data found') {
            $_SESSION['error'] = $result['error'];
        }
        return $result;
    }



    public function get_data($params = array(), $orderBy = ''): array
    {
        $result = array(
            'data' => [],
            'error' => null,
        );

        try {
            // Construct the base query
            $query = "SELECT * FROM $this->table WHERE status=1";

            // Add conditions if params exist
            if (!empty($params)) {
                $conditions = [];
                foreach ($params as $field => $value) {
                    $conditions[] = "$field = :$field";
                }
                $query .= " AND " . implode(" AND ", $conditions);
            }

            // Append ORDER BY clause if provided
            if (!empty($orderBy)) {
                $query .= " ORDER BY $orderBy";
            }

            // Prepare the statement
            $stmt = $this->conn->prepare($query);

            // Bind parameters if they exist
            if (!empty($params)) {
                foreach ($params as $field => &$value) {
                    $stmt->bindParam(":$field", $value);
                }
            }

            // Execute the statement
            $stmt->execute();

            // Fetch the data
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Process the result
            if ($data) {
                $result['data'] = $data;
            } else {
                $result['error'] = "No data found";
            }
        } catch (PDOException $e) {
            $result['error'] = $e->getMessage();
        }

        if ($result['error'] && $result['error'] !== 'No data found') {
            $_SESSION['error'] = $result['error'];
        }

        return $result;
    }

    public function get_data_limit($params = array(), $orderBy = '', $limit = 10): array
    {
        $result = array(
            'data' => [],
            'error' => null,
        );

        try {
            // Construct the query
            $query = "SELECT * FROM $this->table WHERE ";

            // Construct the WHERE clause from the params array
            $conditions = [];
            foreach ($params as $field => $value) {
                $conditions[] = "$field = :$field";
            }
            $query .= implode(" AND ", $conditions);
            $query .= " AND status=1 ";
            // Append ORDER BY clause if $orderBy is provided
            if (!empty($orderBy)) {
                $query .= " ORDER BY $orderBy";
            }

            // Add LIMIT clause to get the last 10 records
            $query .= " LIMIT $limit";

            // Prepare the statement
            $stmt = $this->conn->prepare($query);

            // Bind parameters
            foreach ($params as $field => &$value) {
                $stmt->bindParam(":$field", $value);
            }

            // Execute the statement
            $stmt->execute();

            // Fetch the data
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Process the result
            if ($data) {
                $result['data'] = $data;
                $result['error'] = null;
            } else {
                $result['error'] = "No data found";
            }
        } catch (PDOException $e) {
            $result['error'] = $e->getMessage();
        }

        if ($result['error'] != 'No data found') {
            $_SESSION['error'] = $result['error'];
        }

        return $result;
    }


    public function get_data_sql($query, $params = array()): array
    {
        $result = array(
            'data' => [],
            'error' => null,
        );

        try {
            $stmt = $this->conn->prepare($query);
            $stmt->execute($params);

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
        if ($result['error'] != 'No data found') {
            $_SESSION['error'] = $result['error'];
        }
        return $result;
    }
    public function register($data): array
    {
        $result = array();
        $fields = '';
        $placeholders = '';
        $params = array();
        $result['message'] = '';


        foreach ($data as $field => $value) {
            $fields .= "$field, ";
            $placeholders .= ":$field, ";
            $params[$field] = $value;
        }

        $fields = rtrim($fields, ', ');
        $placeholders = rtrim($placeholders, ', ');

        try {

            $query = "INSERT INTO $this->table ($fields) VALUES ($placeholders)";
            $stmt = $this->conn->prepare($query);


            if ($stmt->execute($params)) {
                $result['status'] = $stmt->rowCount();
                $result['inserted_id'] = $this->conn->lastInsertId($this->primaryKey);
                $result['message'] = "Record successfully inserted";
                $result['code'] = 200;
                $result['error'] = null;
            } else {
                $result['error'] = "Insert failed";
                $result['code'] = 200;
            }
        } catch (PDOException $e) {
            $result['error'] = $e->getMessage();
            $result['code'] = 400;
        }

        $_SESSION['error'] = $result['error'];

        // $_SESSION['message'] = array(
        //     'title' => 'Add Record',
        //     'text' => $result['message'],
        //     'icon' => 'success'
        // );


        return $result;
    }
    public function update($data): array
    {
        $result = array();
        $out = array();


        $id = $data['id'] ?? 0;

        if ($id > 0) {
            $result = $this->get_by_id($id);

            if ($result['error'] == null) {
                $update_fields = '';
                $params = [];

                foreach ($data as $field => $value) {
                    if (array_key_exists($field, $result['data'])) {
                        if ($result['data'][$field] != $value) {
                            $update_fields .= "$field = :$field, ";
                            $params[$field] = $value;
                        }
                    } else {
                        $out[$field] = "incorrect input";
                        $result['error'] = "incorrect input";
                    }
                }

                $update_fields = rtrim($update_fields, ', ');

                if (!empty($update_fields)) {
                    try {
                        $query = "UPDATE $this->table SET $update_fields WHERE $this->primaryKey = :id";
                        $params['id'] = $id;

                        $stmt = $this->conn->prepare($query);

                        if ($stmt->execute($params)) {
                            $result['status'] = $stmt->rowCount();
                            $result['error'] = null;
                        } else {
                            $result['error'] = "Update failed";
                        }
                    } catch (PDOException $e) {
                        $result['error'] = $e->getMessage();
                        $result['status'] = 0;
                    }
                }

                $result['message'] = $out;
            }
        }


        return $result;
    }

    public function update_or_inset($data, $table = '', $keys = []): array
    {
        $table = $table == '' ? $this->table : $table;

        // Check existence by custom keys if provided
        if (!empty($keys)) {
            // Validate all keys exist in data
            foreach ($keys as $key) {
                if (!isset($data[$key])) {
                    return ['error' => "Missing key '$key' in data"];
                }
            }

            // Build WHERE clause and parameters
            $where = [];
            $params = [];
            foreach ($keys as $key) {
                $where[] = "$key = :where_$key";
                $params[":where_$key"] = $data[$key];
            }
            $whereClause = implode(' AND ', $where);

            try {
                // Check for existing records
                $stmt = $this->conn->prepare("SELECT COUNT(*) FROM $table WHERE $whereClause");
                $stmt->execute($params);
                $exists = (int)$stmt->fetchColumn();

                if ($exists > 0) {
                    // UPDATE all non-key fields
                    $updateFields = [];
                    $updateParams = $params; // Start with WHERE params

                    foreach ($data as $field => $value) {
                        if (!in_array($field, $keys)) {
                            $updateFields[] = "$field = :update_$field";
                            $updateParams[":update_$field"] = $value;
                        }
                    }

                    if (!empty($updateFields)) {
                        $updateClause = implode(', ', $updateFields);
                        $query = "UPDATE $table SET $updateClause WHERE $whereClause";
                        $stmt = $this->conn->prepare($query);
                        $stmt->execute($updateParams);

                        return [
                            'status' => 'updated',
                            'affected_rows' => $stmt->rowCount()
                        ];
                    }
                    return ['status' => 'no_fields_to_update'];
                } else {
                    // INSERT new record
                    $columns = array_keys($data);
                    $values = array_map(function ($col) {
                        return ":$col";
                    }, $columns);

                    $query = "INSERT INTO $table (" . implode(', ', $columns) . ") 
                          VALUES (" . implode(', ', $values) . ")";

                    $stmt = $this->conn->prepare($query);
                    $stmt->execute($data);

                    return [
                        'status' => 'inserted',
                        'insert_id' => $this->conn->lastInsertId()
                    ];
                }
            } catch (PDOException $e) {
                return ['error' => $e->getMessage()];
            }
        } else {
            return ['error' => 'No keys provided for update_or_inset operation'];
        }
    }


    public function update_by_conditions($data, $conditions = []): array
    {
        $result = array();
        $out = array();

        if (!empty($data) && !empty($conditions)) {
            $update_fields = '';
            $where_clause = '';
            $params = [];

            // Prepare the fields for update
            foreach ($data as $field => $value) {
                $update_fields .= "$field = :$field, ";
                $params[$field] = $value;
                $out[$field] = "prepared for update";
            }

            // Remove trailing comma from update fields
            $update_fields = rtrim($update_fields, ', ');

            // Construct the WHERE clause from conditions
            foreach ($conditions as $field => $value) {
                $where_clause .= "$field = :cond_$field AND ";
                $params["cond_$field"] = $value;
            }

            // Remove trailing ' AND ' from where clause
            $where_clause = rtrim($where_clause, ' AND ');

            if (!empty($update_fields) && !empty($where_clause)) {
                try {
                    $query = "UPDATE $this->table SET $update_fields WHERE $where_clause";
                    $stmt = $this->conn->prepare($query);

                    if ($stmt->execute($params)) {
                        $result['status'] = $stmt->rowCount();
                        $result['message'] = "Update successful";
                        $result['error'] = null;
                    } else {
                        $result['error'] = "Update failed";
                    }
                } catch (PDOException $e) {
                    $result['error'] = $e->getMessage();
                    $result['status'] = 0;
                }
            } else {
                $result['error'] = "Invalid update fields or conditions";
            }
        } else {
            $result['error'] = "No data or conditions provided";
        }

        $result['message'] = $out;

        $_SESSION['error'] = $result['error'];

        $_SESSION['message'] = array(
            'title' => 'Update Record',
            'text' => $result['message'],
            'icon' => 'success'
        );

        return $result;
    }
    public function delete_by_id($id): array
    {
        $result = array();

        // Check if id is valid
        if ($id > 0) {
            try {
                // Prepare the SQL statement
                $query = "DELETE FROM $this->table WHERE $this->primaryKey = :id";
                $stmt = $this->conn->prepare($query);
                $stmt->bindParam(':id', $id, PDO::PARAM_INT);

                // Execute the statement
                if ($stmt->execute()) {
                    $result['status'] = $stmt->rowCount();
                    $result['message'] = "Record successfully deleted";
                    $result['error'] = null;
                } else {
                    $result['error'] = "Delete failed";
                }
            } catch (PDOException $e) {
                $result['error'] = $e->getMessage();
            }
        } else {
            $result['error'] = "Invalid ID";
        }

        $_SESSION['error'] = $result['error'];

        // $_SESSION['message'] = array(
        //     'title' => 'Delete Record',
        //     'text' => $result['message'],
        //     'icon' => 'success'
        // );
        return $result;
    }

    public function delete($conditions): array
    {
        $result = array();

        // Check if conditions array is not empty
        if (!empty($conditions)) {
            try {
                // Build the WHERE clause
                $where_clause = '';
                $params = [];
                foreach ($conditions as $field => $value) {
                    $where_clause .= "$field = :$field AND ";
                    $params[$field] = $value;
                }
                $where_clause = rtrim($where_clause, ' AND ');

                // Prepare the SQL statement
                $query = "DELETE FROM $this->table WHERE $where_clause";
                $stmt = $this->conn->prepare($query);

                // Bind the parameters
                foreach ($params as $field => $value) {
                    $stmt->bindValue(":$field", $value);
                }

                // Execute the statement
                if ($stmt->execute()) {
                    $result['status'] = $stmt->rowCount();
                    $result['message'] = "Record(s) successfully deleted";
                    $result['error'] = null;
                } else {
                    $result['error'] = "Delete failed";
                }
            } catch (PDOException $e) {
                $result['error'] = $e->getMessage();
                $result['status'] = 0;
            }
        } else {
            $result['error'] = "No conditions provided";
            $result['status'] = 0;
        }

        $_SESSION['error'] = $result['error'];

        $_SESSION['message'] = array(
            'title' => 'Delete Record',
            'text' => $result['message'],
            'icon' => 'success'
        );

        return $result;
    }



    public function get_count(): array
    {


        $result = array(
            'data' => [],
            'error' => null,
        );

        try {
            $query = "SELECT COUNT(id) as tot FROM $this->table WHERE status=1";


            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                $result['data'] = $data;
                $result['error'] = null;
            } else {
                $result['error'] = "No data found";
            }
        } catch (PDOException $e) {
            $result['error'] = $e->getMessage();
        }



        return $result;
    }

    public function get_count_anyone(string $column = "id", string $condition = "1=1"): array
    {
        $result = [
            'data' => [],
            'error' => null,
        ];

        try {
            // Build query dynamically
            $query = "SELECT COUNT($column) AS tot FROM {$this->table} WHERE $condition";

            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                $result['data'] = $data;
            } else {
                $result['error'] = "No data found";
            }
        } catch (PDOException $e) {
            $result['error'] = $e->getMessage();
        }

        return $result;
    }




    public function get_all_by_category(string $category): array
    {
        $result = array(
            'data' => [],
            'error' => null,
        );

        try {
            // Prepare the query with a WHERE clause for the country
            $query = "SELECT * FROM $this->table WHERE status=1 AND f7 = :category";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':category', $category, PDO::PARAM_STR); // Bind the country parameter
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


    public function get_random_courses(int $limit = 10): array
    {
        $result = array(
            'data' => [],
            'error' => null,
        );

        try {
            // Prepare the query to fetch random courses with LIMIT
            $query = "SELECT * FROM $this->table WHERE status = 1 ORDER BY RAND() LIMIT :limit";

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':limit', $limit, PDO::PARAM_INT); // Bind the limit parameter
            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            if ($data) {
                $result['data'] = $data;
                $result['error'] = null;
            } else {
                $result['error'] = "No courses found";
            }
        } catch (PDOException $e) {
            $result['error'] = $e->getMessage();
        }

        // Store the error message in the session if there is an error other than "No courses found"
        if ($result['error'] !== "No courses found") {
            $_SESSION['error'] = $result['error'];
        }

        return $result;
    }
}
