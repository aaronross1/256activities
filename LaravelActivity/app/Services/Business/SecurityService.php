<?php
namespace App\Services\Business;

use App\Models\UserModel;
use Illuminate\Support\Facades\Log;
use \PDO;
use App\Services\Data\SecurityDAO;


class SecurityService
{

    public function login(UserModel $user)
    {
        Log::info("Entering SecurityService.login()");
        
        $servername = config("database.connections.mysql.host");
        $username = config("database.connections.mysql.username");
        $password = config("database.connections.mysql.password");
        $database = config("database.connections.mysql.database");
    
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $service = new SecurityDAO($conn);
        $flag = $service->findByUser($user);
        
        Log::info("Exit SecurityService.login() with " . $flag);
        return $flag;
    }
    
    
}

