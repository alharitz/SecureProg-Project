<!-- resources/views/components/comment.blade.php -->
@props(['comment', 'forum'])

<div class="comment bg-gray-200 dark:bg-gray-800 p-6 rounded-lg mt-4 flex gap-3 flex-col">
    <div class="flex flex-row">
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div class="shrink-0 me-3">
                <img class="h-8 w-8 rounded-full object-cover" src="{{ $comment->user->profile_photo_url }}" alt="{{ $comment->user->name }}" />
            </div>
        @endif
        <p class="text-gray-800 dark:text-gray-100"><strong>{{ $comment->user->name }}</strong> commented:</p>
    </div>
    
    <div class="bg-gray-200 dark:bg-gray-700 p-4 rounded-lg">
        <p class="text-gray-700 dark:text-gray-300 mt-2">{{ $comment->content }}</p>
        <p class="text-gray-500 dark:text-gray-400 text-sm mt-1">{{ $comment->created_at->diffForHumans() }}</p>
    </div>

    <!-- Reply Button and Form (Initially Hidden) -->
    <div x-data="{ showReplyForm: false, showReplies: false }">
        <div class="flex items-center justify-between">
            <!-- Toggle Button for Reply Form -->
            <button 
                @click="showReplyForm = !showReplyForm" 
                class="rounded-md bg-yellow-500 hover:bg-yellow-400 px-3 py-2 text-white text-sm font-semibold"
            >
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 inline-block mr-1">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                </svg>
                Reply
            </button>

            <!-- Show Replies Button on the Right -->
            @if($comment->replies->count() > 0)
                <button 
                    @click="showReplies = !showReplies" 
                    class="text-gray-400 mt-2 px-4 py-1 rounded inline-flex items-center hover:text-gray-300"
                >
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-4 h-4 mr-1">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6"/>
                    </svg> 
                    Show Replies ({{ $comment->replies->count() }})
                </button>
            @endif
        </div>

        <!-- Reply Form -->
        <div x-show="showReplyForm" class="mt-4">
            <form action="{{ route('reply.store', ['forumId' => $forum->id, 'commentId' => $comment->id]) }}" method="POST" class="flex flex-col gap-3" enctype="multipart/form-data">
                @csrf
                <textarea 
                    name="reply" 
                    id="reply" 
                    placeholder="Write your reply..." 
                    class="resize-none h-32 p-2 rounded-md bg-gray-200 dark:bg-gray-700 text-black dark:text-white"
                ></textarea>
                <div class="flex flex-row">
                    <button 
                        type="submit" 
                        class="rounded-md bg-indigo-600 hover:bg-indigo-500 px-16 py-2.5 text-sm font-semibold text-white shadow-sm"
                    >
                        Post Reply
                    </button>
                </div>
            </form>
        </div>

        @if($errors->any())
            <script>
                alert("{{ implode(' ', $errors->all()) }}");
            </script>
        @endif

        <!-- Replies container -->
        <div x-show="showReplies" class="replies-container mt-3 ml-8">
            @foreach($comment->replies as $reply)
                <x-comment :comment="$reply" :forum="$forum" />
            @endforeach
        </div>
    </div>
</div>
