<div>
    @if ($isModalVisible)
        <!-- Confirmation Modal for Success Message -->
        <x-confirmation-modal>
            <x-slot name="title">
                {{ __('Delete Successful') }}
            </x-slot>

            <x-slot name="content">
                {{ $successMessage }}
            </x-slot>

            <x-slot name="footer">
                <x-secondary-button wire:click="closeModal" wire:loading.attr="disabled">
                    {{ __('Close') }}
                </x-secondary-button>
            </x-slot>
        </x-confirmation-modal>
    @endif
</div>
