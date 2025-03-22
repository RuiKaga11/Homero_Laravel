<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\TweetController;

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
            'password' => ['required']
        ]);
        // @dd($credentials);
        $results = User::where($credentials)->get();
        // @dd($results);
        if(!is_null($results)){
            // 入力された値がDBに登録済みである
            $request->session()->regenerate();
            return redirect()->route('tweets.index')
                ->with('success', 'カテゴリが正常に作成されました');
        }else{

        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ]);
    }

    /**
     * アカウントの作成
     */
    public function create()
    {
        return view('users.create');
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
