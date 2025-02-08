<div class="p-4 mt-16">
    <!-- Header Section -->
    <div class="flex flex-col gap-4 mb-8 md:flex-row md:items-center md:justify-between">
        <div>
            <h1 class="text-2xl font-semibold text-gray-800">
                Management Identitas Sekolah
            </h1>
            <p class="mt-1 text-sm text-gray-600">
                Kelola identitas sekolah Smk Al-Intisab
            </p>
        </div>
        <livewire:pages.master.identitas.modal-manajemen-identitas-sekolah />
    </div>

    <div class="flex items-center justify-center p-6 rounded-xl bg-white">
        <div class="text-center">
            <div class="relative inline-block">
                <img alt="Error Data Kosong!" class="w-full h-full mx-auto"
                    src="{{ asset('imgs/component/identitas/identitas-sekolah.svg') }}" />
            </div>
            <h1 class="mt-6 text-4xl font-bold text-gray-700">
                Data kosong!
            </h1>
            <p class="mt-2 text-xl text-gray-500">
                Silakan buat data indentitas sekolah.
            </p>
        </div>
    </div>
</div>