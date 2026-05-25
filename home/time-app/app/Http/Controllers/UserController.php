<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function update(Request $request) {
        $request->validate([
            'name' => 'required|filled',
            'email' => 'required|email',
            'password' => 'nullable|min:8',
        ]);

        $user = Auth::user();

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        try {
            $user->save();
        } catch (\Throwable $th) {
            return back()
                ->withErrors(['Settings could not be modified.']);
        }

        return back()
            ->withSuccess('Settings have been updated.');
    }

    public function add(Request $request) {
        $request->validate([
            'name' => 'required|filled',
            'email' => 'required|email|unique:users',
            'password' => 'required|filled|min:8',
        ]);

        $user = new User();

        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        DB::beginTransaction();

        try {
            $user->save();
        } catch (\Throwable $th) {
            return back()
                ->withErrors(['User could not be added.']);
        }

        if ($request->has('admin')) {
            try {
                $info = $user->info;
                $info->admin = true;
                $info->save();
            } catch (\Throwable $th) {
                DB::rollback();
                return back()
                    ->withErrors(['User could not be added.', 'Problem granting admin status.']);
            }
        }

        DB::commit();

        return redirect(route('admin'))
            ->withSuccess('User added.');
    }

    public function edit(Request $request) {
        $request->validate([
            'id' => 'required|integer|filled',
            'name' => 'required|filled',
            'email' => 'required|email',
            'password' => 'nullable|min:8',
        ]);

        $user = User::find($request->id);

        $user->name = $request->name;
        $user->email = $request->email;

        $info = $user->info;
        $info->admin = $request->has('admin');

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        try {
            $user->save();
            $info->save();
        } catch (\Throwable $th) {
            return back()
                ->withErrors(['User could not be modified.']);
        }

        return redirect(route('admin'))
            ->withSuccess('User has been modified.');
    }

    public function delete(Request $request) {
        $request->validate([
            'id' => 'required|integer|filled|exists:users',
        ]);

        $user = User::find($request->id);

        DB::beginTransaction();

        try {
            $user->info->delete();
            $user->delete();
        } catch (\Throwable $th) {
            DB::rollback();
            return back()
                ->withErrors(['Could not delete User.']);
        }

        DB::commit();


        return back()->withSuccess('User successfully deleted.');
    }
}
