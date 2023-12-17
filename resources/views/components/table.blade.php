@props([
    'id' => uniqid(),
    'headings' => [],
    'data' => [],
    'actions' => [],
    'search' => true,
    'showHeader' => true,
    'showFooter' => false,
    'paging' => true,
    'perPage' => 10,
    'sortable' => true,
])


@php
    $data = collect($data)->map(function ($value, $index) use ($actions){
        if(empty($actions))
            return $value;

        $actionsButtons = array_map(function($action) use ($index){
            $url = route($action['name'], $action['data'][$index]);
            return Blade::render("<x-admin.{$action['type']}-button href='{$url}'>{$action['text']}</x-{$action['type']}-button>");
        }, $actions);
        $actionsCell = join(" ", $actionsButtons);
        $actionsCell = "<div class='flex flex-wrap gap-2'>{$actionsCell}</div>";


        return [...$value, $actionsCell];
    })
@endphp

<div class="max-w-full overflow-auto">
    <table id="{{ $id }}" class="w-full"></table>
</div>


<script>
    const data = {
        headings: {{ Js::from($headings) }},
        data: {{ Js::from($data) }}
    }

    window.addEventListener("load", () => {
        const table = document.getElementById("{{ $id }}");
        const dataTable = new DataTable(table, {
            data,
            searchable: {{ JS::from($search) }},
            locale: '{{ app()->getLocale() }}',
            header: {{ JS::from($showHeader) }},
            footer: {{ JS::from($showFooter) }},
            paging: {{ JS::from($paging) }},
            perPage: {{ $perPage }},
            sortable: {{ JS::from($sortable) }},

            labels: {
                placeholder: '{{ __("messages.search") }}',
                searchTitle: '{{ __("messages.search-in-table") }}',
                pageTitle: '{{ __("messages.page-number") }}',
                perPage: '{{ __("messages.per-page") }}',
                noRows: '{{ __("messages.no-rows") }}',
                noResults: '{{ __("messages.no-results") }}',
                info: '{{ __("messages.showing-records-from-to") }}'
            },

            classes: {
                top: 'flex justify-between items-center',
                wrapper: "min-w-[800px]"
            },
        });
    })
</script>

