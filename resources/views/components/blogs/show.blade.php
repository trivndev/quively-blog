<article
    class="format format-sm sm:format-base lg:format-lg format-blue dark:format-invert mx-auto w-full max-w-7xl">
    <header class="not-format mb-4 lg:mb-6 space-y-4">
        <address class="flex items-center not-italic">
            <div class="mr-3 inline-flex items-center text-sm text-gray-900 dark:text-white">
                <img class="mr-4 aspect-square size-fit max-w-24 rounded-full"
                     src="{{Auth::user()->avatar ? asset('storage/'.Auth::user()->avatar) : asset('img/default.png')}}"
                     alt="{{ ucfirst(Auth::user()->name) }}'s avatar">
                <div>
                    <a href="/blog?author={{ $post->author->username }}" rel="author"
                       title="Read more from {{ ucfirst($post->author->name) }}"
                       class="text-xl font-bold text-gray-900 transition-all duration-300 ease-in-out hover:text-blue-500 dark:text-white">{{ ucfirst($post->author->name) }}</a>
                    <p class="text-base text-gray-500 dark:text-gray-400">
                        <time datetime="{{ $post->created_at->toDateString() }}"
                              title="{{ $post->created_at->format('F j, Y') }}">{{ $post->created_at->diffForHumans() }}</time>
                    </p>
                </div>
            </div>
        </address>
        <div class="flex items-center space-x-3 sm:space-x-4">
            <a href="/dashboard/{{ $post->slug }}/edit"
               class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4">
                <svg aria-hidden="true" class="-ml-1 mr-1 h-5 w-5" fill="currentColor" viewbox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z"/>
                    <path fill-rule="evenodd"
                          d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
                          clip-rule="evenodd"/>
                </svg>
                Edit
            </a>
            <button type="button" data-modal-target="deleteModal-{{ $post->id }}"
                    data-modal-toggle="deleteModal-{{ $post->id }}"
                    class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                <svg aria-hidden="true" class="-ml-1 mr-1.5 h-5 w-5" fill="currentColor" viewbox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                          clip-rule="evenodd"/>
                </svg>
                Delete
            </button>
        </div>
    </header>
    <div id="content" class="space-y-0">
        <h4 class="text-3xl font-extrabold text-gray-900 lg:text-4xl dark:text-white w-full leading-none break-words">
            {{ $post->title }}</h4>
        <a href="/blog?category={{ $post->category->slug }}"
           title="Go to {{ $post->category->name }} category"
           class="{{ $post->category->color }} dark:bg-primary-200 dark:text-primary-800 hover:bg-primary-200 dark:hover:bg-primary-300 block w-fit items-center rounded px-2.5 py-2 text-xs font-medium text-gray-800 transition-all duration-300 ease-in-out hover:text-black no-underline">
            {{ $post->category->name }}
        </a>
        <div class="*:text-justify">
            {!! preg_replace('/<(\w+)[^>]*>\s*<br\s*\/?>\s*<\/\1>/i', '', $post['blog_content']) !!}
        </div>
    </div>
    <div id="deleteModal-{{ $post->id }}" tabindex="-1" aria-hidden="true"
         class="fixed left-0 right-0 top-0 z-50 hidden h-[calc(100%-1rem)] max-h-full w-full items-center justify-center overflow-y-auto overflow-x-hidden md:inset-0">
        <div class="relative max-h-full w-full max-w-md p-4">
            <div
                class="relative rounded-lg bg-white p-4 text-center shadow sm:p-5 dark:bg-gray-800">
                <button type="button"
                        class="absolute right-2.5 top-2.5 ml-auto inline-flex items-center rounded-lg bg-transparent p-1.5 text-sm text-gray-400 hover:bg-gray-200 hover:text-gray-900 dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="deleteModal-{{ $post->id }}">
                    <svg aria-hidden="true" class="h-5 w-5" fill="currentColor"
                         viewbox="0 0 20 20"
                         xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                              d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                              clip-rule="evenodd"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <svg class="mx-auto mb-3.5 h-11 w-11 text-gray-400 dark:text-gray-500"
                     aria-hidden="true"
                     fill="currentColor" viewbox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                          clip-rule="evenodd"/>
                </svg>
                <p class="mb-4 text-gray-500 dark:text-gray-300">Are you sure you want to
                    delete this item?</p>
                <div class="flex items-center justify-center space-x-4">
                    <button data-modal-toggle="deleteModal-{{ $post->id }}" type="button"
                            class="focus:ring-primary-300 rounded-lg border border-gray-200 bg-white px-3 py-2 text-sm font-medium text-gray-500 hover:bg-gray-100 hover:text-gray-900 focus:z-10 focus:outline-none focus:ring-4 dark:border-gray-500 dark:bg-gray-700 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-600">
                        No,
                        cancel
                    </button>
                    <form action="/dashboard/{{ $post->slug }}" method="post">
                        @csrf
                        @method("DELETE")
                        <button type="submit"
                                class="rounded-lg bg-red-600 px-3 py-2 text-center text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                            Yes,
                            I'm sure
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</article>
