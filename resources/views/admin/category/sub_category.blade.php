@empty($categoryModel)
    <option value="{{ $children->parent_id }}">{{ $level . ' ' . ucfirst($children->name) }}</option>
@else
    <option @selected($categoryModel->parent_id == $children->id) value="{{ $children->id }}">{{ $level . ' ' . ucfirst($children->name) }}
    </option>
@endempty
@if ($children->childrenCategories)
    @php
        $newLevel = $level . '---';
    @endphp
@empty($categoryModel)
    @foreach ($children->childrenCategories as $child)
        @include('admin.category.sub_category', [
            'children' => $child,
            'level' => $newLevel,
        ])
    @endforeach
@else
    @foreach ($children->childrenCategories as $child)
        @include('admin.category.sub_category', [
            'children' => $child,
            'level' => $newLevel,
            'categoryModel' => $categoryModel,
        ])
    @endforeach
@endif

@endif
