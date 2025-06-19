@push('quil-style')
    <link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet"/>
@endpush

<div class="relative rounded-lg bg-white p-4 border sm:p-5 dark:bg-gray-800">
    <div class="mb-4 flex items-center justify-between rounded-t border-b pb-4 sm:mb-5 dark:border-gray-600">
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Edit Blog</h3>
    </div>
    <form class="space-y-4" action="/dashboard/{{ $post->slug }}" method="post" id="blog-form">
        @csrf
        @method('patch')
        <div>
            <label for="title"
                   class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Title</label>
            <input type="text" name="title" id="title"
                   class="@error('title') bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror focus:ring-primary-600 focus:border-primary-600 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300  p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                   placeholder="Type your blog title" value="{{old('title') ?? $post->title}}">
            @error('title')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <label for="category"
                   class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Category</label>
            <select
                id="category" name="category_id"
                class="@error('category_id') bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300  p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400">
                <option selected="" value="">Select Blog category</option>
                @foreach(App\Models\Category::get() as $category)
                    <option
                        value="{{ $category->id }}" @selected((old('category_id') ?? $post->category_id) == $category->id)>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="sm:col-span-2"><label for="blog_content"
                                          class="mb-2 block text-sm font-medium text-gray-900 dark:text-white">Content</label>
            <textarea id="blog_content" rows="4" name="blog_content"
                      class="hidden @error('blog_content') bg-red-50 border-red-500 text-red-900 placeholder-red-700 focus:ring-red-500 dark:bg-gray-700 focus:border-red-500 dark:text-red-500 dark:placeholder-red-500 dark:border-red-500 @enderror focus:ring-primary-500 focus:border-primary-500 dark:focus:ring-primary-500 dark:focus:border-primary-500 block w-full rounded-lg border border-gray-300  p-2.5 text-sm text-gray-900 dark:border-gray-600 dark:bg-gray-700 dark:text-white dark:placeholder-gray-400"
                      placeholder="Write blog content here">{{old('blog_content') ?? $post->blog_content}}</textarea>
            <div id="editor">
                {!! old('blog_content') ?? $post->blog_content !!}
            </div>
            @error('blog_content')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
            @enderror
        </div>
        <div class="ml-auto w-fit flex flex-wrap justify-center sm:justify-end items-center gap-2">
            <a href="/dashboard"
               class="inline-flex items-center rounded-lg bg-red-600 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-4 focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                <svg aria-hidden="true" class="-ml-1 mr-1.5 size-6" fill="currentColor" viewbox="0 0 20 20"
                     xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                          d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                          clip-rule="evenodd"/>
                </svg>
                Cancel
            </a>
            <button type="submit"
                    class="bg-primary-700 hover:bg-primary-800 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800 inline-flex items-center rounded-lg px-5 py-2.5 text-center text-sm font-medium text-white focus:outline-none focus:ring-4">
                <svg class="-ml-1 mr-1.5 size-6" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24"
                     height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="m14.304 4.844 2.852 2.852M7 7H4a1 1 0 0 0-1 1v10a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-4.5m2.409-9.91a2.017 2.017 0 0 1 0 2.853l-6.844 6.844L8 14l.713-3.565 6.844-6.844a2.015 2.015 0 0 1 2.852 0Z"/>
                </svg>
                Update blog
            </button>
        </div>
    </form>
</div>

@push('quil-js')
    <script src="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.js"></script>

    <script>
        const quill = new Quill('#editor', {
            theme: 'snow',
            placeholder: 'Write blog content here',
        });

        const blogForm = document.getElementById('blog-form');
        const blogContent = document.getElementById('blog_content');
        const quillEditor = document.getElementById('editor');

        blogForm.addEventListener('submit', function (e) {
            e.preventDefault();
            const content = quillEditor.children[0].innerHTML;
            blogContent.value = content;
            this.submit();
        });
    </script>
@endpush
