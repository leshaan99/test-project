<?php

class MyUsersController extends TableController

{
  
 

    public function __construct(Database $database)
    {
       
 

        
        $this->set_connection($database->get_connection());
        $this->set_table("myusers");
        $this->set_primary_key("id");
        // $this->set_foreign_keys(['user','course']);
        parent::__construct($database, $this->table);
    }


    public function get_clients_by_admin($admin, $orderBy=''): array
    {

        $result = array(
            'data' => [],
            'error' => null,
        );

        try {
          
            $query = "SELECT $this->table.id,$this->table.admin, $this->table.user, users.f1 as user,  $this->table.register_by, $this->table.register_date , $this->table.status  FROM users LEFT JOIN  $this->table ON users.id =  $this->table.user  where $this->table.status=1 AND users.status=1 AND $this->table.admin =:admin";
      
       
            if (!empty($orderBy)) {
                $query .= " ORDER BY $orderBy";
            }

            $stmt = $this->get_connection()->prepare($query);
            $stmt->bindParam(':admin', $admin, PDO::PARAM_INT);
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

    public function get_clients_by_staff($admin, $orderBy=''): array
    {

        $result = array(
            'data' => [],
            'error' => null,
        );

        try {
          
            $query = "SELECT users.*,  $this->table.register_by, $this->table.register_date , $this->table.status  FROM users LEFT JOIN  $this->table ON users.id =  $this->table.user  where $this->table.status=1 AND users.status=1 AND  $this->table.admin =:admin";
      
       
            if (!empty($orderBy)) {
                $query .= " ORDER BY $orderBy";
            }

            $stmt = $this->get_connection()->prepare($query);
            $stmt->bindParam(':admin', $admin, PDO::PARAM_INT);
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


    public function get_admins_id_by_client($clients): array
    {
        $result = array(
            'data' => [],
            'error' => null,
        );
    
        try {
            $query = "SELECT admin FROM $this->table WHERE status=1 AND user = :client";
    
            // Append ORDER BY clause if $orderBy is provided
            if (!empty($orderBy)) {
                $query .= " ORDER BY $orderBy";
            }
    
            $stmt = $this->get_connection()->prepare($query);
            $stmt->bindParam(':client', $clients, PDO::PARAM_INT);
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


    public function get_client_count_by_admin($admin)
    {

              
        $query = "SELECT COUNT($this->table.id)  as tot  FROM users LEFT JOIN  $this->table ON users.id =  $this->table.user  where $this->table.status=1 AND users.status=1 AND   $this->table.admin =   '$admin'  ";
      
        $smt = $this->get_connection()->query($query);
        $clients = $smt->fetch(PDO::FETCH_ASSOC);
       

        if ($clients == false) {

             return '0';
        } else {

            return $clients['tot'];
        }

      

    }



    public function register1($admin, $user, $register_by): array
    {
        $result = array();


        $query = "INSERT INTO $this->table (user, admin, register_by) VALUES ('$user', '$admin',$register_by)";

        if ($this->check_param($user, 'user',$admin,'admin')) {
            $result['error'] = "User already registered";
            $result['code'] = 400;
        } else {
            $smt = $this->get_connection()->query($query);
            if ($smt) {
                $result['message'] = "client added successfully";
                $result['code'] = 200;
            } else {
                $result['error'] = "registration failed";
                $result['code'] = 400;
            }
        }
    

        return $result;
    }


    public function check_param($f1, $param,$f2,$param2): bool
    {

        $query = "SELECT * FROM $this->table WHERE $param='$f1' and $param2='$f2'";
        $smt = $this->get_connection()->query($query);

        $user = $smt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return false;
        } else {
            return true;
        }
    }

  
    
}
