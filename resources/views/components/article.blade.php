@if ($isDetail)
    <article
            class="format format-sm sm:format-base lg:format-lg format-blue dark:format-invert mx-auto w-full max-w-7xl bg-white px-12 py-8 rounded-lg">
        <div class="mx-auto w-full mb-6">
            <a class="text-base font-medium text-blue-500 hover:underline underline-offset-2 hover:text-blue-800 transition-all duration-300 ease-in-out"
               href="/blog">&laquo; Back to all blogs</a>
        </div>
        <div class="not-format mb-4 lg:mb-6">
            <address class="mb-6 flex items-center not-italic">
                <div class="mr-3 inline-flex items-center text-sm text-gray-900 dark:text-white">
                    <img class="mr-4 aspect-square size-fit max-w-12 rounded-full shadow border-2"
                         src="{{$post->author->avatar ? asset('storage/'.$post->author->avatar) : asset('img/default.png')}}"
                         alt="{{ ucfirst($post->author->name) }}'s avatar">
                    <div>
                        <a href="/blog?author={{ $post->author->username }}" rel="author"
                           title="Read more from {{ ucfirst($post->author->name) }}"
                           class="text-base font-bold text-gray-900 transition-all duration-300 ease-in-out hover:text-blue-500 dark:text-white">{{ ucfirst($post->author->name) }}</a>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            <time datetime="{{ $post->created_at->toDateString() }}"
                                  title="{{ $post->created_at->format('F j, Y') }}">{{ $post->created_at->format('F j, Y') }}</time>
                        </p>
                    </div>
                </div>

            </address>
        </div>
        <div id="content" class="space-y-12 max-w-full">
            <h4 class="text-3xl font-extrabold text-gray-900 lg:text-4xl dark:text-white break-words">
                {{ $post->title }}</h4>
            <a href="/blog?category={{ $post->category->slug }}"
               title="Go to {{ $post->category->name }} category"
               class="{{ $post->category->color }} dark:bg-primary-200 dark:text-primary-800 hover:bg-primary-200 dark:hover:bg-primary-300 block w-fit items-center rounded px-2.5 py-2 text-xs font-medium text-gray-800 transition-all duration-300 ease-in-out hover:text-black no-underline">
                {{ $post->category->name }}
            </a>
            <div class="text-justify break-words">
                {!! $post->blog_content !!}
            </div>
        </div>
    </article>
@else
    <article
            class="flex h-full flex-col rounded-lg border border-gray-200 bg-white p-6 shadow-md transition-all duration-300 ease-in-out hover:scale-[1.025] dark:border-gray-700 dark:bg-gray-800">
        <div class="mb-2 flex items-center justify-between text-gray-500">
            <a href="/blog?category={{ $post->category->slug }}"
               class="{{ $post->category->color }} dark:bg-primary-200 dark:text-primary-800 hover:bg-primary-200 dark:hover:bg-primary-300 inline-flex items-center rounded px-2.5 py-2 text-xs font-medium text-gray-800 transition-all duration-300 ease-in-out hover:text-black"
               title="Go to {{ $post->category->name }} category">
                {{ $post->category->name }}
            </a>
            <span class="text-sm">{{ $post->created_at->format('F j, Y')  }}</span>
        </div>
        <h1
                class="mb-2 line-clamp-2 text-lg sm:text-xl lg:text-2xl font-bold tracking-tight text-gray-900 transition-all duration-300 ease-in-out hover:text-blue-500 dark:text-white">
            <a href="/blog/{{ $post->slug }}" title="Read {{ $post->title }}">{{ $post->title }}</a>
        </h1>
        <div class="mb-5 line-clamp-3 font-light text-gray-500 dark:text-gray-400">
            {!! $post['blog_content'] !!}
        </div>
        <div class="mt-auto flex items-center justify-between">
            <div class="flex items-center">
                <a href="/blog?author={{ $post->author->username }}"
                   title="Read more from {{ ucfirst($post->author->name) }}"
                   class="group flex items-center space-x-2">
                    <img class="h-7 w-7 rounded-full"
                         src="{{$post->author->avatar ? asset('storage/'.$post->author->avatar) : asset('img/default.png')}}"
                         alt="{{ ucfirst($post->author->name) }}'s avatar"/>
                    <span
                            class="font-medium transition-all duration-200 ease-in-out hover:text-blue-500 dark:text-white">
                {{ ucfirst(implode(' ', array_slice(explode(' ', $post->author->name), 0, 2))) }}
            </span>
                </a>
            </div>
            <a href="/blog/{{ $post->slug }}" title="Read more about {{ $post->title }}"
               class="text-primary-600 dark:text-primary-500 inline-flex items-center font-medium hover:underline">
                Read article
                <svg class="ml-2 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                          clip-rule="evenodd"></path>
                </svg>
            </a>
        </div>
    </article>
@endif
