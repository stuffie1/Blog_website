<x-app-layout>
  <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 ">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
          <div class=" flex  justify-between  bg-white border-b border-gray-200">
            <div class="bg-gray-200 lg:p-8 lg:mb-6" style="width: 40%">
              <h1 class="mt-4 text-2xl font-medium text-gray-400">
                Suggestion
              </h1>
              <div class="mt-8 ">
                @foreach ($suggestions as $suggestion)
                <div class="flex justify-between items-center">
                <div class="flex my-4 px-4">
                  <a href="{{auth()->user()->id==$suggestion->id ? route('profile.show') : route('profile.user',['id'=>$suggestion->id])}}"> <div class="rounded-full" style="border-radius: 50%;width: 50px; height: 50px;background-image: url('{{$suggestion->profile_photo_path }}');background-size: cover" >
                                   
                  </div></a>
                  <p class="mt-2 ms-4 text-gray-600">{{$suggestion->name}}</p>
                </div>
                <button type="button" style="background-color: rgb(17 24 39 / var(--tw-bg-opacity));"
                class="text-white h-10  bg-gray-900 hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 my-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                <a class="block w-full  text-start text-sm leading-5  transition duration-150 ease-in-out"
                    href="{{ route('user.follow',['following_id'=>$suggestion->id]) }}"> follow </a>
            </button>
                </div>
                @endforeach
              </div>
            </div>
            <!-- search div -->
            <div class="w-full px-12 py-8 text-center">
              <form class="flex justify-between items-center" action="{{route('user.search')}}">
                @csrf
                <input type="text" name="search"
                    class="bg-gray-50 border  border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 h-10"
                    placeholder="search for friend ..." />
                <button type="submit"
                    class="text-white ms-3 flex items-center h-10  bg-indigo-600 hover:bg-indigo-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-2 py-2.5 me-2 my-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">

                    <svg width="30px" height="30px" viewBox="-4.56 -4.56 33.12 33.12" fill="none"
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
            @if ($msg )
              <h1 class="text-gray-400 mt-6 text-xl">You are searching for someone</h1>
              @endif
            @if (!empty($users))
              
             @foreach ($users as $user)
             <div class="flex justify-between items-center">
              <div class="flex my-4 px-4">
                <a href="{{auth()->user()->id==$user->id ? route('profile.show') : route('profile.user',['id'=>$user->id])}}"> <div class="rounded-full" style="border-radius: 50%;width: 50px; height: 50px;background-image: url('{{$user->profile_photo_path }}');background-size: cover" >
                                 
                </div></a>
                <p class="mt-2 ms-4 text-gray-600">{{$user->name}}</p>
              </div>
              @if ($user->followers()->where('following_id', $user->id)->exists() )
              <button type="button"
                  class="inline-flex items-center justify-center px-4 py-2 bg-red-600 hover:bg-red-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                  <a class="block w-full  text-start text-sm leading-5  transition duration-150 ease-in-out"
                      href="{{ route('user.unfollow', ['following_id' => $user->id]) }}"> unfollow
                  </a>
              </button>
          @else
              <button type="button"
                  class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                  <a class="block w-full  text-start text-sm leading-5  transition duration-150 ease-in-out"
                      href="{{ route('user.follow', ['following_id' => $user->id]) }}"> follow </a>
              </button>

          @endif
              </div>
              
             @endforeach
             {{-- @else
             <h1 class="text-gray-400 mt-6 text-xl">Theire s no user with this name</h1> --}}
               
              
            @endif
            </div>
          </div>
        </div>
    </div>
  </div>
</x-app-layout>