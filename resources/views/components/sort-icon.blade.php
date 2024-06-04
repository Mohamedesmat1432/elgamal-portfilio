@props(['sort_by', 'sort_dir', 'field'])

@if ($sort_by == $field)
    <x-icon class="w-4 h-4" name="{{ $sort_dir ? 'arrow-small-up' : 'arrow-small-down' }}" />
@endif
