@extends('base')

@section('main')
    <div class="row">
        <div class="col-sm-8 offset-sm-2">
            <h1 class="display-3">{{ (isset($category) ? "Edit" : "Create") . " Category" }}</h1>
            <div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div><br />
                @endif
                <form method="post" action="{{ isset($category) ? route('categories.update', $category->id) :  route('categories.store') }}">
                    @if(isset($category))
                    @method('PATCH')
                    @endif
                    @csrf
                    <div class="row">
                        <div class="form-group col-6">
                            <label for="parent_id">Parent:</label>
                            <select class="form-control" name="parent_id">
                                <option value="">---- select ----</option>
                                @foreach($parent_list as $item)
                                    <option selected="{{isset($category) && $category->parent_id == $item->id}}" value="{{ $item->id }}">{{ $item->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-6">
                            <label for="category_name">Category:</label>
                            <input type="text" class="form-control" name="category_name" value="{{ isset($category) ? $category->category_name : '' }}" />
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary float-right">{{ isset($category) ? "Save" : "Create" }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
