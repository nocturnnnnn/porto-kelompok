<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Member;
use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $members = Member::with('projects')->orderBy('order')->orderBy('id')->get();
        $projects = Project::with('member')->orderBy('is_featured', 'desc')->orderBy('created_at', 'desc')->get();

        $categories = $projects->pluck('category')->filter()->unique()->values();

        $stats = [
            'total_members' => $members->count(),
            'total_projects' => $projects->count(),
            'total_categories' => $categories->count(),
            'course' => 'Pemrograman Web',
            'semester' => 'Semester 5',
        ];

        return view('home', compact('members', 'projects', 'categories', 'stats'));
    }

    public function sendContact(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'subject' => ['nullable', 'string', 'max:255'],
            'message' => ['required', 'string', 'max:3000'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'message.required' => 'Pesan tidak boleh kosong.',
        ]);

        ContactMessage::create($validated);

        return redirect()->to(url()->previous().'#contact')
            ->with('success', 'Terima kasih! Pesan Anda telah terkirim kepada tim kami.');
    }
}
