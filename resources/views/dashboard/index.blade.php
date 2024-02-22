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

  <div class="" style="min-height: 100vh">
      <div class=" "style="min-height: 100vh">
          <div class="bg-white overflow-y-auto  shadow-xl sm:rounded-lg" style="min-height: 100vh">


              <div class="flex " style="min-height: 100vh">
                  <div style="width: 15%" class="bg-white py-5 px-2 flex-col border-e-2 border-zinc-200">
                      <x-nav-link-dashboard href="{{ route('dashboard.users') }}" :active="request()->routeIs('dashboard.users')||request()->routeIs('dashboard')">



                          <svg width="30px" height="30px" class="bg-transparent" viewBox="0 0 24 24" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                              <g id="SVGRepo_iconCarrier">
                                  <rect width="30" height="30" fill="transparent"></rect>
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M5 9.5C5 7.01472 7.01472 5 9.5 5C11.9853 5 14 7.01472 14 9.5C14 11.9853 11.9853 14 9.5 14C7.01472 14 5 11.9853 5 9.5Z"
                                      fill="#323232"></path>
                                  <path
                                      d="M14.3675 12.0632C14.322 12.1494 14.3413 12.2569 14.4196 12.3149C15.0012 12.7454 15.7209 13 16.5 13C18.433 13 20 11.433 20 9.5C20 7.567 18.433 6 16.5 6C15.7209 6 15.0012 6.2546 14.4196 6.68513C14.3413 6.74313 14.322 6.85058 14.3675 6.93679C14.7714 7.70219 15 8.5744 15 9.5C15 10.4256 14.7714 11.2978 14.3675 12.0632Z"
                                      fill="#323232"></path>
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M4.64115 15.6993C5.87351 15.1644 7.49045 15 9.49995 15C11.5112 15 13.1293 15.1647 14.3621 15.7008C15.705 16.2847 16.5212 17.2793 16.949 18.6836C17.1495 19.3418 16.6551 20 15.9738 20H3.02801C2.34589 20 1.85045 19.3408 2.05157 18.6814C2.47994 17.2769 3.29738 16.2826 4.64115 15.6993Z"
                                      fill="#000000"></path>
                                  <path
                                      d="M14.8185 14.0364C14.4045 14.0621 14.3802 14.6183 14.7606 14.7837V14.7837C15.803 15.237 16.5879 15.9043 17.1508 16.756C17.6127 17.4549 18.33 18 19.1677 18H20.9483C21.6555 18 22.1715 17.2973 21.9227 16.6108C21.9084 16.5713 21.8935 16.5321 21.8781 16.4932C21.5357 15.6286 20.9488 14.9921 20.0798 14.5864C19.2639 14.2055 18.2425 14.0483 17.0392 14.0008L17.0194 14H16.9997C16.2909 14 15.5506 13.9909 14.8185 14.0364Z"
                                      fill="#000000"></path>
                              </g>
                          </svg>

                          <span class="ms-4">Users</span>
                      </x-nav-link-dashboard>
                      <x-nav-link-dashboard href="{{ route('dashboard.blogs') }}" :active="request()->routeIs('dashboard.blogs')">



                          <svg width="30px" height="30px" viewBox="0 0 24 24" fill="none"
                              xmlns="http://www.w3.org/2000/svg">
                              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                              <g id="SVGRepo_iconCarrier">
                                  <path fill-rule="evenodd" clip-rule="evenodd"
                                      d="M4.4 3h15.2A3.4 3.4 0 0 1 23 6.4v11.2a3.4 3.4 0 0 1-3.4 3.4H4.4A3.4 3.4 0 0 1 1 17.6V6.4A3.4 3.4 0 0 1 4.4 3ZM7 9a1 1 0 0 1 1-1h8a1 1 0 1 1 0 2H8a1 1 0 0 1-1-1Zm1 2a1 1 0 1 0 0 2h8a1 1 0 1 0 0-2H8Zm-1 4a1 1 0 0 1 1-1h4a1 1 0 1 1 0 2H8a1 1 0 0 1-1-1Z"
                                      fill="#000000"></path>
                              </g>
                          </svg>
                          <span class="ms-4">Blogs</span>
                      </x-nav-link-dashboard>
                      <x-nav-link-dashboard href="{{ route('dashboard.comments') }}" :active="request()->routeIs('dashboard.comments')">



                          <svg width="30px" height="30px" viewBox="-0.5 0 32 32" version="1.1"
                              xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                              xmlns:sketch="http://www.bohemiancoding.com/sketch/ns" fill="#000000">
                              <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                              <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                              <g id="SVGRepo_iconCarrier">
                                  <title>comments</title>
                                  <desc>Created with Sketch Beta.</desc>
                                  <defs> </defs>
                                  <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"
                                      sketch:type="MSPage">
                                      <g id="Icon-Set-Filled" sketch:type="MSLayerGroup"
                                          transform="translate(-259.000000, -257.000000)" fill="#000000">
                                          <path
                                              d="M265.5,267 C266.329,267 267,267.672 267,268.5 C267,269.329 266.329,270 265.5,270 C264.671,270 264,269.329 264,268.5 C264,267.672 264.671,267 265.5,267 L265.5,267 Z M271.5,267 C272.329,267 273,267.672 273,268.5 C273,269.329 272.329,270 271.5,270 C270.671,270 270,269.329 270,268.5 C270,267.672 270.671,267 271.5,267 L271.5,267 Z M277.5,267 C278.329,267 279,267.672 279,268.5 C279,269.329 278.329,270 277.5,270 C276.671,270 276,269.329 276,268.5 C276,267.672 276.671,267 277.5,267 L277.5,267 Z M268.637,279.736 C269.414,279.863 271.181,280 272,280 C279.18,280 284,274.657 284,268.375 C284,262.093 277.977,257 272,257 C264.811,257 259,262.093 259,268.375 C259,272.015 260.387,275.104 263,277.329 L263,283 L268.637,279.736 L268.637,279.736 Z M285.949,266.139 L286,267 C286.008,267.817 286,267.742 286,268.5 C286,276.475 279.716,282 271,282 L268,282 C270.38,284.328 273.149,285.75 277,285.75 C277.819,285.75 278.618,285.676 279.395,285.549 L285,289 L285,283.329 C288.04,281.246 290,278.015 290,274.375 C290,271.131 288.439,268.211 285.949,266.139 L285.949,266.139 Z"
                                              id="comments" sketch:type="MSShapeGroup"> </path>
                                      </g>
                                  </g>
                              </g>
                          </svg> <span class="ms-4">Comments</span>
                      </x-nav-link-dashboard>


                  </div>
                  <div>
                      <div
                          class=" overflow-x-auto bg-white bg-opacity-25 flex-col  justify-center  pt-4 px-6 lg:px-8 ">
                       @yield('content')
                      </div>

                      @yield('pagination')

                  </div>
              </div>

          </div>
      </div>
  </div>
</x-app-layout>
