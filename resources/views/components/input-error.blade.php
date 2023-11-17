{{-- @props(['for'])

@error($for)
    <p {{ $attributes->merge(['class' => 'text-sm text-red-600 dark:text-red-400']) }}>{{ $message }}</p>
@enderror --}}


@props(['for'])

@error($for)
    <div class="bg-red-100 border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ $message }}</span>
    </div>
@enderror
