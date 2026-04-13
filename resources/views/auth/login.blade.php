<x-guest-layout>
    <div class="space-y-8">
        <div class="rounded-3xl border border-slate-200 bg-gradient-to-br from-white via-slate-50 to-amber-50 p-8 shadow-xl shadow-slate-200/60">
            <div class="mb-8">
                <p class="text-sm font-semibold uppercase tracking-[0.35em] text-amber-600">Tu tienda</p>
                <h1 class="mt-3 text-3xl font-black tracking-tight text-slate-900">Inicia sesion</h1>
                <p class="mt-3 text-sm leading-6 text-slate-600">
                    Entra a tu cuenta para revisar pedidos, productos y el panel correspondiente a tu usuario.
                </p>
            </div>

            <x-auth-session-status
                class="mb-5 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-700"
                :status="session('status')"
            />

            <form method="POST" action="{{ route('login') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="correo" class="mb-2 block text-sm font-semibold text-slate-800">
                        Correo electronico
                    </label>
                    <input
                        id="correo"
                        class="block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-amber-400 focus:ring-4 focus:ring-amber-100"
                        type="email"
                        name="correo"
                        value="{{ old('correo') }}"
                        placeholder="nombre@correo.com"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    <x-input-error :messages="$errors->get('correo')" class="mt-2 text-sm text-red-600" />
                </div>

                <div>
                    <div class="mb-2 flex items-center justify-between gap-4">
                        <label for="clave" class="block text-sm font-semibold text-slate-800">
                            Contrasena
                        </label>
                    </div>

                    <input
                        id="clave"
                        class="block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-slate-900 shadow-sm outline-none transition focus:border-amber-400 focus:ring-4 focus:ring-amber-100"
                        type="password"
                        name="clave"
                        placeholder="Escribe tu contrasena"
                        required
                        autocomplete="current-password"
                    />
                    <x-input-error :messages="$errors->get('clave')" class="mt-2 text-sm text-red-600" />
                </div>

                <div class="flex items-center justify-between gap-4 rounded-2xl bg-slate-50 px-4 py-3">
                    <label for="remember_me" class="inline-flex items-center gap-3 text-sm text-slate-700">
                        <input
                            id="remember_me"
                            type="checkbox"
                            class="h-4 w-4 rounded border-slate-300 text-amber-600 focus:ring-amber-500"
                            name="remember"
                        >
                        <span>Mantener sesion iniciada</span>
                    </label>

                    <span class="text-xs font-medium uppercase tracking-[0.25em] text-slate-400">Seguro</span>
                </div>

                <button
                    type="submit"
                    class="inline-flex w-full items-center justify-center rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold uppercase tracking-[0.2em] text-white transition hover:bg-slate-800 focus:outline-none focus:ring-4 focus:ring-slate-300"
                >
                    Entrar
                </button>
            </form>
        </div>

        <div class="text-center text-sm text-slate-600">
            No tienes cuenta?
            <a href="{{ route('register') }}" class="font-semibold text-amber-700 transition hover:text-amber-800">
                Registrate aqui
            </a>
        </div>
    </div>
</x-guest-layout>
