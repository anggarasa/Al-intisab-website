<div>
    <div class="fixed top-4 right-4 z-50 space-y-4 w-96">
        @foreach($messages as $notification)
        <div wire:key="notification-{{ $notification['id'] }}" x-data="notificationItem({{ $notification['id'] }})"
            x-show="show" x-init="startTimer()" x-transition:enter="transform ease-out duration-300 transition"
            x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
            x-transition:leave="transform ease-in duration-300 transition" x-transition:leave-start="translate-x-0"
            x-transition:leave-end="translate-x-full" class="rounded-xl p-4 shadow-2xl relative overflow-hidden border-l-4 transform hover:scale-102 transition-transform duration-200 bg-white
            @switch($notification['type'])
                @case('success') border-green-500 text-green-800 @break
                @case('error') border-red-500 text-red-800 @break
                @case('warning') border-yellow-500 text-yellow-800 @break
                @case('info') border-blue-500 text-blue-800 @break
            @endswitch">

            <div class="flex items-start space-x-4">
                <!-- Icon (sama seperti sebelumnya) -->
                <div class="flex-shrink-0 rounded-lg p-2
                    @switch($notification['type'])
                        @case('success') bg-green-100 text-green-500 @break
                        @case('error') bg-red-100 text-red-500 @break
                        @case('warning') bg-yellow-100 text-yellow-500 @break
                        @case('info') bg-blue-100 text-blue-500 @break
                    @endswitch">
                    @switch($notification['type'])
                    @case('success')
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    @break
                    @case('error')
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                    @break
                    @case('warning')
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                        </path>
                    </svg>
                    @break
                    @case('info')
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    @break
                    @endswitch
                </div>

                <!-- Content -->
                <div class="flex-1">
                    <h3 class="font-semibold text-lg mb-1">{{ $notification['title'] }}</h3>
                    <p class="text-sm opacity-80">{{ $notification['message'] }}</p>
                </div>

                <!-- Close Button -->
                <button @click="closeNotification()"
                    class="flex-shrink-0 bg-white bg-opacity-20 rounded-lg p-1 hover:bg-opacity-30 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>

            <!-- Progress Bar -->
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-black bg-opacity-10">
                <div x-ref="progressBar" class="h-full bg-white bg-opacity-30 notification-progress"
                    :style="`width: ${progress}%`">
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <script>
        function notificationItem(id) {
        return {
            show: true,
            progress: 100,
            timer: null,
            
            startTimer() {
                this.timer = setInterval(() => {
                    this.progress -= 1;
                    
                    if (this.progress <= 0) {
                        this.closeNotification();
                    }
                }, 30); // Sesuaikan kecepatan progress bar
            },
            
            closeNotification() {
                this.show = false;
                
                // Hentikan timer
                if (this.timer) {
                    clearInterval(this.timer);
                }
                
                // Panggil metode Livewire untuk menghapus notifikasi
                @this.removeNotification(id);
            }
        }
    }
    </script>
</div>