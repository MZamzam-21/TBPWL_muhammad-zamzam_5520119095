<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Profiler\Profile;

class ProfileController extends Controller
{
    // public function index(){
    //     return view('profile');
    // }
    public function index()
    {
        $user = Auth::user();
        $users = User::all();
        return view('v_user', compact('user', 'users'));
    }
    public function add_user(Request $req)
    {
        $users = new User;

        $users->name = $req->get('name');
        $users->username = $req->get('username');
        $users->email = $req->get('email');
        $users->password = $req->get('password');
        $users->roles_id = $req->get('roles_id');

        if ($req->hasFile('photo')) {
            $extension = $req->file('photo')->extension();

            $filename = 'photo_user_' . time() . '.' . $extension;

            $req->file('photo')->storeAs(
                'public/photo_user',
                $filename
            );

            $users->photo = $filename;
        }

        $users->save();

        $notification = array(
            'message' => 'Tambah Data Berhasil',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.user')->with($notification);
    }

    public function update_user(Request $req)
    {
        $users = User::find($req->get('id'));

        $users->name = $req->get('name');
        $users->username = $req->get('username');
        $users->email = $req->get('email');
        $users->password = $req->get('password');
        $users->roles_id = $req->get('roles_id');

        if ($req->hasFile('photo')) {
            $extension = $req->file('photo')->extension();

            $filename = 'photo_user_' . time() . '.' . $extension;

            $req->file('photo')->storeAs(
                'public/photo_user',
                $filename
            );

            Storage::delete('public/photo_user/' . $req->get('old_photo'));

            $users->photo = $filename;
        }

        $users->save();

        $notification = array(
            'message' => 'Edit Data Berhasil',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.user')->with($notification);
    }
    public function getDataUser($id)
    {
        $users = User::find($id);

        return response()->json($users);
    }
    public function destroy(Request $req)
    {
        $users = User::find($req->id);
        $users->name = $req->get('name');
        Storage::delete('public/photo_user/' . $req->get('old_photo'));
        $users->delete();

        $notification = array(
            'message' => 'Hapus Data user berhasil',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.user')->with($notification);
    }
}
