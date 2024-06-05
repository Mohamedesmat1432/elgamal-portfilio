<div class="flex flex-col overflow-x-auto">
    <div class="sm:mx-6 lg:mx-8">
        <div class="inline-block min-w-full py-2 px-8">

            <div class="overflow-x-auto">
                <table class="table-fixed min-w-full text-center text-sm font-light text-surface">
                    <thead class="border-b border-neutral-200 font-medium">
                        {{ $thead ?? '' }}
                    </thead>
                    <tbody>
                        {{ $tbody ?? '' }}
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
