@props(['active'])
@php
    $classes = $active ?? false ? ' text-black ms-3  flex items-center h-10  bg-gray-200  focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-md px-4 py-4 me-2 my-4 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 
 ' : ' text-black ms-3 flex items-center h-10  bg-transparent hover:bg-gray-100  focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-md px-4 py-4 me-2 my-4 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700 
';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }} >
{{$slot}}
   

</a>