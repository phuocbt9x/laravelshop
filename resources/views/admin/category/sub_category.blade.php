<option value="{{ $children->id }}">{{ $level . ' ' . ucfirst($children->name) }}</option>
@if ($children->childrenCategories)
    @php
        $newLevel = $level . '---';
    @endphp
    @foreach ($children->childrenCategories as $child)
        @include('admin.category.sub_category', [
            'children' => $child,
            'level' => $newLevel,
        ])
    @endforeach
@endif
