<option value="{{ $category->id }}">{{ $text . $category->name }}</option>
@if ($category->childrenCategory)
    @foreach ($category->childrenCategory as $child)
        @include('admin.category.category', [
            'category' => $child,
            'text' => '->'. $text,
        ])
    @endforeach
@endif
