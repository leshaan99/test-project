<?php

class TableController
{
    protected const DEFAULT_LIMIT = 10;
    protected const DEFAULT_ORDER = 'ASC';

    protected array $allowedColumns = [];
    protected array $foreignKeys = [];

    private PDO $conn;
    private string $table;
    private string $primaryKey;
    private ?int $id = null;

    public function __construct(Database $database, string $table, string $primaryKey = 'id', array $foreignKeys = [])
    {
        $this->conn = $database->get_connection();
        $this->table = $table;
        $this->primaryKey = $primaryKey;
        $this->foreignKeys = $foreignKeys;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setForeignKeys(array $keys): self
    {
        $this->foreignKeys = array_unique(array_merge($this->foreignKeys, $keys));
        return $this;
    }

    public function get_connection(): PDO
    {
        return $this->conn;
    }

    private function executeQuery(string $query, array $params = [], string $queryType = 'SELECT'): array
    {
        try {
            $stmt = $this->conn->prepare($query);

            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value, is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR);
            }

            $stmt->execute();

            return match (strtoupper($queryType)) {
                'SELECT' => ['data' => $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [], 'error' => null],
                'INSERT' => ['data' => ['last_insert_id' => $this->conn->lastInsertId()], 'error' => null],
                'UPDATE', 'DELETE' => ['data' => ['affected_rows' => $stmt->rowCount()], 'error' => null],
                'SCALAR' => ['data' => ['value' => $stmt->fetchColumn()], 'error' => null],
                default => ['data' => [], 'error' => 'Invalid query type'],
            };
        } catch (PDOException $e) {
            return ['data' => [], 'error' => $e->getMessage()];
        }
    }

    public function getById(int $id, string $orderBy = ''): array
    {
        $query = "SELECT * FROM {$this->table} WHERE status = 1 AND {$this->primaryKey} = :id";
        if ($orderBy) {
            $query .= " ORDER BY {$orderBy}";
        }
        return $this->executeQuery($query, [':id' => $id], 'SELECT');
    }

    public function getByForeignKey(string $foreignKey, mixed $value, string $orderBy = ''): array
    {
        $query = "SELECT * FROM {$this->table} WHERE {$foreignKey} = :value";
        if ($orderBy) {
            $query .= " ORDER BY {$orderBy}";
        }
        return $this->executeQuery($query, [':value' => $value], 'SELECT');
    }

    public function getAll(string $filter = ''): array
    {
        return $this->executeQuery("SELECT * FROM {$this->table} {$filter}", [], 'SELECT');
    }

    public function getAllActive(string $filter = ''): array
    {
        return $this->executeQuery("SELECT * FROM {$this->table} WHERE status = 1 {$filter}", [], 'SELECT');
    }

    public function register(array $data): array
    {
        if (empty($data)) {
            return ['status' => 0, 'error' => 'Invalid input data'];
        }

        $fields = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $query = "INSERT INTO {$this->table} ({$fields}) VALUES ({$placeholders})";

        return $this->executeQuery($query, $data, 'INSERT');
    }

    public function update(array $data): array
    {
        if (empty($data['id'])) {
            return ['status' => 0, 'error' => 'Invalid ID'];
        }

        $id = $data['id'];
        unset($data['id']);

        $updateFields = implode(', ', array_map(fn($key) => "{$key} = :{$key}", array_keys($data)));
        $query = "UPDATE {$this->table} SET {$updateFields} WHERE {$this->primaryKey} = :id";

        return $this->executeQuery($query, array_merge($data, ['id' => $id]), 'UPDATE');
    }

    public function updateByConditions(array $data, array $conditions): array
    {
        if (empty($data) || empty($conditions)) {
            return ['status' => 0, 'error' => 'No data or conditions provided'];
        }

        $updateFields = implode(', ', array_map(fn($key) => "{$key} = :{$key}", array_keys($data)));
        $whereClause = implode(' AND ', array_map(fn($key) => "{$key} = :cond_{$key}", array_keys($conditions)));

        $params = array_merge($data, array_combine(array_map(fn($key) => "cond_{$key}", array_keys($conditions)), $conditions));
        $query = "UPDATE {$this->table} SET {$updateFields} WHERE {$whereClause}";

        return $this->executeQuery($query, $params, 'UPDATE');
    }

    public function delete(array $conditions): array
    {
        if (empty($conditions)) {
            return ['status' => 0, 'error' => 'No conditions provided'];
        }

        $whereClause = implode(' AND ', array_map(fn($key) => "{$key} = :{$key}", array_keys($conditions)));
        $query = "DELETE FROM {$this->table} WHERE {$whereClause}";

        return $this->executeQuery($query, $conditions, 'DELETE');
    }

    public function deleteById(int $id): array
    {
        return $this->delete([$this->primaryKey => $id]);
    }

    public function getCount(): array
    {
        return $this->executeQuery("SELECT COUNT({$this->primaryKey}) as total FROM {$this->table} WHERE status = 1", [], 'SCALAR');
    }

    public function getAllByCategory(string $category): array
    {
        return $this->executeQuery("SELECT * FROM {$this->table} WHERE status = 1 AND category = :category", ['category' => $category], 'SELECT');
    }

    public function getRandomCourses(int $limit = self::DEFAULT_LIMIT): array
    {
        return $this->executeQuery("SELECT * FROM {$this->table} WHERE status = 1 ORDER BY RAND() LIMIT :limit", ['limit' => $limit], 'SELECT');
    }

    public function get_data(array $params = [], string $orderBy = ''): array
    {
        // Initialize response structure
        $result = [
            'data' => [],
            'error' => null
        ];

        try {
            // Start query
            $query = "SELECT * FROM {$this->table} WHERE status = 1";

            // Construct the WHERE clause dynamically
            $conditions = [];
            foreach ($params as $field => $value) {
                $conditions[] = "$field = :$field";
            }

            // Append WHERE conditions if they exist
            if (!empty($conditions)) {
                $query .= " AND " . implode(" AND ", $conditions);
            }

            // Append ORDER BY clause if provided
            if (!empty($orderBy)) {
                $query .= " ORDER BY {$orderBy}";
            }

            // Execute query using the optimized executeQuery method
            $result = $this->executeQuery($query, $params, 'SELECT');
        } catch (PDOException $e) {
            $result['error'] = $e->getMessage();
        }


        return $result;
    }
}
