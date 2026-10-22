<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

uses(RefreshDatabase::class);

test('header displays login and register buttons when there is no token in session', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
    $response->assertSee('Iniciar sesión');
    $response->assertSee('Crear cuenta');
    $response->assertDontSee('Cerrar sesión');
    $response->assertDontSee('Hola, ');
});

test('login page can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
    $response->assertSee('Iniciar Sesión');
    $response->assertSee('Correo electrónico');
    $response->assertSee('Contraseña');
});

test('login fails with invalid credentials', function () {
    $user = User::factory()->create([
        'email' => 'estudiante@example.com',
        'password' => Hash::make('password123'),
    ]);

    $response = $this->post('/login', [
        'email' => 'estudiante@example.com',
        'password' => 'wrongpassword',
    ]);

    $response->assertSessionHasErrors('email');
    $this->assertNull(session('token'));
});

test('login succeeds with valid credentials and stores token and name in session', function () {
    $user = User::factory()->create([
        'name' => 'Carlos Perez',
        'email' => 'carlos@example.com',
        'password' => Hash::make('secreto123'),
    ]);

    $response = $this->post('/login', [
        'email' => 'carlos@example.com',
        'password' => 'secreto123',
    ]);

    $response->assertRedirect(route('home'));
    $response->assertSessionHas('token');
    $response->assertSessionHas('name', 'Carlos Perez');

    expect(session('token'))->not->toBeEmpty();
});

test('header displays user name and logout button when token is in session', function () {
    $response = $this->withSession([
        'token' => 'sample-test-token-12345',
        'name' => 'Laura Garcia',
    ])->get('/');

    $response->assertStatus(200);
    $response->assertSee('Hola, Laura Garcia');
    $response->assertSee('Cerrar sesión');
    $response->assertDontSee('Iniciar sesión');
    $response->assertDontSee('Crear cuenta');
});

test('logout function invalidates session, regenerates token, and redirects to login', function () {
    $response = $this->withSession([
        'token' => 'sample-token',
        'name' => 'Ana Torres',
    ])->post('/logout');

    $response->assertRedirect(route('login'));
    $this->assertNull(session('token'));
    $this->assertNull(session('name'));
});

test('user can register successfully', function () {
    $response = $this->post('/register', [
        'name' => 'Nuevo Usuario',
        'email' => 'nuevo@example.com',
        'password' => 'password123',
        'password_confirmation' => 'password123',
    ]);

    $response->assertRedirect(route('login'));
    $this->assertDatabaseHas('users', [
        'email' => 'nuevo@example.com',
        'name' => 'Nuevo Usuario',
    ]);
});
