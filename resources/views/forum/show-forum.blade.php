<x-app-layout>
    <x-slot name="header">
        <!-- Header title and back button -->
        <div class="flex flex-row gap-4 items-center justify-between">
            <div class="flex flex-row gap-4 items-center">
                <a class="rounded-full bg-slate-600 px-3 py-3 text-white shadow-sm hover:bg-slate-500" href="{{ url()->previous() }}">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 19.5 8.25 12l7.5-7.5" />
                    </svg>
                </a>
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {!! nl2br(e($forum->title)) !!}
                </h2>
            </div>

            @if(Auth::id() !== $forum->user_id)
                {{--            Report Forum--}}
                <form action="{{ route('forum.report', ['forumId' => $forum->id]) }}" method="POST" onsubmit="return confirmReport()">
                    @csrf
                    <button class=" rounded-full bg-red-600 hover:bg-red-500 px-3 py-3 text-sm font-semibold text-white shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
                        </svg>
                    </button>
                    <script>
                        function confirmReport(){
                            return confirm("Are you sure you want to report this forum?");
                        }
                    </script>
                </form>
            @endif

        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- FORUM -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 flex gap-4 flex-col">
                <!-- tittle and author -->
                <div class="flex flex-row justify-between items-center">
                    <h1 class="text-3xl text-white font-bold">
                        {!! nl2br(e($forum->title)) !!}
                    </h1>

                    <div class="flex items-center gap-2">
                        <h1 class="text-lg font-bold text-indigo-600">{{ $forum->user->name }}</h1>
                        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                            <div class="shrink-0 me-3">
                                <img class="h-8 w-8 rounded-full object-cover" src="{{ $forum->user->profile_photo_url }}" alt="{{ $forum->user->name }}" />
                            </div>
                        @endif
                    </div>
                </div>

                <div class="bg-gray-200 dark:bg-gray-700 p-4 rounded-lg mt-4">
                    <!-- Forum image display -->
                    <livewire:image-modal :forum="$forum" />

                    <!-- Forum content -->
                    <p class="text-gray-700 dark:text-gray-300 mt-2">{!! nl2br(e($forum->content)) !!}</p>

                    <!-- Date Created -->
                    <div class="mt-4">
                        <span class="text-gray-500">{{ $forum->created_at->format('d-m-Y H:i:s') }}</span>
                    </div>
                </div>

                    <div x-data="{ showForm: false }">
                        <!-- Button to show comment form -->
                        <button
                            @click="showForm = !showForm"
                            class="rounded-md bg-yellow-500 hover:bg-yellow-400 px-6 py-2 text-white"
                        >
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 8.511c.884.284 1.5 1.128 1.5 2.097v4.286c0 1.136-.847 2.1-1.98 2.193-.34.027-.68.052-1.02.072v3.091l-3-3c-1.354 0-2.694-.055-4.02-.163a2.115 2.115 0 0 1-.825-.242m9.345-8.334a2.126 2.126 0 0 0-.476-.095 48.64 48.64 0 0 0-8.048 0c-1.131.094-1.976 1.057-1.976 2.192v4.286c0 .837.46 1.58 1.155 1.951m9.345-8.334V6.637c0-1.621-1.152-3.026-2.76-3.235A48.455 48.455 0 0 0 11.25 3c-2.115 0-4.198.137-6.24.402-1.608.209-2.76 1.614-2.76 3.235v6.226c0 1.621 1.152 3.026 2.76 3.235.577.075 1.157.14 1.74.194V21l4.155-4.155" />
                            </svg>
                        </button>

                    <!-- Comment Form (Initially Hidden) -->
                    <div x-show="showForm" class="mt-4">
                        <form action="{{ route('comment.store', ['forumId' => $forum->id, 'commentId' => null]) }}" method="POST" class="flex flex-col gap-3" enctype="multipart/form-data" id="comment-form">
                            @csrf
                            <h1 class="text-white text-2xl">Comment</h1>
                            <textarea
                                name="comment"
                                id="comment"
                                placeholder="Hello comment right here you hacker..."
                                class="resize-none h-32 p-2 rounded-md bg-gray-200 dark:bg-gray-700 text-black dark:text-white"
                            ></textarea>
                            <div class="flex flex-row">
                                <button
                                    type="submit"
                                    id="post-btn"
                                    class="rounded-md bg-indigo-600 hover:bg-indigo-500 px-16 py-2.5 text-sm font-semibold text-white shadow-sm"
                                >
                                    Comment!
                                </button>
                            </div>
                        </form>
                    </div>

                    <!-- Alert for confirmation -->
                    @if(session('success'))
                        <script>
                            alert("{{ session('success') }}");
                        </script>
                    @endif

                    @if(session('error'))
                        <script>
                            alert("{{ session('error') }}");
                        </script>
                    @endif

                    @if($errors->any())
                        <script>
                            alert("{{ implode(' ', $errors->all()) }}");
                        </script>
                    @endif

                </div>
            </div>

            @if($comments->count() > 0)
                <h1 class="text-2xl text-white font-semibold mt-4">Comments</h1>
                @foreach($comments as $comment)
                    <x-comment :comment="$comment" :forum="$forum" />
                @endforeach
            @else
                <h1 class="text-base text-gray-400 mt-10">No discussion here, not fun!, COMMENT NOW!</h1>
            @endif

            <div class="mt-4">
                {{ $comments->links() }} <!-- This will generate pagination links -->
            </div>
        </div>

        <div class="mt-10">
            {{ $comments->links() }} <!-- This will generate pagination links -->
        </div>
    </div>
</x-app-layout>
