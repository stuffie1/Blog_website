@extends('dashboard.index')
@section('content')
    <h1 class="text-3xl font-bold ms-8 mt-3">Comments</h1>
    <p class="ms-8 mb-12 text-indigo-500 ">Manage Comments</p>
    <div class="py-4 px-6 mb-8 mx-12 border-2 border-gray-300 rounded-2xl">
        <h2 class="text-xl font-bold">invite users to your organisation</h2>
        <div class="flex justify-between">
            <p class="text-indigo-500">Lorem ipsum, dolor sit alore at. Perferendis exercitationem inventore fugit mollitia
                cumque aspernatur nobis qui provident magni rem. Possimus, nisi. Nulla commodi illum atque.</p>
            <button class="text-white w-48 h-10 px-4 py-1 bg-indigo-600 hover:bg-indigo-800 rounded-xl">Invite users</button>
        </div>
    </div>
    <form class="flex justify-between items-center mx-8 mb-4" action="{{ route('myblogs.search') }}">
        <input type="text" name="filter"
            class="bg-gray-50 border  border-gray-300 text-gray-700 text-md ps-6 rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 h-10"
            placeholder=" Filter user ..." />
        <button type="submit"
            class="text-white ms-3  bg-indigo-600 hover:bg-indigo-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 my-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
            Search
        </button>
    </form>
    @if ($comments == [])
        <h1 class="text-3xl ms-96 text-gray-400">Theire no Comment yet</h1>
    @else
        <table class="w-full text-md text-left  text-gray-500 dark:text-gray-400 ms-8" style="width: 1000px">
            <thead class="text-md text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        User
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Content
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Created
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Blog title
                    </th>

                    <th scope="col" class="px-6 py-3">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($comments as $comment)
                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                        <td scope="row" class=" py-4 text-sm text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $comment->user->name }}
                        </td>
                        <th class="text-sm py-4">
                            {{ $comment->content }}
                        </th>
                        <td class="text-sm py-4">
                            {{ $comment->created_at }}
                        </td>
                        <td class="text-sm py-4">
                            {{ $comment->blog->title }}
                        </td>

                        <td class="text-sm py-4 text-center">
                            <form action="{{route('dashboard.destroy',['id'=>$comment->id])}}" method="POST">
                                @csrf
                                @method("DELETE")
                            <button type="submit">
                                <svg fill="#9e0000" width='20px' height="20px" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg" stroke="#9e0000">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M5.755,20.283,4,8H20L18.245,20.283A2,2,0,0,1,16.265,22H7.735A2,2,0,0,1,5.755,20.283ZM21,4H16V3a1,1,0,0,0-1-1H9A1,1,0,0,0,8,3V4H3A1,1,0,0,0,3,6H21a1,1,0,0,0,0-2Z">
                                        </path>
                                    </g>
                                </svg>
                            </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
@endsection
@section('pagination')
    @if (!empty($comments))
        <div style="width: 50%" class="mx-auto my-5">{{ $comments->links() }}</div>
    @endif
@endsection
