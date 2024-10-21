<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Forums') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @foreach ($forums as $forum)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-5 pl-7 pr-7 mb-4">
                    <div class="flex flex-col gap-2">
                        <div class="flex flex-row justify-between items-center">
                            <!-- tittle and author -->
                            <a href="{{ route('forum.show', $forum->id) }}" class="text-2xl text-white font-bold hover:text-indigo-600">{{ $forum->title }}</a>
                            <h1 class="text-lg font-bold text-indigo-600">{{ $forum->user->name }}</h1>
                        </div>
                        
                        <!-- Content -->
                        @php
                            // Get the original content
                            $originalContent = $forum->content;

                            // Limit content to 500 characters
                            $limitedContent = \Illuminate\Support\Str::limit($originalContent, 500, '');

                            // Split the content into lines
                            $lines = explode("\n", $limitedContent);
                            
                            // Limit to the first 5 lines
                            $limitedLines = implode("\n", array_slice($lines, 0, 5));

                            // Check if the original content exceeds 500 characters or 5 lines
                            $finalContent = (strlen($originalContent) > 500 || count($lines) > 5) ? "{$limitedLines}..." : $limitedLines;
                        @endphp

                        <div>
                            <p class="text-gray-400">{!! nl2br(e($finalContent)) !!}</p>
                        </div>
                        <div>
                            <span class="text-gray-500">{{ $forum->created_at->format('d-m-Y H:i:s') }}</span>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            <div>
                {{ $forums->links() }} 
            </div>
        </div>
    </div>
</x-app-layout>