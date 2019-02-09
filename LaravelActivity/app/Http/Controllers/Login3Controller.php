<?php
namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use App\Services\Business\SecurityService;
use Exception;

class Login3Controller extends Controller
{

    // index function
    public function index(Request $request)
    {
        try {

            $this->validateForm($request);
            
            
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
        catch(ValidationException $e1)
        {
            throw $e1;
        }
        catch(Exception $e)
        {
            Log::error("Exception: ", array("message" => $e->getMessage()));
            $data = ['errorMsg' => $e->getMessage()];
                return view("systemException")->with($data);
        }
    }
    
    private function validateForm(Request $request)
    {
        $rules = ['username' => 'Required | Between:4,10 | Alpha_num',
                  'password' => 'Required | Between:4,10'];
        
        $this->validate($request, $rules);
    }
}
