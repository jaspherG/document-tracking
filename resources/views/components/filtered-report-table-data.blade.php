@if(isset($table_data) && count($table_data) > 0)
    @foreach($table_data as $key => $data)
        <tr>
            <td class="ps-4">
                <p class="text-xs font-weight-bold mb-0">{{ $key + 1 }}</p>
            </td>
            <td class="text-center">
                <p class="text-xs font-weight-bold mb-0">{{ $data['student_number'] }}</p>
            </td>
            <td class="text-center">
                <p class="text-xs font-weight-bold mb-0">{{ $data['name'] }}</p>
            </td>
            @if(isset($data['documents']))
                @foreach($data['documents'] as $document)
                    <td class="text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $document }}</p>
                    </td>
                @endforeach
            @endif
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="4">No records found</td>
    </tr>
@endif