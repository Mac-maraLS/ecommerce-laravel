<?php

use App\Mail\CodigoVerificacionMail;
use App\Models\CodigoVerificacion;
use App\Models\Usuario;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;

uses(RefreshDatabase::class);

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('valid credentials generate a 2fa code without starting session', function () {
    Mail::fake();

    $usuario = Usuario::factory()->create([
        'correo' => 'cliente@tuxtla.tecnm.mx',
        'clave' => '123',
        'rol' => Usuario::ROL_CLIENTE,
    ]);

    $response = $this->post('/login', [
        'correo' => $usuario->correo,
        'clave' => '123',
    ]);

    $response->assertRedirect(route('login.2fa', absolute: false));
    $this->assertGuest();
    $this->assertDatabaseHas('codigos_verificacion', [
        'usuario_id' => $usuario->id,
    ]);
    Mail::assertSent(CodigoVerificacionMail::class);
});

test('users authenticate only after valid 2fa code', function () {
    Mail::fake();

    $usuario = Usuario::factory()->create([
        'correo' => 'cliente@tuxtla.tecnm.mx',
        'clave' => '123',
        'rol' => Usuario::ROL_CLIENTE,
    ]);

    $this->post('/login', [
        'correo' => $usuario->correo,
        'clave' => '123',
    ]);

    $codigo = CodigoVerificacion::query()->where('usuario_id', $usuario->id)->firstOrFail();

    $response = $this->post('/login/verificar-codigo', [
        'codigo' => $codigo->codigo,
    ]);

    $this->assertAuthenticatedAs($usuario);
    $response->assertRedirect(route('ventas.index', absolute: false));
});

test('invalid password does not generate a 2fa code', function () {
    Mail::fake();

    $usuario = Usuario::factory()->create([
        'correo' => 'cliente@tuxtla.tecnm.mx',
        'clave' => '123',
        'rol' => Usuario::ROL_CLIENTE,
    ]);

    $this->post('/login', [
        'correo' => $usuario->correo,
        'clave' => 'incorrecta',
    ])->assertSessionHasErrors('correo');

    $this->assertGuest();
    $this->assertDatabaseCount('codigos_verificacion', 0);
    Mail::assertNothingSent();
});

test('invalid 2fa code is rejected', function () {
    Mail::fake();

    $usuario = Usuario::factory()->create([
        'correo' => 'cliente@tuxtla.tecnm.mx',
        'clave' => '123',
        'rol' => Usuario::ROL_CLIENTE,
    ]);

    $this->post('/login', [
        'correo' => $usuario->correo,
        'clave' => '123',
    ]);

    $this->post('/login/verificar-codigo', [
        'codigo' => '000000',
    ])->assertSessionHasErrors('codigo');

    $this->assertGuest();
});

test('users can logout', function () {
    $usuario = Usuario::factory()->create();

    $response = $this->actingAs($usuario)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect(route('login', absolute: false));
});
