@extends('base')
@section('main')
    <style>
        #tree1{
            width: 250px !important;
            overflow-x: auto !important;
            overflow-y: auto !important;
            height: 250px !important;
        }
    </style>
    <div class="pt-3 row">
        <div class="col-sm-3 border border-top-0 border-bottom-0 border-left-0">
            <h3>Categories Tree</h3>
            <ul id="tree1">
                @foreach($categoriesTreeData as $category)
                    <li>
                        {{ $category->category_name }}
                        @if(count($category->childs))
                            @include('categories.category',['childs' => $category->childs])
                        @endif
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="col-sm-9">
            <h3>Categories List</h3>
            <a href="{{ route('categories.create')}}" class="btn btn-success float-right mb-2">Create</a>
            <table class="table table-striped">
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
                        <td>{{$category->parent_name}}</td>
                        <td>{{$category->children}}</td>
                        <td>
                            <a href="{{ route('categories.edit',$category->id)}}" class="btn btn-primary">Edit</a>
                        </td>
                        <td>
                            @if(strlen($category->children) < 1)
                                <form action="{{ route('categories.destroy', $category->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger" type="submit">Delete</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="row justify-content-center">
                {{ $categories->render("pagination::bootstrap-4") }}
            </div>
            <div>
            </div>
@endsection
