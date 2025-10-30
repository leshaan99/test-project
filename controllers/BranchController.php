<?php

class BranchController extends TableController
{


 
    public function __construct(Database $database)
    {
  

        $this->set_connection($database->get_connection());
        $this->set_table("branches");
        $this->set_primary_key("id");
        // $this->set_foreign_keys(['user','course']);
        parent::__construct($database, $this->table);

        
    }
    public function get_branch_name($id): string
    {
        $query = "SELECT f1 FROM {$this->table} WHERE {$this->primaryKey} = :id";
        $result = $this->execute_query($query, [':id' => $id], 'SCALAR');
    
        return $result['data']['value'] ?? ' N/A';
    }
    
 }
