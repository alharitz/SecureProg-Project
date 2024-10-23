<x-app-layout>
    <x-slot name="header">
        <!-- Header title and back button -->
        <div class="flex flex-row gap-4 items-center">
            <a class="rounded-full bg-slate-600 px-3 py-3 text-white shadow-sm hover:bg-slate-500" href="{{ route('forum.edit-index')}}">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                </svg>

            </a>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Edit Forum : {!! nl2br(e($forum->title)) !!}
            </h2>
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

