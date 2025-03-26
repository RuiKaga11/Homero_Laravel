<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\TweetController;
use Illuminate\Support\Facades\Cookie; 
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use \Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    /**
     * ログインの可否
     */
    public function index()
    {
        // @dd('dd');
        return view('users.index');
        //
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' =>  ['required']
        ]);

        $results = User::where($credentials)->get();
        @dd($results);
        if(!is_null($results)){
            // 入力された値がDBに登録済みである
            Auth::login($results);
            $request->session()->regenerate();
            $userName = Cookie::get('user_name');

            return redirect()->route('tweets.index')
                ->with('success', 'ログイン成功');
        }else{

        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ]);
    }

    /**
     * アカウントの作成
     */
    public function create(Request $request)
    {
        return view('users.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ユーザー登録
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        //　登録後の自動ログイン
        Auth::login($user);

        return redirect()->route('tweets.index'); 
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
