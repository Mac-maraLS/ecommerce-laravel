<x-guest-layout>
    <div class="space-y-8">
        <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-white via-slate-50 to-amber-50 p-8 shadow-xl shadow-slate-200/60">
            <div class="mb-8">
                <p class="text-sm font-semibold uppercase tracking-[0.35em] text-amber-600">Tu tienda</p>
                <h1 class="mt-3 text-3xl font-black tracking-tight text-slate-900">Crear cuenta</h1>
                <p class="mt-3 text-sm leading-6 text-slate-600">
                    Registrate para acceder al catalogo y realizar compras.
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                {{-- Nombre --}}
                <div>
                    <label for="nombre" class="mb-2 block text-sm font-semibold text-slate-800">Nombre(s)</label>
                    <input
                        id="nombre"
                        class="block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-amber-400 focus:ring-4 focus:ring-amber-100"
                        type="text"
                        name="nombre"
                        value="{{ old('nombre') }}"
                        placeholder="Ej. Juan"
                        required autofocus autocomplete="given-name"
                    />
                    <x-input-error :messages="$errors->get('nombre')" class="mt-2 text-sm text-red-600" />
                </div>

                {{-- Apellidos --}}
                <div>
                    <label for="apellidos" class="mb-2 block text-sm font-semibold text-slate-800">Apellidos</label>
                    <input
                        id="apellidos"
                        class="block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-amber-400 focus:ring-4 focus:ring-amber-100"
                        type="text"
                        name="apellidos"
                        value="{{ old('apellidos') }}"
                        placeholder="Ej. Lopez Martinez"
                        required autocomplete="family-name"
                    />
                    <x-input-error :messages="$errors->get('apellidos')" class="mt-2 text-sm text-red-600" />
                </div>

                {{-- Correo --}}
                <div>
                    <label for="correo" class="mb-2 block text-sm font-semibold text-slate-800">Correo electronico</label>
                    <input
                        id="correo"
                        class="block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-amber-400 focus:ring-4 focus:ring-amber-100"
                        type="email"
                        name="correo"
                        value="{{ old('correo') }}"
                        placeholder="nombre@correo.com"
                        required autocomplete="username"
                    />
                    <x-input-error :messages="$errors->get('correo')" class="mt-2 text-sm text-red-600" />
                </div>

                {{-- Clave --}}
                <div>
                    <label for="clave" class="mb-2 block text-sm font-semibold text-slate-800">Contrasena</label>
                    <input
                        id="clave"
                        class="block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-amber-400 focus:ring-4 focus:ring-amber-100"
                        type="password"
                        name="clave"
                        placeholder="Minimo 8 caracteres"
                        required autocomplete="new-password"
                    />
                    <x-input-error :messages="$errors->get('clave')" class="mt-2 text-sm text-red-600" />
                </div>

                {{-- Confirmar clave --}}
                <div>
                    <label for="clave_confirmation" class="mb-2 block text-sm font-semibold text-slate-800">Confirmar contrasena</label>
                    <input
                        id="clave_confirmation"
                        class="block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-amber-400 focus:ring-4 focus:ring-amber-100"
                        type="password"
                        name="clave_confirmation"
                        placeholder="Repite tu contrasena"
                        required autocomplete="new-password"
                    />
                    <x-input-error :messages="$errors->get('clave_confirmation')" class="mt-2 text-sm text-red-600" />
                </div>

                <button
                    type="submit"
                    class="inline-flex w-full items-center justify-center rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold uppercase tracking-[0.2em] text-white transition hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-300"
                >
                    Registrarme
                </button>
            </form>
        </div>

        <div class="text-center text-sm text-slate-600">
            Ya tienes cuenta?
            <a href="{{ route('login') }}" class="font-semibold text-amber-700 transition hover:text-amber-800">
                Inicia sesion aqui
            </a>
        </div>
    </div>
</x-guest-layout>
