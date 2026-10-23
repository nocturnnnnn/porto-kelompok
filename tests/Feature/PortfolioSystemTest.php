<?php

use App\Models\Member;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

test('halaman utama menampilkan portofolio kelompok dan anggota', function () {
    $member = Member::create([
        'name' => 'Ahmad Fauzi',
        'nim' => '230101001',
        'role' => 'Ketua Kelompok & Fullstack Dev',
        'skills' => 'PHP, Laravel, MySQL',
        'order' => 1,
    ]);

    $project = Project::create([
        'title' => 'Web Portofolio Terpadu Kelompok 5',
        'slug' => 'web-portofolio-terpadu-kelompok-5',
        'category' => 'Web Application',
        'member_id' => $member->id,
        'tech_stack' => 'Laravel, MySQL, Tailwind CSS',
    ]);

    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Ahmad Fauzi');
    $response->assertSee('230101001');
    $response->assertSee('Web Portofolio Terpadu Kelompok 5');
});

test('pengunjung belum login dialihkan ke halaman login saat akses dashboard', function () {
    $response = $this->get(route('dashboard.index'));
    $response->assertRedirect(route('login'));
});

test('pengguna dapat login dan mengakses dashboard', function () {
    $user = User::factory()->create([
        'email' => 'admin@kelompok.test',
        'password' => bcrypt('password'),
    ]);

    $response = $this->post(route('login.post'), [
        'email' => 'admin@kelompok.test',
        'password' => 'password',
    ]);

    $response->assertRedirect(route('dashboard.index'));
    $this->assertAuthenticatedAs($user);
});

test('admin dapat melakukan operasi CRUD pada anggota kelompok', function () {
    $user = User::factory()->create();

    // 1. Create Member
    $createResponse = $this->actingAs($user)->post(route('dashboard.members.store'), [
        'name' => 'Budi Pratama',
        'nim' => '230101003',
        'role' => 'Backend & Database Engineer',
        'skills' => 'PHP, MySQL, Laravel',
        'order' => 2,
    ]);

    $createResponse->assertRedirect(route('dashboard.members.index'));
    $this->assertDatabaseHas('members', ['nim' => '230101003']);

    $member = Member::where('nim', '230101003')->first();

    // 2. Read / Index
    $indexResponse = $this->actingAs($user)->get(route('dashboard.members.index'));
    $indexResponse->assertStatus(200);
    $indexResponse->assertSee('Budi Pratama');

    // 3. Update Member
    $updateResponse = $this->actingAs($user)->put(route('dashboard.members.update', $member), [
        'name' => 'Budi Pratama S.Kom',
        'nim' => '230101003',
        'role' => 'Lead Backend Engineer',
        'skills' => 'PHP, MySQL, Laravel, Docker',
        'order' => 2,
    ]);

    $updateResponse->assertRedirect(route('dashboard.members.index'));
    $this->assertDatabaseHas('members', ['name' => 'Budi Pratama S.Kom']);

    // 4. Delete Member
    $deleteResponse = $this->actingAs($user)->delete(route('dashboard.members.destroy', $member));
    $deleteResponse->assertRedirect(route('dashboard.members.index'));
    $this->assertDatabaseMissing('members', ['id' => $member->id]);
});

