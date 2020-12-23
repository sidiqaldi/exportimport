<div class="pl-3 pr-4 py-3 flex items-center justify-between text-sm">
    <div class="w-0 flex-1 flex items-center">
        <div class="ml-2 flex-1 w-0 truncate">
            <span class="font-medium text-gray-500 mr-3">{{ $export->created_at->format('d/m/Y H:i') }}</span>{{ $export->filename ?? 'unknown' }}
        </div>
    </div>
    <div class="ml-4 flex-shrink-0">
        @if($export->status == "processing")
        <span class="animate-pulse font-medium text-indigo-600 hover:text-indigo-500">
            Processing
        </span>

        @else
            <a href="{{ route('exports.show', $export->id) }}" class="font-medium text-green-500 hover:text-green-500">
                Download
            </a>
        @endif
    </div>
</div>
