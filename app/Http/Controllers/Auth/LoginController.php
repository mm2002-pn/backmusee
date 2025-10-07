<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;  // Ajoutez cette ligne en haut si ce n'est pas déjà fait
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Foundation\Auth\RedirectsUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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

    use AuthenticatesUsers, RedirectsUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    // app/Http/Controllers/Auth/LoginController.php

    public function username()
    {
        return 'login';
    }


    /**
     * Attempt to log the user into the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return bool
     */
    protected function attemptLogin(Request $request)
    {
        $credentials = $this->credentials($request);
        $user = User::where($this->username(), $credentials[$this->username()])->first();
        $role = Role::find($user->role_id);
        if ($user && $role->estautoriser == 1) {
            return $this->guard()->attempt($credentials, $request->boolean('remember'));
        }
        return false;
    }



    // login santum sap

    public function login(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Validation des champs requis
        if ($validator->fails()) {
            return back()->withErrors($validator->errors());
        }

        try {
            // Récupération des informations fournies
            $credentials = $request->only('login', 'password');
            // Vérification de l'utilisateur
            $user = User::where('login', $credentials['login'])->first();
            // dd($user);
            if (!$user) {
                return back()->withErrors([
                    'login' => 'Utilisateur introuvable. Vérifiez vos informations de connexion.',
                ]);
            }

            // Vérification du rôle de l'utilisateur
            $role = Role::find($user->role_id);

            if (!$role) {
                return back()->withErrors([
                    'login' => 'Le rôle associé à cet utilisateur est introuvable.',
                ]);
            }

            if ($role->estautoriser != 1) {
                return back()->withErrors([
                    'login' => 'Vous n\'êtes pas autorisé à vous connecter.',
                ]);
            }

            // Vérification de la session
            // if ($user->session_id && $user->session_id == Session::getId()) {
            //     return back()->withErrors([
            //         'login' => 'Un autre utilisateur est déjà connecté à ce compte.',
            //     ]);
            // }

            // Tentative de connexion
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                $user->session_id = Session::getId();
                $user->save();
                // dd($user->session_id, Session::getId(), $user->id, $request->user()->id ,Auth::user()->id); ;
                return $request->wantsJson()
                    ? new JsonResponse([], 204)
                    : redirect()->intended($this->redirectPath());
            }

            return back()->withErrors([
                'login' => 'Les informations d\'identification fournies ne correspondent pas à nos enregistrements.',
            ]);
        } catch (\Throwable $th) {
            // dd($th);
            return back()->withErrors([
                'login' => 'Une erreur inattendue s\'est produite lors de la connexion. Veuillez réessayer plus tard.',
            ]);
        }
    }



    // logout santum sap


    public function logout(Request $request)
    {

        $request->user()->tokens()->delete();
        $user = User::find($request->user()->id);
        $user->session_id = null;
        $user->save();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->withCookie(cookie()->forget('XSRF-TOKEN'))->withCookie(cookie()->forget('laravel_session'));;
    }
}
