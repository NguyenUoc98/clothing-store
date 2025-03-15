

@foreach ($addresses as $address)
    <div class="address-item">
    <p>{{ $address['address'] }}</p>
        <button class="btn-change-address" data-address="{{ json_encode($address) }}">Chọn</button>
    </div>
@endforeach