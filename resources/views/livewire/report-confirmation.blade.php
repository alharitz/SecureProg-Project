<div>
    <button wire:click="openModal" class=" rounded-full bg-red-600 hover:bg-red-500 px-3 py-3 text-sm font-semibold text-white shadow-sm">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
        </svg>
    </button>
    @if($isModalVisible)
        <x-confirmation-modal>
            <x-slot name="title">
                {{ __('Report Forum') }}
            </x-slot>

            <x-slot name="content">
                {{ __('Are you sure to report this forum?') }}
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                    {{ __('Close') }}
                </x-secondary-button>

                <x-danger-button wire:click="reportForum" wire:loading.attr="disabled" class="ml-6">
                    {{ __('Report Forum') }}
                </x-danger-button>
            </x-slot>
        </x-confirmation-modal>
    @endif
</div>
