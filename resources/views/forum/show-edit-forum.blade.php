<x-app-layout>
    <x-slot name="header">
        <!-- Header title and back button -->
        <div class="flex flex-row gap-4 items-center justify-between">
            <div class="flex flex-row gap-4 items-center">
                <a class="rounded-full bg-slate-600 px-3 py-3 text-white shadow-sm hover:bg-slate-500" href="{{ route('forum.edit-index')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </a>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    Edit Forum : {!! nl2br(e($forum->title)) !!}
                </h2>
            </div>

{{--            Delelte Button --}}
            <form action="{{ route('forum.delete', ['forumId' => $forum->id]) }}" method="POST" onsubmit="return confirmDelete()">
                @csrf
                @method('DELETE')
                <button class=" rounded-full bg-red-600 hover:bg-red-500 px-3 py-3 text-sm font-semibold text-white shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                    </svg>
                </button>
                <script>
                    function confirmDelete(){
                        return confirm("Are you sure you want to delete this forum?");
                    }
                </script>
            </form>

        </div>
    </x-slot>

    <!-- alert for uploaded forum confirmation -->
    @if(session('success'))
        <script>
            alert("{{ session('success') }}");
        </script>
    @endif

    @if($errors->any())
        <script>
            alert("{{ implode(' ', $errors->all()) }}");
        </script>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-10 gap-10 flex flex-col">

                <!-- Form start -->
                <form action="{{ route('forum.update', ['forumId' => $forum->id]) }}" method="POST" enctype="multipart/form-data" id="forum-form" class="p-4 gap-10 flex flex-col">
                    <!-- This protects the form against CSRF attacks -->
                    @csrf

                    <!-- Title -->
                    <div class="flex flex-col gap-3">
                        <h1 class="text-white text-2xl">Title</h1>
                        <input type="text" name="title" id="title" placeholder="What's the topic?" value="{{ $forum->title }}" class="h-10 p-2 rounded-md bg-gray-200 dark:bg-gray-700 text-black dark:text-white" required>
                    </div>

                    <!-- Forum -->
                    <div class="flex flex-col gap-3">
                        <h1 class="text-white text-2xl">Forum</h1>
                        <textarea name="content" id="forum" placeholder="Write something awesome hacker :)" class="resize-none h-60 p-2 rounded-md bg-gray-200 dark:bg-gray-700 text-black dark:text-white" required>{{ $forum->content }}</textarea>
                    </div>

                    <div id="image-preview-container">
                        <livewire:remove-image :forum="$forum" />
                    </div>


                    <div class="flex justify-between mt-4">
                        <!-- Upload Button -->
                        <label for="upload-image" class="cursor-pointer rounded-md bg-yellow-500 px-16 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-yellow-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-yellow-600 text-center">
                            Upload Image
                        </label>
                        <input type="file" name="image" id="upload-image" class="hidden" onchange="updateFileName()">
                        <span id="file-name"></span>
                        <!-- Post button -->
                        <button type="submit" id="post-btn" class="rounded-md bg-gray-400 px-16 py-2.5 text-sm font-semibold text-white shadow-sm cursor-not-allowed">Post!</button>

                    </div>
                </form>
                <!-- Form end -->

            </div>
        </div>
    </div>
</x-app-layout>

