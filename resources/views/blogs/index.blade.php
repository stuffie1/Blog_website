<x-app-layout>
    @if (request()->routeIs('blogs.index') || request()->routeIs('blogs.filter') || request()->routeIs('blogs.search'))
        <header class="bg-white shadow flex justify-end">
            <div class="  py-6 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                <form class="flex justify-between items-center" action="{{ route('blogs.filter') }}">
                    @csrf
                    <select id="categories" name="categorie"
                        class="bg-gray-50 h-10 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-36 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="all" @if ($SelectedCategorie == 'all') selected @endif>All Categorie</option>
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}" @if ($SelectedCategorie === $categorie->id) selected @endif>
                                {{ $categorie->name }}</option>
                        @endforeach

                    </select>

                    <button type="submit"
                        class="text-white  ms-3  bg-gray-400 hover:bg-gray-500 w-24 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 my-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                        Filter by
                    </button>
                </form>
                <form class="flex justify-between items-center" action="{{ route('blogs.search') }}">
                    @csrf
                    <input type="text" name="search"
                        class="bg-gray-50 border  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 h-10"
                        placeholder="search..." value="@if ($search != null) {{ $search }} @endif" />
                    <button type="submit"
                        class="text-white ms-3  bg-indigo-600 hover:bg-indigo-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-1 me-2 my-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 h-10">
                        Search
                    </button>
                </form>
            </div>
        </header>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class=" flex  items-center justify-between p-6 lg:p-8 bg-white border-b border-gray-200">

                    <h1 class="mt-4 text-2xl font-medium text-gray-900">
                        Welcome to Blog App <span class="text-red-700">{{ auth()->user()->name }}</span>
                    </h1>
                    <button type="button"
                        class="text-white  bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 my-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                        <a class="block w-full  text-start text-sm leading-5  transition duration-150 ease-in-out"
                            href="{{ route('blogs.create') }}"> Add Blog </a>
                    </button>

                </div>
                <div class="flex ">
                    <div style="width: 60% " class="bg-gray-200 py-5 px-4 text-center">
                        <form class="flex justify-between items-center">
                            <input type="text" name="search"
                                class="bg-gray-50 border  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 h-8"
                                placeholder="search for friend ..." />
                            <button type="submit"
                                class="text-white ms-3 flex items-center h-8  bg-indigo-600 hover:bg-indigo-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-2 py-2.5 me-2 my-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">

                                <svg width="20px" height="20px" viewBox="-4.56 -4.56 33.12 33.12" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" stroke="#ffffff">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M15.7955 15.8111L21 21M18 10.5C18 14.6421 14.6421 18 10.5 18C6.35786 18 3 14.6421 3 10.5C3 6.35786 6.35786 3 10.5 3C14.6421 3 18 6.35786 18 10.5Z"
                                            stroke="#ffffff" stroke-width="4" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </g>
                                </svg> </button>
                        </form>
                        @if (empty($followings))
                            <h1 class="text-gray-600 text-md mt-8 h-20 w-full ">you can follow someone <a href="#" class="underline text-blue-600">search</a></h1>
                            @else
                            
                       
                            @foreach ($followings as $following)
                            
                            <div class="">
                                <a class="flex my-4 px-4" href="{{ route('profile.user',['id'=>$following->id])}}"> <div class="rounded-full" style="border-radius: 50%;width: 50px; height: 50px;background-image: url('{{$following->profile_photo_path }}');background-size: cover" >
                                                 
                                </div>
                                <p class="mt-2 ms-4 text-gray-600">{{$following->name}}</p>
                            </a>
                              </div>
                                
                            @endforeach
                      @endif
                    </div>
                    <div>
                        <div
                            class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                            @if (!empty($blogs))
                                @foreach ($blogs as $blog)
                                    <div style="border-bottom: 1px solid grey" class="pb-4">

                                        <div class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                            </svg>
                                            <div class="ms-3">
                                                <h1 class=" text-xl font-semibold text-gray-900"> {{ $blog->title }}</h1>
                                                <p class="text-gray-700"><a href="{{ route('profile.user',['id'=>$following->id]) }}"
                                                        class="text-md">{{ $blog->user->name }}</a> <span
                                                        class="text-sm">{{ $blog->published_at }}</span></p>
                                            </div>
                                        </div>

                                        <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                            {{ $blog->content }}
                                        </p>

                                        <p class="mt-4 text-sm">
                                            <a href="{{ route('blogs.show', ['blog' => $blog->id]) }}"
                                                class="inline-flex items-center font-semibold text-indigo-700">
                                                read more

                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    class="ms-1 w-5 h-5 fill-indigo-500">
                                                    <path fill-rule="evenodd"
                                                        d="M5 10a.75.75 0 01.75-.75h6.638L10.23 7.29a.75.75 0 111.04-1.08l3.5 3.25a.75.75 0 010 1.08l-3.5 3.25a.75.75 0 11-1.04-1.08l2.158-1.96H5.75A.75.75 0 015 10z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        </p>
                                    </div>
                                @endforeach
                            @else
                                <h1 class="text-center text-gray-500 text-3xl flex justify-center mx-12"
                                    style="width:800px">No Blog Found</h1>
                            @endif
                        </div>

                        @if (!empty($blogs))
                            <div style="width: 50%" class="mx-auto my-5">{{ $blogs->links() }}</div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
