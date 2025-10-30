<?php

class ApplicationStatusController extends TableController
{


    public function __construct(Database $database)
    {
        $this->set_connection($database->get_connection());
        $this->set_table("application_status");
        $this->set_primary_key("id");
        parent::__construct($database, $this->table);
    }
    public function get_status($statusId): string
    {
        $query = "SELECT f1 FROM {$this->table} WHERE {$this->primaryKey} = :statusId LIMIT 1";
        $result = $this->execute_query($query, [':statusId' => $statusId], 'SCALAR');

        // Check if the result contains valid data and return it; otherwise, return "Unknown Status".
        return  $result['data']['value'] ?? 'Unknown Status';
    }
}
