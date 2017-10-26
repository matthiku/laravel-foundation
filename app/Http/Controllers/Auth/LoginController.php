<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\SocialProvider;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    /**
     * Redirect the user to the Provider's authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }




    /**
     * Obtain the user information from Provider's.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        try {            
            $socialiteUser = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect('/');
        }

        // check if that user already exists in the DB
        $findUser = SocialProvider::where('provider_id', $socialiteUser->getId())->first();

        if ($findUser) {
            $user = $findUser->user;
        }
        // otherwise create a new user 
        else {            
            $user = User::firstOrCreate(
                ['email' => $socialiteUser->getEmail()],
                ['name'  => $socialiteUser->getName()],
                ['password' => random_bytes(15)]
            );
            $user->socialProviders()->create([
                'provider_id' => $socialiteUser->getId(),
                'provider' => $provider
            ]);
        }
        
        Auth::login($user);

        return redirect('home');
    }


}
