@extends('base')
@section('main')
    <style>
        #myUL{
            max-width: 250px !important;
            overflow-y: auto !important;
            overflow-x: auto !important;
            min-height: 250px !important;
        }
        ul, li{
            list-style-type: none;
            width: max-content !important;
            margin-bottom: 5px !important;
            margin-top: 5px !important;
        }
        .grid-area{
            display: inline-flex;
            max-height: 400px;
            overflow-y: auto;
        }
        ul, #myUL {
            list-style-type: none;
        }

        #myUL {
            margin: 0;
            padding: 0;
        }
        .caret {
            cursor: pointer;
            -webkit-user-select: none; /* Safari 3.1+ */
            -moz-user-select: none; /* Firefox 2+ */
            -ms-user-select: none; /* IE 10+ */
            user-select: none;
        }
        .caret::before {
            content: "\25B6";
            color: black;
            display: inline-block;
            margin-right: 6px;
        }

        .caret-down::before {
            -ms-transform: rotate(90deg); /* IE 9 */
            -webkit-transform: rotate(90deg); /* Safari */'
        transform: rotate(90deg);
        }

        .nested {
            display: none;
        }

        .active {
            display: block;
        }
        .btn.me:hover{
            color: #3e2bad;
        }
        .btn.me{
            color: #110c30;
        }

    </style>
    @include('flash-message')
    <div class="pt-3 row">
        <div class="col-sm-3 border border-top-0 border-bottom-0 border-left-0">
            <h3>Categories Tree</h3>
            <ul id="myUL">
                @foreach($categoriesTreeData as $category)
                    <li>
                        @if(count($category->childs))
                            <span class="caret">
                                <a href="{{ route('categories.edit',$category->id)}}" class="btn me">
                                {{ ($category->id) . ". " . $category->category_name }}
                                </a>
                            </span>
                            @include('categories.category',['childs' => $category->childs])
                        @else
                            <a href="{{ route('categories.edit',$category->id)}}" class="btn me">
                                {{ ($category->id) . ". " . $category->category_name }}
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-sm-9">
            <h3>Categories List</h3>
            <a href="{{ route('categories.create')}}" class="btn float-right mb-2"><i class="fa fa-2x fa-plus" title="Create"></i></a>
            <div class="grid-area">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <td>#ID</td>
                        <td>Category Name</td>
                        <td>Parent Name</td>
                        <td>Children</td>
                        <td colspan = 2></td>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <td>{{$category->id}}</td>
                            <td>{{$category->category_name}}</td>
                            <td>{{$parentsList[$loop->index]}}</td>
                            <td>{{$childsList[$loop->index]}}</td>
                            <td>
                                <a href="{{ route('categories.edit',$category->id)}}" class="btn"><i class="fa fa-pencil" title="Edit"></i></a>
                            </td>
                            <td>
                                @if(strlen($childsList[$loop->index]) < 1)
                                    <form action="{{ route('categories.destroy', $category->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn" type="submit"><i class="fa fa-trash" title="Delete"></i></button>
                                    </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row justify-content-center">
                {{ $categories->render("pagination::bootstrap-4") }}
            </div>
        </div>
    </div>
@endsection
