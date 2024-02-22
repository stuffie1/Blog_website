<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">


                <div class="flex ">


                    <div class="bg-gray-200 bg-opacity-25 grid gap-6 lg:gap-8 p-6 lg:p-8">



                        <div class="pb-4">

                          
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" class="w-6 h-6 stroke-gray-400">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                                    </svg>
                                    <div class="ms-3">
                                        <h1 class=" text-xl font-semibold text-gray-900 me-7"> {{ $blog->title }}</h1>
                                        <div class="text-gray-700">
                                            <p class="text-md">{{ $blog->user->name }} </p> <span
                                                class="text-sm">{{ $blog->published_at }}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex ">
                                <button
                                    class=" mx-3 text-white  bg-cyan-600 hover:bg-cyan-800  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <a href="{{route('blogs.pdf',['blog'=>$blog->id])}}">
                                        Downolad blog as pdf
                                    </a>
                                </button>
                                @if ($blog->user->id == auth()->user()->id)
                                        <button
                                            class=" mx-3 text-white  bg-green-500 hover:bg-green-800  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"><a href="{{route('blogs.edit',['blog'=>$blog->id])}}">Edit</a></button>
                                        @if ($blog->published_at == null)
                                            <button
                                                class="text-white  bg-indigo-500 hover:bg-indigo-700   focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Publish</button>
                                        @endif
                                        <form action="{{route('myblogs.destroy',['myblog'=>$blog->id])}}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                        <button type="submit"
                                        class=" mx-3 text-white  bg-red-500 hover:bg-red-800  focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-4 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                                        >
                                            Delete blog
                                        </button>
                                        </form>
                                        @endif
                                    </div>

                            </div>
                            @if ($blog->image)
                                {{-- <img src="{{$blog->image}}" class="mx-auto my-4"/> --}}
                                <img src="{{ asset('storage/' . $blog->image) }}" class="mx-auto my-10 max-h-96"
                                    alt="{{ $blog->image }}" />
                            @endif
                            <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                {{ $blog->content }}
                            </p>


                        </div>

                        <form class="mx-auto" style="width:50%;" action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <div class="mb-5 flex">
                                <input type="hidden" value="{{ $blog->id }}" name="blog_id" />
                                <input type="text" id="comment" name="comment"
                                    class="@error('comment') border-2 border-red-500  @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="add your comment" />
                                <button type="submit"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 ms-3">Comment</button>

                            </div>
                        </form>
                    </div>


                </div>
            </div>
            @if (!empty($blog->comments))
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg my-8 px-24 py-10 ">


                    @foreach ($blog['comments']->reverse() as $comment)
                        <div class="text-gray-700  p-3 sm:rounded-lg my-5">
                            <div class="flex">
                                <div style="background-image: url({{ asset('storage/'.$blog->user->profile_photo_path) }});background-size:cover" class="w-12 h-12 rounded-full" ></div>
                                <div class="ms-4">
                                    <p class="text-md">
                                        {{ $comment->user->name }} </p>
                                    <span class="text-sm text-gray-400">{{ $comment->created_at }}</span>

                                </div>
                            </div>
                            <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                                {{ $comment->content }}
                            </p>
                        </div>
                        <hr>
                    @endforeach
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg my-8 px-24 py-10 flex justify-center">
                    <h1 class="text-gray-400 mx-auto text-4xl">Theire s no comments</h1>
                </div>
            @endif
        </div>
    </div>
    </div>

</x-app-layout>