test('admin dapat melakukan operasi CRUD pada portofolio proyek', function () {
    $user = User::factory()->create();
    $member = Member::create([
        'name' => 'Siti Nurhaliza',
        'nim' => '230101002',
        'role' => 'Frontend Specialist',
    ]);

    // 1. Create Project
    $createResponse = $this->actingAs($user)->post(route('dashboard.projects.store'), [
        'title' => 'Sistem Inventaris Toko',
        'category' => 'Web Application',
        'member_id' => $member->id,
        'excerpt' => 'Aplikasi pencatatan stok barang.',
        'description' => 'Deskripsi lengkap inventaris.',
        'tech_stack' => 'Laravel, MySQL, Tailwind CSS',
    ]);

    $createResponse->assertRedirect(route('dashboard.projects.index'));
    $this->assertDatabaseHas('projects', ['title' => 'Sistem Inventaris Toko']);

    $project = Project::where('title', 'Sistem Inventaris Toko')->first();

    // 2. Read / Index
    $indexResponse = $this->actingAs($user)->get(route('dashboard.projects.index'));
    $indexResponse->assertStatus(200);
    $indexResponse->assertSee('Sistem Inventaris Toko');

    // 3. Update Project
    $updateResponse = $this->actingAs($user)->put(route('dashboard.projects.update', $project), [
        'title' => 'Sistem Inventaris & Kasir UMKM',
        'category' => 'E-Commerce',
        'member_id' => $member->id,
        'excerpt' => 'Aplikasi kasir terintegrasi.',
        'description' => 'Deskripsi lengkap kasir.',
        'tech_stack' => 'Laravel 13, MySQL, Tailwind CSS',
    ]);

    $updateResponse->assertRedirect(route('dashboard.projects.index'));
    $this->assertDatabaseHas('projects', ['title' => 'Sistem Inventaris & Kasir UMKM']);

    // 4. Delete Project
    $deleteResponse = $this->actingAs($user)->delete(route('dashboard.projects.destroy', $project));
    $deleteResponse->assertRedirect(route('dashboard.projects.index'));
    $this->assertDatabaseMissing('projects', ['id' => $project->id]);
});

test('pengunjung dapat mengirim formulir pesan kontak', function () {
    $response = $this->post(route('contact.send'), [
        'name' => 'Dosen Pengampu',
        'email' => 'dosen@univ.ac.id',
        'subject' => 'Catatan Proyek',
        'message' => 'Proyek portofolio sangat memuaskan dan memenuhi kriteria tugas.',
    ]);

    $response->assertStatus(302);
    $this->assertDatabaseHas('contact_messages', [
        'email' => 'dosen@univ.ac.id',
        'subject' => 'Catatan Proyek',
    ]);
});

test('model member dan project mengikutsertakan atribut appends pada serialisasi json', function () {
    $member = Member::create([
        'name' => 'Ahmad Fauzi',
        'nim' => '230101001',
        'role' => 'Fullstack Dev',
        'skills' => 'PHP, Laravel, MySQL',
    ]);

    $project = Project::create([
        'title' => 'Web App Test',
        'category' => 'Web Application',
        'member_id' => $member->id,
        'tech_stack' => 'Laravel, Vite',
    ]);

    $memberArray = $member->toArray();
    expect($memberArray)->toHaveKey('photo_url')
        ->and($memberArray)->toHaveKey('skills_array')
        ->and($memberArray['skills_array'])->toBe(['PHP', 'Laravel', 'MySQL']);

    $projectArray = $project->toArray();
    expect($projectArray)->toHaveKey('image_url')
        ->and($projectArray)->toHaveKey('tech_stack_array')
        ->and($projectArray['tech_stack_array'])->toBe(['Laravel', 'Vite']);
});

test('admin tidak dapat mengubah password baru tanpa current_password yang valid', function () {
    $user = User::factory()->create([
        'password' => bcrypt('password123'),
    ]);

    $response = $this->actingAs($user)->put(route('dashboard.profile.update'), [
        'name' => $user->name,
        'email' => $user->email,
        'new_password' => 'newpassword123',
        'new_password_confirmation' => 'newpassword123',
    ]);

    $response->assertSessionHasErrors(['current_password']);
});

test('admin dapat memperbarui nama, email, dan kata sandi dengan current_password yang benar', function () {
    $user = User::factory()->create([
        'password' => bcrypt('password123'),
    ]);

    $response = $this->actingAs($user)->put(route('dashboard.profile.update'), [
        'name' => 'Nama Baru Admin',
        'email' => 'newadmin@kelompok.test',
        'current_password' => 'password123',
        'new_password' => 'secret123456',
        'new_password_confirmation' => 'secret123456',
    ]);

    $response->assertRedirect();
    $response->assertSessionHas('success');

    $user->refresh();
    expect($user->name)->toBe('Nama Baru Admin');
    expect($user->email)->toBe('newadmin@kelompok.test');
    expect(Hash::check('secret123456', $user->password))->toBeTrue();
});

test('validasi formulir kontak mendeteksi email tidak valid', function () {
    $response = $this->post(route('contact.send'), [
        'name' => 'Test User',
        'email' => 'bukan-email-valid',
        'message' => 'Pesan pengujian',
    ]);

    $response->assertSessionHasErrors(['email']);
});
