<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                <div class=" flex items-center justify-center p-6 lg:p-8 bg-white border-b border-gray-200">
                    <div class="my-4 mx-auto" style="width: 50%">
                        <h1 class="text-gray-600 text-xl font-bold mx-auto text-center " style="margin-bottom: 30px ">
                            Update Blog</h1>
                        <form class="min-w-xl mx-auto" action="{{ route('myblogs.update',['myblog'=>$blog->id]) }}"
                            enctype="multipart/form-data" method="post">
                            @csrf
                            @method('PUT')
                            <div style="margin-bottom: 30px">
                                <label for="title" style="margin-bottom: 10px"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                                <input type="text" id="title" name="title"
                                    value="{{ $blog->title  }}"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="write a title" />
                                @error('title')
                                    <p class="text-red-600" style="margin-top: 10px">{{ $message }}</p>
                                @enderror
                            </div>
                            <div style="margin-bottom: 30px">
                                <label for="article" style="margin-bottom: 10px"
                                    class="block  text-md font-medium text-gray-900 dark:text-white" id="article"
                                    name="content">Your Article
                                    Content</label>
                                <textarea id="article" rows="4" name="content"
                                    class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="write something...">{{ $blog->content }}</textarea>
                                @error('content')
                                    <p class="text-red-600" style="margin-top: 10px">{{ $message }}</p>
                                @enderror
                            </div>
                            <div style="margin-bottom: 30px">
                                <label for="image" style="margin-bottom: 10px"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Add
                                    Picture</label>
                                <input type="file" name="image"
                                    class="w-full text-black text-lg  bg-gray-100 file:cursor-pointer cursor-pointer file:border-0  file:py-2 file:mr-4 file:bg-gray-500 file:hover:bg-gray-900 file:text-white rounded"
                                    accept=".jpg,.jpeg,.svg,.png" />
                                <input type="hidden" name="oldimage" value="{{ $blog->image }}" />

                                @error('image')
                                    <p class="text-red-600" style="margin-top: 10px">{{ $message }}</p>
                                @enderror
                            </div>
                            <div style="margin-bottom: 30px">
                                <label for="categories"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
                                    style="margin-bottom: 10px">Categorie</label>
                                <select id="categories" name="categorie"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    @foreach ($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->name }}</option>
                                    @endforeach

                                </select>
                                @error('categorie')
                                    <p class="text-red-600" style="margin-top: 10px">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="text-center">
                                <button type="submit"
                                    class="text-white bg-indigo-600 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto mx-auto  px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit
                                    Blog</button>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
