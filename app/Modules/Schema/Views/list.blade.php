@foreach ($schema as $item)
    @php
        $data = json_decode($item['value']);
        echo '<pre style="color:red">';
        print_r($data);
        echo '</pre>';
    @endphp
@endforeach