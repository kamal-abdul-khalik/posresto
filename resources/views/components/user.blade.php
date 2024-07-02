<div class="items-center py-4 mb-3 -mt-3">
    <div class="flex items-center space-x-4">
        <div class="avatar">
            <div class="w-16 rounded-full">
                <img src="https://img.daisyui.com/images/stock/photo-1534528741775-53994a69daeb.jpg" />
            </div>
        </div>
        <div class="flex flex-col gap-y-1">
            <span class="font-semibold ">{{ auth()->user()->name }}</span>
            <span class="text-xs">{{ auth()->user()->email }}</span>
        </div>
    </div>
</div>
