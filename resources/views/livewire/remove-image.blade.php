<div>
    @if($forum->forum_images_path)
        <div id="image-preview-container">
            <livewire:image-modal :forum="$forum" />
            <button wire:click="removeImage" class="rounded-md bg-red-600 px-10 py-2.5 text-sm font-semibold text-white shadow-sm mt-5">Remove Image</button>
        </div>
    @endif

    @if(session()->has('message'))
        <div class="mt-2 text-green-600">
            {{ session('message') }}
        </div>
    @endif
</div>
