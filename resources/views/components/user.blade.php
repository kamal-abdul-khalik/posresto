<div class="items-center py-4 mb-3 -mt-3">
    <div class="flex items-center space-x-4">
        <div class="avatar">
            <x-tabler-chef-hat class="size-12" />
        </div>
        <div class="flex flex-col gap-y-1">
            <span class="font-semibold ">{{ auth()->user()->name }}</span>
            <span class="text-xs">{{ auth()->user()->email }}</span>
        </div>
    </div>
</div>
