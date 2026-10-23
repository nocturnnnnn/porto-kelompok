<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('q');
        $category = $request->query('category');

        $query = Project::with('member')->orderBy('created_at', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('tech_stack', 'like', "%{$search}%")
                    ->orWhereHas('member', function ($mq) use ($search) {
                        $mq->where('name', 'like', "%{$search}%");
                    });
            });
        }

        if ($category) {
            $query->where('category', $category);
        }

        $projects = $query->paginate(10)->withQueryString();
        $categories = Project::pluck('category')->filter()->unique()->values();

        return view('dashboard.projects.index', compact('projects', 'search', 'category', 'categories'));
    }

    public function create()
    {
        $members = Member::orderBy('order')->orderBy('name')->get();

        return view('dashboard.projects.create', compact('members'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'member_id' => ['nullable', 'exists:members,id'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'tech_stack' => ['nullable', 'string', 'max:500'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:4096'],
            'demo_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'is_featured' => ['nullable', 'boolean'],
        ], [
            'title.required' => 'Judul proyek portofolio wajib diisi.',
            'category.required' => 'Kategori proyek wajib dipilih/diisi.',
            'member_id.exists' => 'Anggota yang dipilih tidak valid.',
            'image.image' => 'File thumbnail harus berupa gambar.',
            'image.max' => 'Ukuran thumbnail maksimal 4 MB.',
        ]);

        $validated['slug'] = Str::slug($validated['title']).'-'.Str::random(5);
        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('projects', 'public');
            $validated['image'] = $path;
        }

        Project::create($validated);

        return redirect()->route('dashboard.projects.index')
            ->with('success', 'Proyek portofolio baru berhasil ditambahkan.');
    }

    public function edit(Project $project)
    {
        $members = Member::orderBy('order')->orderBy('name')->get();

        return view('dashboard.projects.edit', compact('project', 'members'));
    }

    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'category' => ['required', 'string', 'max:100'],
            'member_id' => ['nullable', 'exists:members,id'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'description' => ['nullable', 'string'],
            'tech_stack' => ['nullable', 'string', 'max:500'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp,svg', 'max:4096'],
            'demo_url' => ['nullable', 'url', 'max:255'],
            'github_url' => ['nullable', 'url', 'max:255'],
            'is_featured' => ['nullable', 'boolean'],
        ], [
            'title.required' => 'Judul proyek portofolio wajib diisi.',
            'category.required' => 'Kategori proyek wajib dipilih/diisi.',
            'member_id.exists' => 'Anggota yang dipilih tidak valid.',
            'image.image' => 'File thumbnail harus berupa gambar.',
            'image.max' => 'Ukuran thumbnail maksimal 4 MB.',
        ]);

        $validated['is_featured'] = $request->boolean('is_featured');

        if ($request->hasFile('image')) {
            if ($project->image && Storage::disk('public')->exists($project->image)) {
                Storage::disk('public')->delete($project->image);
            }
            $path = $request->file('image')->store('projects', 'public');
            $validated['image'] = $path;
        }

        $project->update($validated);

        return redirect()->route('dashboard.projects.index')
            ->with('success', 'Data proyek "'.$project->title.'" berhasil diperbarui.');
    }

    public function destroy(Project $project)
    {
        $title = $project->title;

        if ($project->image && Storage::disk('public')->exists($project->image)) {
            Storage::disk('public')->delete($project->image);
        }

        $project->delete();

        return redirect()->route('dashboard.projects.index')
            ->with('success', 'Proyek "'.$title.'" berhasil dihapus.');
    }
}
