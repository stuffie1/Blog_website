<x-app-layout>
    @if (request()->routeIs('myblogs.index') || request()->routeIs('myblogs.filter')|| request()->routeIs('myblogs.search'))
        <header class="bg-white shadow flex justify-end">
            <div class="  py-6 px-4 sm:px-6 lg:px-8 flex justify-between">
                <form class="flex justify-between items-center" action="{{ route('myblogs.filter') }}" >
                    @csrf
                    <select name="filter"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-36 me-3 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">

                        <option value="all" @if ($filter === 'all' || empty($filter)) selected @endif>All</option>
                        <option value="published" @if ($filter === 'published') selected @endif>Published</option>
                        <option value="notyet" @if ($filter === 'notyet') selected @endif>Not Published</option>


                    </select>
                    <select id="categories" name="categorie"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-36 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="all" @if ($SelectedCategorie == 'all'|| empty($SelectedCategorie)) selected @endif>All Categories</option>
                        @foreach ($categories as $categorie)
                            <option value="{{ $categorie->id }}" @if ($SelectedCategorie == $categorie->id) selected @endif>
                                {{ $categorie->name }}  </option>
                        @endforeach

                    </select>

                    <button type="submit"
                        class="text-white  ms-3  bg-gray-400 hover:bg-gray-500 w-24 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 my-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                        Filter by
                    </button>
                </form>
                <form class="flex justify-between items-center" action="{{route('myblogs.search')}}">
                    <input type="text" name="search"
                        class="bg-gray-50 border  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 h-10"
                        placeholder="search..." value="@if ($search != null) {{ $search }} @endif"/>
                    <button type="submit"
                        class="text-white ms-3  bg-indigo-600 hover:bg-indigo-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 my-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
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

                    <h1 class=" text-2xl font-medium text-gray-900">
                        Theire s your Blogs <span class="text-red-700">{{ auth()->user()->name }}</span>
                    </h1>

                    <button type="button"
                        class="text-white  bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 my-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                        <a class="block w-full  text-start text-sm leading-5  transition duration-150 ease-in-out"
                            href="{{ route('blogs.create') }}"> Add Blog </a>
                    </button>

                </div>

                <div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2 gap-6 lg:gap-8 p-6 lg:p-8">
                    @if (!empty($blogs))
                    @foreach ($blogs as $blog)
                        <div style="border-bottom: 1px solid grey" class="pb-4">

                            <div class="flex items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                </svg>
                                <div class="flex justify-between w-full">
                                <div class="ms-3">
                                    <h1 class=" text-xl font-semibold text-gray-900"> {{ $blog->title }}</h1>
                                    <p class="text-gray-700"><span class="text-md">{{ $blog->user->name }}</span> <span
                                            class="text-sm">{{ $blog->published_at }}</span></p>
                                </div>
                                @if ($blog->published_at == null)
                                    
                                <button type="button"
                                class="text-white  bg-indigo-500 hover:bg-indigo-700 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 my-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                                <a class="block w-full  text-start text-sm leading-5  transition duration-150 ease-in-out"
                                    href="{{ route('myblogs.publish',['id'=>$blog->id]) }}"> Publish </a>
                            </button>
                                @endif
                                </div>
                            </div>

                            <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                {{ $blog->content }}
                            </p>

                            <p class="mt-4 text-sm">
                                <a href="{{ route('myblogs.show', ['myblog' => $blog->id]) }}"
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
                    <h1 class="text-center text-gray-500 text-3xl ms-72" >No Blog Found</h1>
                    @endif
                </div>


                @if (!empty($blogs))
        
    <div style="width: 50%" class="mx-auto my-5">{{$blogs->links()}}</div>
    @endif


            </div>
        </div>
    </div>
</x-app-layout>
