<ul class="nested">
    @foreach($childs as $child)
        <li>
            @if(count($child->childs))
                <span class="caret">
                    <a href="{{ route('categories.edit',$category->id)}}" class="btn me">
                        {{ ($child->id) . ". " . $child->category_name }}
                    </a>
                </span>
                @include('categories.category',['childs' => $child->childs])
            @else
                <a href="{{ route('categories.edit',$category->id)}}" class="btn me">
                    {{ ($child->id) . ". " . $child->category_name }}
                </a>
            @endif
        </li>
    @endforeach
</ul>
