<?php

class DocumentTypeController extends TableController
{


    public function __construct(Database $database)
    {
        $this->set_connection($database->get_connection());
        $this->set_table("document_types");
        $this->set_primary_key("id");
        parent::__construct($database, $this->table);
    }

     public function get_doc_type_name($id): string
    {
        $query = "SELECT f1 FROM {$this->table} WHERE {$this->primaryKey} = :id";
        $result = $this->execute_query($query, [':id' => $id], 'SCALAR');
    
        return $result['data']['value'] ?? ' N/A';
    }
    
}
