<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Member;
use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMembers = Member::count();
        $totalProjects = Project::count();
        $totalMessages = ContactMessage::count();
        $unreadMessages = ContactMessage::where('is_read', false)->count();

        $recentMembers = Member::orderBy('id', 'desc')->take(4)->get();
        $recentProjects = Project::with('member')->orderBy('id', 'desc')->take(5)->get();

        return view('dashboard.index', compact(
            'totalMembers',
            'totalProjects',
            'totalMessages',
            'unreadMessages',
            'recentMembers',
            'recentProjects'
        ));
    }

    public function profile()
    {
        $user = Auth::user();

        return view('dashboard.profile', compact('user'));
    }

    public function updateProfile(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'current_password' => ['nullable', 'required_with:new_password', 'current_password'],
            'new_password' => ['nullable', 'confirmed', Password::min(6)],
        ], [
            'name.required' => 'Nama wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah digunakan oleh pengguna lain.',
            'current_password.required_with' => 'Kata sandi saat ini harus diisi jika ingin mengganti kata sandi baru.',
            'current_password.current_password' => 'Password saat ini tidak sesuai.',
            'new_password.confirmed' => 'Konfirmasi password baru tidak cocok.',
            'new_password.min' => 'Password baru minimal 6 karakter.',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];

        if (! empty($validated['new_password'])) {
            $user->password = Hash::make($validated['new_password']);
        }

        $user->save();

        return back()->with('success', 'Profil admin berhasil diperbarui.');
    }
}
