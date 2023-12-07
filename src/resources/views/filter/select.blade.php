<select class="form-control" data-column="5">
    <option value="">All</option>
    @foreach($options as $option)
        <option value="{{ $option }}" {{ $option == $selected ? 'selected' : '' }}>{{ $option }}</option>
    @endforeach
</select>
