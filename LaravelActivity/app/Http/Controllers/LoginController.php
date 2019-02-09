<?php
namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Services\Business\SecurityService;
use Exception;

class LoginController extends Controller
{

    // index function
    public function index(Request $request)
    {
        try {

            $username = $request->input('username');
            $password = $request->input('password');

            $user = new UserModel(- 1, $username, $password);

            $service = new SecurityService();
            $status = $service->login($user);

            if ($status) {
                $data = [
                    'model' => $user
                ];
                return view('loginPassed2')->with($data);
            } 
            else {
                return view('loginFailed2');
            }
        }
        catch(Exception $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
                return view("systemException")->with($data);
        }
    }
}
