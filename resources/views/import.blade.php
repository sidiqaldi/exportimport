<x-guest-layout>
    <div class="py-40 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                {{ __('Import Data') }} | <a class="font-normal text-gray-400 underline" href="{{ route('exports.index') }}">go to Export</a>
            </h2>
            @error('upload_file')
                <div class="text-red-500">{{ $message }}</div>
            @enderror
            <div class="my-3" x-data="{ open: false }">
                <button x-show="!open"
                    class="inline-block rounded-lg font-medium leading-none py-2 px-3 focus:outline-none bg-indigo-50 text-indigo-700"
                    @click="open = true">
                    Request Import
                </button>

                <ul x-show="open" @click.away="open = false">
                    <form action="{{ route('imports.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">
                                    Upload:
                                </span>
                            </div>
                            <input type="file" name="upload_file" id="upload_file" class="focus:ring-indigo-500 focus:border-indigo-500 block w-full pl-20 pr-12 sm:text-sm border-gray-300 rounded-md" placeholder="reportjuni2020">
                            <div class="absolute inset-y-0 right-0 flex items-center mr-1">
                                <button class="inline-block rounded-lg font-medium leading-none py-2 px-3 focus:outline-none bg-indigo-50 text-indigo-700" type="submit">Request</button>
                            </div>
                          </div>
                    </form>
                </ul>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-4">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                    {{ __('Queue Import') }}
                </h2>
                <div>
                    @if ($imports->count())
                        <div class="border border-gray-200 rounded-md divide-y divide-gray-200">
                            @foreach($imports as $import)

                                <livewire:show-import :import="$import"/>

                            @endforeach
                        </div>
                        <div class="pt-3">
                            {{ $imports->links() }}
                        </div>
                    @else
                        no export data
                    @endif
                <div>
            </div>
        </div>
    </div>
</x-guest-layout>
