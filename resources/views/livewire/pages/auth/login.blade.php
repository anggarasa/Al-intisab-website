<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use Illuminate\Support\Facades\Auth;

new #[Layout('layouts.guest', ['title' => 'Login'])] class extends Component
{
    public LoginForm $form;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $user = $this->form->authenticate();

        Session::regenerate();

        if ($user->hasRole('siswa')) {
            $this->redirect('/siswa');
        } elseif ($user->hasRole('guru')) {
            $this->redirect('/guru');
        } elseif ($user->hasRole('kurikulum')) {
            $this->redirect('/kurikulum');
        } elseif ($user->hasRole('tu')) {
            $this->redirect('/tu');
        } elseif ($user->hasRole('keuangan')) {
            $this->redirect('/keuangan');
        }
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <section class="bg-white h-screen">
        <div class="lg:grid lg:h-screen lg:grid-cols-12">
            <aside class="relative block h-full lg:order-last lg:col-span-5 xl:col-span-6">
                <!-- SVG Background -->
                <svg class="absolute inset-0 w-full h-full" viewBox="0 0 720 800" fill="none"
                    xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="xMidYMid slice">
                    <rect width="720" height="800" fill="#22C55E" />
                    <rect x="429" y="0" width="58" height="732" fill="#39A331" />
                    <rect x="4" y="276" width="57" height="525" fill="#39A331" />
                    <rect x="61" y="196" width="62" height="605" fill="#39A331" />
                    <rect x="123" y="125" width="62" height="676" fill="#39A331" />
                    <rect x="185" y="63" width="62" height="738" fill="#39A331" />
                    <rect x="247" y="0" width="62" height="800" fill="#39A331" />
                    <rect x="309" y="0" width="62" height="800" fill="#39A331" />
                    <rect x="371" y="0" width="58" height="800" fill="#39A331" />
                    <rect x="486" y="0" width="58" height="658" fill="#39A331" />
                    <rect x="544" y="0" width="65" height="585" fill="#39A331" />
                    <rect x="609" y="0" width="61" height="526" fill="#39A331" />
                    <rect x="667" y="0" width="53" height="455" fill="#39A331" />
                </svg>

                <!-- Image and Text Container -->
                <div class="absolute inset-0 flex flex-col items-center justify-center">
                    <!-- Image Container -->
                    <div class="relative w-1/2 h-1/2 mb-16">
                        <!-- Tambahkan margin-bottom (mb-16) untuk jarak -->
                        <img src="{{ asset('imgs/component/login/component-login-2.svg') }}" alt="Centered Image"
                            class="object-contain w-full h-full" />
                    </div>

                    <!-- Text Container -->
                    <div class="text-center mx-20 text-white mb-10">
                        <h2 class="text-3xl font-bold mb-2">Selamat Datang di SMK AL-INTISAB Patokbeusi</h2>
                        <p class="text-xl">Kami berkomitmen untuk memberikan pendidikan terbaik bagi siswa-siswi kami.
                            Silakan login
                            untuk memulai perjalanan belajar Anda bersama kami.</p>
                    </div>

                    <div>
                        <svg width="42" height="6" viewBox="0 0 42 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="16" height="6" rx="3" fill="#FAFAFA" />
                            <rect x="23" width="6" height="6" rx="3" fill="#D9D9D9" />
                            <rect x="36" width="6" height="6" rx="3" fill="#D9D9D9" />
                        </svg>
                    </div>
                </div>
            </aside>

            <main class="relative bg-pattern lg:col-span-7 xl:col-span-6">
                <!-- Overlay untuk membuat konten lebih mudah dibaca -->
                <div class="absolute inset-0">
                    <!-- Container untuk konten -->
                    <div class="relative h-full flex items-center justify-center px-8 py-8 sm:px-12 lg:px-16">
                        <div class="max-w-xl lg:max-w-3xl">
                            <a class="block text-blue-600" href="#">
                                <span class="sr-only">Home</span>
                                <img src="{{ asset('imgs/logo/logo-intisab.svg') }}" class="h-12 sm:h-20"
                                    alt="SMK Al-intisab">
                            </a>

                            <h1 class="mt-6 text-2xl font-bold text-gray-900 sm:text-3xl md:text-4xl">
                                Login
                            </h1>

                            <p class="mt-4 leading-relaxed text-gray-500">
                                Silakan login terlebih dahulu untuk memulai.
                            </p>

                            <form wire:submit="login" class="mt-8 space-y-2">

                                <div class="col-span-6">
                                    <x-input type="email" name="email" label="Email" placeholder="Masukan email anda"
                                        wire="form.email" required="true" />
                                    <x-input-error :messages="$errors->get('form.email')" class="mt-2" />
                                </div>

                                <div class="col-span-6 sm:col-span-3">
                                    <x-input type="password" name="password" wire="form.password"
                                        placeholder="Masukan password anda" label="Password" required="true" />
                                    <x-input-error :messages="$errors->get('form.password')" class="mt-2" />
                                </div>

                                <!-- Remember Me & Forgot Password -->
                                <div class="flex items-center justify-between">
                                    <label class="flex items-center">
                                        <input type="checkbox" wire:model="form.remember"
                                            class="rounded-md border-gray-300 text-green-500 focus:ring-green-400 h-4 w-4" />
                                        <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                                    </label>
                                    @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}"
                                        class="text-sm text-green-600 hover:text-green-700 font-medium hover:underline">Lupa
                                        password?</a>
                                    @endif
                                </div>

                                <button type="submit"
                                    class="w-full bg-gradient-to-r from-green-500 to-emerald-500 text-white py-3 px-4 rounded-xl hover:from-green-600 hover:to-emerald-600 focus:outline-none focus:ring-2 focus:ring-green-300 focus:ring-opacity-50 transition duration-200 flex items-center justify-center transform hover:scale-[1.02]"
                                    wire:loading.attr="disabled" wire:loading.class="opacity-50 cursor-not-allowed">
                                    <!-- Teks Normal -->
                                    <span wire:loading.remove>Masuk</span>

                                    <!-- Loading State -->
                                    <div wire:loading class="flex items-center gap-2">
                                        <i class="fa-solid fa-spinner animate-spin text-xl"></i>
                                        <span>Memproses...</span>
                                    </div>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </section>
</div>