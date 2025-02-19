@php
    $value = null;
    if (isset($category1) && $category1 != null){
        $count=count($category1);
    }else{
        $count=0;
    }
    for ($i=0; $i < $count; $i++){
        $value .= isset($category1[$i])?$category1[$i]:'';
        $value .= isset($category1[$i])?' >>':'';
    }

@endphp
<option value="{{ $child_category->id }}">{{ $value." ".$child_category->name }}</option>
@if ($child_category->categories)
    @foreach ($child_category->categories as $childCategory)
        @php
            $category1[]=$child_category->name;
        @endphp
        @include('admin.category.child_category', ['child_category' => $childCategory,'category' => $category])
        @php
            array_pop($category1);
        @endphp
    @endforeach
@endif
