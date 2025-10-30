<?php


    private function executeQuery(string $query, array $params = [], string $queryType = 'SELECT'): array
    {
        try {
            $stmt = $this->conn->prepare($query);

            // Bind parameters dynamically
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
            }

            $stmt->execute();

            // Handle different query types
            switch (strtoupper($queryType)) {
                case 'SELECT':
                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                    return ['data' => $data ?: [], 'error' => $data ? null : 'No data found'];

                case 'INSERT':
                    return ['data' => ['last_insert_id' => $this->conn->lastInsertId()], 'error' => null];

                case 'UPDATE':
                case 'DELETE':
                    return ['data' => ['affected_rows' => $stmt->rowCount()], 'error' => null];

                case 'SCALAR': // For COUNT, SUM, AVG, etc.
                    $data = $stmt->fetchColumn();
                    return ['data' => ['value' => $data], 'error' => null];

                default:
                    return ['data' => [], 'error' => 'Invalid query type'];
            }
        } catch (PDOException $e) {
            return ['data' => [], 'error' => $e->getMessage()];
        }
    }



// SELECT (Fetching Data)

public function get_by_id(int $id, string $orderBy = ''): array
{
    $query = "SELECT * FROM {$this->table} WHERE status = 1 AND {$this->primary_key} = :id";
    if (!empty($orderBy)) {
        $query .= " ORDER BY {$orderBy}";
    }
    return $this->executeQuery($query, [':id' => $id], 'SELECT');
}


// INSERT (Adding Data)

public function insert_user(string $name, string $email): array
{
    $query = "INSERT INTO {$this->table} (name, email, status) VALUES (:name, :email, 1)";
    return $this->executeQuery($query, [':name' => $name, ':email' => $email], 'INSERT');
}

// UPDATE (Modifying Data)

public function update_user(int $id, string $name): array
{
    $query = "UPDATE {$this->table} SET name = :name WHERE {$this->primary_key} = :id";
    return $this->executeQuery($query, [':id' => $id, ':name' => $name], 'UPDATE');
}

// DELETE (Removing Data)

public function delete_user(int $id): array
{
    $query = "DELETE FROM {$this->table} WHERE {$this->primary_key} = :id";
    return $this->executeQuery($query, [':id' => $id], 'DELETE');
}

// COUNT (Getting Total Rows)

public function get_user_count(): array
{
    $query = "SELECT COUNT(*) FROM {$this->table} WHERE status = 1";
    return $this->executeQuery($query, [], 'SCALAR');
}

// SUM (Getting Total Amount)

public function get_total_salary(): array
{
    $query = "SELECT SUM(salary) FROM {$this->table} WHERE status = 1";
    return $this->executeQuery($query, [], 'SCALAR');
}

// JOIN Query (Fetching Data with Relationships)

public function get_users_with_roles(): array
{
    $query = "SELECT u.id, u.name, r.role_name 
              FROM users u 
              JOIN roles r ON u.role_id = r.id 
              WHERE u.status = 1";
    return $this->executeQuery($query, [], 'SELECT');
}
