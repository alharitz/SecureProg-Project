<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="flex justify-center">
                <h1 class="text-5xl font-black text-white">
                    Hello {{Auth::user()->name}}
                </h1>
            </div>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mt-10">
                <div class="flex flex-row gap-x-96 items-center px-16 py-10">
                    <h2 class="text-white font-bold text-3xl">
                        Forum Report Count :
                    </h2>
                    <div class="flex flex-col items-center gap-5">
                        <h3 class="text-gray-400 text-5xl">
                            {{ $reportCount }}
                        </h3>
                        <h3 class="text-gray-500 text-3xl ">
                            Reports
                        </h3>
                    </div>
                </div>

                <div class="flex flex-row justify-center pb-10 mt-10">
                    <form action="{{ route('forum-management') }}" method="GET">
                        @csrf
                        <button class=" rounded-md bg-yellow-500 hover:bg-yellow-400 px-3 py-3 text-sm font-semibold text-white shadow-sm flex flex-row gap-4">

                            See Reports
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg mt-10 p-10">
                <h1 class="text-3xl text-white ">
                    Manage User
                </h1>

                <div class="flex flex-row justify-center mt-10">
                    <form action="{{ route('user-management') }}" method="GET">
                        @csrf
                        <button class=" rounded-md bg-indigo-600 hover:bg-indigo-500 px-3 py-3 text-sm font-semibold text-white shadow-sm flex flex-row gap-4">

                            Go to User Mangement
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 6H5.25A2.25 2.25 0 0 0 3 8.25v10.5A2.25 2.25 0 0 0 5.25 21h10.5A2.25 2.25 0 0 0 18 18.75V10.5m-10.5 6L21 3m0 0h-5.25M21 3v5.25" />
                            </svg>
                        </button>
                    </form>
                </div>

            </div>

        </div>
    </div>
</x-app-layout>
