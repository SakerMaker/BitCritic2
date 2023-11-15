<div class="md:col-span-1 flex justify-between">
    <div class="p-4 border-bottom border-white">
        <h3 class="text-lg font-medium fw-bolder">{{ $title }}</h3>

        <p class="m-0 mt-1 text-sm text-gray-600">
            {{ $description }}
        </p>
    </div>

    <div class="px-4 sm:px-0">
        {{ $aside ?? '' }}
    </div>
</div>
