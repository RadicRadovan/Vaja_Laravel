<?php
  
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

  
class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    
    public function redirectToGoogle()
    {
        return Socialite::driver('google')
        ->with(['hd' => 'example.com'])
        ->redirect();
    }
    private function userRecordExists($userData)
{
    return $this->user->where('email', $userData->email)->first();
}
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {
      
            $user = Socialite::driver('google')->user();
       
            $finduser = User::where('google_id', $user->id)->first();
       
            if($finduser){
       
                Auth::login($finduser);
      
                return redirect()->intended('dashboard');
       
            }
      
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
    public function syncUserDetails($userData)
{
    if ( $user = $this->userRecordExists($userData) )
    {
        $user->token = $userData->token;
        $user->google_id = $userData->id;
        $user->name = $userData->name;
        $user->avatar = $userData->avatar;
        $user->first_name = $userData->user['name']['givenName'];
        $user->last_name = $userData->user['name']['familyName'];
        $user->save();

        return $user;
    }

    return $this->user->firstOrCreate([
        'email'      => $userData->email,
        'token'      => $userData->token,
        'google_id'  => $userData->id,
        'name'       => $userData->name,
        'avatar'     => $userData->avatar,
        'first_name' => $userData->user['name']['givenName'],
        'last_name'  => $userData->user['name']['familyName']
    ]);
}
}