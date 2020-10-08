<?php

namespace App\Http\Controllers;

use App\Account;
use App\Region;
use Illuminate\Http\Request;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create()
    {
        return view('accounts.create', [
            'regions' => Region::all()
        ]);
    }

    public function update(Account $account)
    {
        $validated = request()->validate([
            'name' => 'required',
            'purpose' => 'required',
            'default_region' => 'required',
            'access_key_id' => 'required',
            'secret_key_id' => 'required',
            'owner_id' => 'required'
        ]);

        $account->update($validated);

        return redirect()->route('home');
    }
    public function store()
    {
        $validated = request()->validate([
            'name' => 'required',
            'purpose' => 'required',
            'default_region' => 'required',
            'access_key_id' => 'required',
            'secret_key_id' => 'required',
            'owner_id' => 'required'
        ]);
        $validated['last_accessed'] = now();

        Account::create($validated);
        return redirect()->route('home');
    }

    public function show(Account $account)
    {
        return view('accounts.show', compact('account'));
    }

    public function edit(Account $account)
    {
        return view('accounts.edit', [
            'account' => $account,
            'regions' => Region::all()
        ]);
    }

    public function destroy(Account  $account)
    {
        $account->delete();

        return response(null, 204);
    }

    public function index()
    {
        return Account::all();
    }
}
