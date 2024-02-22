
  

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
                                          <span class="text-sm">{{ $blog->published_at }}</span>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          @if ($blog->image)
                              <img src="{{$blog->image}}" class="mx-auto my-4"/>
                              {{-- <img src="{{ asset('storage/' . $blog->image) }}" class="mx-auto my-10 max-h-96"
                                  alt="{{ $blog->image }}" /> --}}
                          @endif
                          <p class="mt-4 text-gray-500 text-sm leading-relaxed">
                              {{ $blog->content }}
                          </p>


                      </div>

                  </div>


              </div>
          </div>
         
      </div>
  </div>
  </div>




