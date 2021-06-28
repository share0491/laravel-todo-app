<x-dropdown>
    <x-slot name="trigger">
        <button @click="show = ! show" class="flex-1 appearance-none bg-transparent py-2 pl-3 pr-9 text-sm font-semibold w-full lg:w-32 text-left flex lg:inline-flex">
            {{ isset($currentCategory) ? ucwords($currentCategory->name) : 'Categories'}}

            <x-down-arrow class="absolute pointer-events-none" style="right: 12px;"/>

        </button>
    </x-slot>

    <x-dropdown-item href="/">All</x-dropdown-item>

    @foreach ($categories as $category)

    <x-dropdown-item
    href="/?category={{$category->slug}}"
        :active="isset($currentCategory) && $currentCategory->is($category)">
        {{ ucwords($category->name) }}</x-dropdown-item>
    @endforeach
</x-dropdown>