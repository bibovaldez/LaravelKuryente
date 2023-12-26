<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Meter;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'fname' => 'required|string|max:255|regex:/^[a-zA-Z]+$/u',
            'mname' => 'required|string|max:255|regex:/^[a-zA-Z]+$/u',
            'lname' => 'required|string|max:255|regex:/^[a-zA-Z]+$/u',
            'phone' => 'required|string|max:255',
            'province' => 'required|string|max:255',function ($attribute, $value, $fail) {
                // check if null
                if ($value == null) {
                    $fail('The province field is required.');
                }
            },
            'municipality' =>'required|string|max:255', function ($attribute, $value, $fail) {
                // check if null
                if ($value == null) {
                    $fail('The municipality field is required.');
                }
            },
            'barangay' =>'required|string|max:255', function ($attribute, $value, $fail) {
                // check if null
                if ($value == null) {
                    $fail('The barangay field is required.');
                }
            },
            'MID' =>[
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    $meter = DB::table('meter')->where('MID', $value)->first();
                    
                    if (!$meter) {
                        $fail('Invalid Credentials. Please check your MID and PIN.');
                    }
                    else if($meter->PIN != request('PIN')){
                        $fail('Invalid Credentials. Please check your MID and PIN.');
                    }
                },
            ],
            'PIN' => [
                'required',
                'string',
                'max:255',
                function ($attribute, $value, $fail) {
                    $meter = DB::table('meter')->where('MID', request('MID'))->first();
                    if ($meter) {
                        if ($meter->PIN != $value) {
                            $fail('');
                        }
                    }
                },
            ],
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'firstName' => $validatedData['fname'],
            'middleName' => $validatedData['mname'],
            'lastName' => $validatedData['lname'],
            'phone' => $validatedData['phone'],
            'Province' => $validatedData['province'],
            'Municipality' => $validatedData['municipality'],
            'Barangay' => $validatedData['barangay'],
            'F_MID' => $validatedData['MID'],
            'username'=> $validatedData['username'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
