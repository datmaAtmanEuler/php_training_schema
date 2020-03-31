<ul>
    @foreach($childs as $child)
        <li>
            {{ ($child->id) . ". " . $child->category_name }}
            @if(count($child->childs))
                @include('categories.category',['childs' => $child->childs])
            @endif
        </li>
    @endforeach
</ul>
