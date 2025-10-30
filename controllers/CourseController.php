<?php
class CourseController extends TableController
{

    public function __construct(Database $database)
    {

        $this->set_connection($database->get_connection());
        $this->set_table("courses");
        $this->set_primary_key("id");
        $this->set_foreign_keys(['university']);
        parent::__construct($database, $this->table);
    }

    public function getCourses($page = 1, $records_per_page = 10, $filters = []): array
    {
        $result = [
            'courses' => [],
            'total_pages' => 0,
            'error' => null,
        ];

        try {
            // Base query construction
            $baseQuery = "FROM $this->table AS courses";
            $whereClauses = ["courses.status = 1"];
            $params = [];

            // Add university join if necessary
            if (!empty($filters['country_id'])) {
                $baseQuery .= " LEFT JOIN universities ON courses.university = universities.id";
                $whereClauses[] = "universities.status = 1";
                $whereClauses[] = "universities.country = :country_id";
                $params[':country_id'] = $filters['country_id'];
            }

            // Build filter conditions
            if (!empty($filters['search'])) {
                $whereClauses[] = "courses.f2 LIKE :search";
                $params[':search'] = '%' . $filters['search'] . '%';
            }

            if (!empty($filters['study_level'])) {
                $whereClauses[] = "courses.f4 = :study_level";
                $params[':study_level'] = $filters['study_level'];
            }

            if (!empty($filters['subject'])) {
                $whereClauses[] = "courses.category = :subject";
                $params[':subject'] = $filters['subject'];
            }

            // Combine WHERE clause
            $where = !empty($whereClauses) ? ' WHERE ' . implode(' AND ', $whereClauses) : '';

            // Pagination calculations
            $offset = ($page - 1) * $records_per_page;

            // Main data query
            $query = "SELECT courses.* $baseQuery $where 
                      LIMIT :records_per_page OFFSET :offset";

            $stmt = $this->conn->prepare($query);

            // Bind parameters
            foreach ($params as $key => $value) {
                $stmt->bindValue($key, $value);
            }
            $stmt->bindValue(':records_per_page', $records_per_page, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);

            $stmt->execute();
            $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // Total count query
            $countQuery = "SELECT COUNT(*) AS total $baseQuery $where";
            $countStmt = $this->conn->prepare($countQuery);

            foreach ($params as $key => $value) {
                $countStmt->bindValue($key, $value);
            }

            $countStmt->execute();
            $total_records = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];

            // Prepare result
            if ($courses) {
                $result['courses'] = $courses;
                $result['total_pages'] = ceil($total_records / $records_per_page);
            } else {
                $result['error'] = "No courses found";
            }
        } catch (PDOException $e) {
            $result['error'] = "Database error: " . $e->getMessage();
        }

        return $result;
    }


    public function getCourseById($course_id): array
    {
        $result = ['data' => null, 'error' => null];

        try {
            $query = "SELECT * FROM $this->table WHERE id = :course_id";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':course_id', $course_id, PDO::PARAM_INT);
            $stmt->execute();

            $course = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($course) {
                $result['data'] = $course;
            } else {
                $result['error'] = "Course not found";
            }
        } catch (PDOException $e) {
            $result['error'] = "Database error: " . $e->getMessage();
        }

        return $result;
    }

    public function get_course_name($course_id): string
    {
        $query = "SELECT f2 FROM {$this->table} WHERE {$this->primaryKey} = :course_id LIMIT 1";
        $result = $this->execute_query($query, [':course_id' => $course_id], 'SCALAR');

        return $result['data']['value'] ?? 'Unknown Course';
    }

    public function get_university_name($courseId): string
    {
        $query = "
            SELECT universities.f1 AS university_name
            FROM courses
            INNER JOIN universities ON courses.university = universities.id
            WHERE courses.id = :courseId
            LIMIT 1
        ";

        $result = $this->execute_query($query, [':courseId' => $courseId], 'SCALAR');

        // Handle the result
        if (!empty($result['error'])) {
            // Log the error or handle it
            $_SESSION['error'] = $result['error'];
            return 'Error fetching university name';
        }

        return $result['data']['value'] ?? 'Unknown University';
    }
    public function get_university_logo($courseId): string
    {
        $query = "
            SELECT universities.img1 AS university_logo
            FROM courses
            INNER JOIN universities ON courses.university = universities.id
            WHERE courses.id = :courseId
            LIMIT 1
        ";

        $result = $this->execute_query($query, [':courseId' => $courseId], 'SCALAR');

        // Handle the result
        if (!empty($result['error'])) {
            // Log the error or handle it
            $_SESSION['error'] = $result['error'];
            return 'Error fetching university logo';
        }

        return $result['data']['value'] ?? 'Unknown University';
    }
    public function get_country_name_by_course($courseId): string
    {
        $query = "
        SELECT countries.f1 AS country_name
        FROM courses
        INNER JOIN universities ON courses.university = universities.id
        INNER JOIN countries ON universities.country = countries.id
        WHERE courses.id = :courseId
        LIMIT 1
    ";

        $result = $this->execute_query($query, [':courseId' => $courseId], 'SCALAR');

        // Handle the result
        if (!empty($result['error'])) {
            $_SESSION['error'] = $result['error'];
            return 'Error fetching country name';
        }

        return $result['data']['value'] ?? 'Unknown Country';
    }
}
