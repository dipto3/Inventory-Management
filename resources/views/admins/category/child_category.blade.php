@php
    $value = '';
    if (!empty($category1)) {
        $count = count($category1);
        for ($i = 0; $i < $count; $i++) {
            $value .= isset($category1[$i]) ? $category1[$i] : '';
            $value .= isset($category1[$i]) ? ' >> ' : '';
        }
    }
@endphp

<option value="{{ $child_category->id }}"
    {{ isset($selectedCategories) && in_array($child_category->id, $selectedCategories) ? 'selected' : '' }}>
    {{ $value . " " . $child_category->name }}
</option>

@if ($child_category->categories)
    @foreach ($child_category->categories as $childCategory)
        @php
            $category1[] = $child_category->name;
        @endphp
        @include('admin.category.child_category', [
            'child_category' => $childCategory,
            'category1' => $category1,
            'selectedCategories' => $selectedCategories ?? []
        ])
        @php
            array_pop($category1);
        @endphp
    @endforeach
@endif
