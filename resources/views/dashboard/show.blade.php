<x-layout :title="$title">
    <div class="mx-auto mb-8 max-w-7xl shrink p-4 sm:p-6 lg:p-8 min-h-screen flex flex-col space-y-4">
        <div>
            <a class="text-lg font-medium text-blue-500 hover:underline underline-offset-2" href="/dashboard">&laquo; Back to all blogs</a>
        </div>
        <x-blogs.show :post="$post"/>
    </div>
</x-layout>
