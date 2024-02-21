<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        //validate user input

        $validated_data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'phone_number' => 'nullable|string|regex:/^\d{3}-\d{3}-\d{4}$/',
            'street_address' => 'required|string|max:255',
            'apt' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|min:2|max:2',
            'zip_code' => 'required|string|regex:/^\d{5}$/',
            'password' => 'required|string|min:6|confirmed', //'confirmed' checks if 'password_confirmation' matches 'password'
        ]);

        //create a user
        $user = User::create($validated_data);

        //log the user in
        auth()->login($user);

        //redirect to dashboard
        session()->flash('message', 'Registered successfully!');
        return redirect()->route('projects.none_selected');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //find the user
        $user=User::findOrFail($id);

        return view('users.edit', ['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validate user input
        $validated_data = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . auth()->id(),
            'phone_number' => 'nullable|string|regex:/^\d{3}-\d{3}-\d{4}$/',
            'street_address' => 'required|string|max:255',
            'apt' => 'nullable|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|min:2|max:2',
            'zip_code' => 'required|string|regex:/^\d{5}$/'
        ]);


        //find the user
        $user = User::findOrFail($id);

        //ensure the user is authenticated
        if (auth()->id() != $user->id){
            abort(403);
        }

        //update the user
        $user->update($validated_data);

        //redirect to homepage
        session()->flash('message', 'Account updated!');
        return redirect()->route('projects.none_selected');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
    }

    public function authenticate(Request $request): RedirectResponse
    {
        //validate input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        //compare input with stored creds, login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
 
            session()->flash('message', 'Logged in successfully!');
            return redirect()->route('projects.none_selected');
        }
 
        //if failed, show errors
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        //log user out
        Auth::logout();
    
        //invalidate and regenerate session
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    
        //redirect
        session()->flash('message', 'Logged out successfully!');
        return redirect('/');
    }
}
