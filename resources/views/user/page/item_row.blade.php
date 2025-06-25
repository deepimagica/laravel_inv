@php $index = request('index', 0); @endphp
<tr>
    <td>
        <input type="text" name="items[{{ $index }}][product]" class="form-control" placeholder="Product Name">
        <span class="text-danger error-text" data-name="items.{{ $index }}.product"></span>
    </td>
    <td>
        <input type="text" name="items[{{ $index }}][hsn]" class="form-control" placeholder="HSN Code">
        <span class="text-danger error-text" data-name="items.{{ $index }}.hsn"></span>
    </td>
    <td>
        <input type="text" name="items[{{ $index }}][design]" class="form-control" placeholder="Design">
        <span class="text-danger error-text" data-name="items.{{ $index }}.design"></span>
    </td>
    <td>
        <input type="number" name="items[{{ $index }}][quantity]" class="form-control calc text-end" >
        <span class="text-danger error-text" data-name="items.{{ $index }}.quantity"></span>
    </td>
    <td>
        <input type="number" name="items[{{ $index }}][rate]" class="form-control calc text-end" >
        <span class="text-danger error-text" data-name="items.{{ $index }}.rate"></span>
    </td>
    <td>
        <input type="text" name="items[{{ $index }}][amount]" class="form-control subtotal text-end bg-light"  readonly>
        <span class="text-danger error-text" data-name="items.{{ $index }}.amount"></span>
    </td>
    <td class="text-center">
        <button type="button" class="btn btn-sm btn-outline-danger remove-row"><i class="fas fa-trash"></i></button>
    </td>
</tr>
