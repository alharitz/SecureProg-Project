<div>
    <x-confirms-password wire:then="confirmPassword">
        <x-danger-button type="button" class="me-3" wire:loading.attr="disabled">
            {{ __('Delete User') }}
        </x-danger-button>
    </x-confirms-password>
</div>
