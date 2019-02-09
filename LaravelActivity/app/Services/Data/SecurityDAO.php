<?php
namespace App\Services\Data;

use App\Models\UserModel;
use Illuminate\Support\Facades\Log;
use PDOException;
use App\Services\Utility\DatabaseException;

class SecurityDAO
{
    private $conn = NULL;
    
    public function __construct($conn)
    {
        $this->conn = $conn;
    }
    
    public function findByUser(UserModel $user)
    {
        try {
            
        Log::info("Entering SecurityDAO.findByUser");
        
        $name = $user->getUsername();
        $pw = $user->getPassword();
        $sth = $this->conn->prepare('SELECT ID, USERNAME, PASSWORD FROM users WHERE USERNAME = :username AND PASSWORD = :password');
        $sth->bindParam(':username', $name);
        $sth->bindParam(':password', $pw);
        $sth->execute();
        
        if ($sth->rowCount() ==1)
        {
            Log::info("Exit securityDAO.FindByUser() with true.");
            return true;
        }
        else
        {
            Log::info("Exit securityDAO.FindByUser() with false.");
            return false;
        }
        
        
        } catch (PDOException $e) {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            throw new DatabaseException("Database exception: " . $e->getMessage(), 0, $e);
        }
    }
}

