<div class="py-6">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h2 class="mb-6 text-2xl font-semibold text-gray-800">Daftar Pesanan Customer</h2>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
            @forelse($transactions as $transaction)
                <div
                    class="overflow-hidden bg-white rounded-lg shadow-md transition-shadow duration-300 hover:shadow-lg">
                    <div class="p-6">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">
                                    {{ $transaction->customer->name ?? 'Tanpa Nama' }}</h3>
                                <p class="text-sm text-gray-500">Invoice #{{ $transaction->invoice }}</p>
                            </div>
                            <span
                                class="px-3 py-1 text-sm rounded-full {{ $transaction->is_done ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $transaction->is_done ? 'Paid' : 'Unpaid' }}
                            </span>
                        </div>

                        <div class="space-y-3">
                            @foreach ($transaction->items as $menuName => $item)
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center">
                                        <span
                                            class="flex justify-center items-center w-8 h-8 font-semibold text-gray-600 bg-gray-100 rounded-full">
                                            {{ $item['qty'] }}x
                                        </span>
                                        <span class="ml-3 text-gray-700">{{ $menuName }}</span>
                                    </div>
                                    <span class="text-gray-600">Rp
                                        {{ number_format($item['price'], 0, ',', '.') }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="pt-4 mt-4 border-t border-gray-100">
                            <div class="flex justify-between items-center">
                                <span class="font-medium text-gray-600">Total</span>
                                <span class="text-lg font-semibold text-gray-800">Rp
                                    {{ number_format($transaction->total, 0, ',', '.') }}</span>
                            </div>
                            @if ($transaction->desc)
                                <div class="mt-2 text-sm text-gray-600">
                                    Catatan: {{ $transaction->desc }}
                                </div>
                            @endif
                            <div class="flex justify-between items-center mt-2">
                                <span class="text-sm text-gray-500">
                                    {{ $transaction->created_at->diffForHumans() }}
                                </span>
                                <div class="flex gap-2">
                                    @if ($transaction->is_done)
                                        <button wire:click="setReady({{ $transaction->id }})"
                                            class="btn btn-circle btn-sm btn-success">
                                            <x-tabler-check class="size-4" />
                                        </button>
                                    @else
                                        <button wire:click="showModal({{ $transaction->id }})"
                                            class="btn btn-circle btn-sm btn-primary">
                                            <x-tabler-cash class="size-4" />
                                        </button>
                                    @endif

                                    <button wire:click="playAnnouncement({{ $transaction->id }})"
                                        class="btn btn-circle btn-sm btn-error">
                                        <x-tabler-phone-spark class="size-4" />
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full">
                    <div class="py-12 text-center bg-gray-50 rounded-lg">
                        <p class="text-gray-500">Belum ada pesanan yang tersedia</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $transactions->links() }}
        </div>
        <div>
            @livewire('transaction.show')
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('livewire:initialized', () => {
                Livewire.on('play-announcement', ({
                    customerName
                }) => {
                    try {
                        // Check if speech synthesis is available
                        if (!window.speechSynthesis) {
                            console.error('Speech synthesis not supported');
                            return;
                        }

                        // Cancel any ongoing speech
                        window.speechSynthesis.cancel();

                        const speech = new SpeechSynthesisUtterance();
                        speech.text =
                            `Pesanan atas nama ${customerName}, sudah siap!, silahkan menuju Kasir!`;
                        speech.lang = 'id-ID';
                        speech.volume = 1;
                        speech.rate = 0.8;
                        speech.pitch = 1;

                        // Add event listeners for debugging
                        speech.onstart = () => console.log('Speech started');
                        speech.onend = () => console.log('Speech ended');
                        speech.onerror = (event) => console.error('Speech error:', event);

                        // Get available voices
                        let voices = window.speechSynthesis.getVoices();

                        // If voices aren't loaded yet, wait for them
                        if (voices.length === 0) {
                            window.speechSynthesis.addEventListener('voiceschanged', () => {
                                voices = window.speechSynthesis.getVoices();
                                // Try to find Indonesian voice
                                const indonesianVoice = voices.find(voice => voice.lang.includes(
                                    'id-ID'));
                                if (indonesianVoice) {
                                    speech.voice = indonesianVoice;
                                }
                                window.speechSynthesis.speak(speech);
                            }, {
                                once: true
                            });
                        } else {
                            // Try to find Indonesian voice
                            const indonesianVoice = voices.find(voice => voice.lang.includes('id-ID'));
                            if (indonesianVoice) {
                                speech.voice = indonesianVoice;
                            }
                            window.speechSynthesis.speak(speech);
                        }

                    } catch (error) {
                        console.error('Error playing announcement:', error);
                    }
                });
            });
        </script>
    @endpush
</div>
