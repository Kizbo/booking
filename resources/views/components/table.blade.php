<table class="w-full shadow-xl shadow-gray-200">
    <thead>
        <tr class="bg-gray-200">
            @foreach($table_headings as $heading)
                <th>{{ str_replace('_',' ', $column_aliases[$heading] ?? $heading ) }}</th>
            @endforeach
        </tr>
    </thead>
</table>
