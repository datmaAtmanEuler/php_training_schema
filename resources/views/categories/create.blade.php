@extends('base')

@section('main')
    <div class="row">
        <div class="col-sm-12">
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
                        <div class="col-10">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="parent_id">Parent:</label>
                                    <select class="form-control" name="parent_id">
                                        <option value="">---- select ----</option>
                                        @foreach($parent_list as $item)
                                            @if(isset($category) && $category->parent_id == $item->id)
                                                <option selected value="{{ $item->id }}">{{ $item->category_name }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->category_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-6">
                                    <label for="category_name">Category:</label>
                                    <input type="text" class="form-control" name="category_name" value="{{ isset($category) ? $category->category_name : '' }}" />

                                </div>
                            </div>
                        </div>
                        <div class="col-2 float-right">
                            <button type="submit" class="btn">
                                @if(isset($category))
                                    <i class='fa fa-2x fa-pencil' title="Save"></i>
                                @else
                                    <i class='fa fa-2x fa-plus' title="Create"></i>
                                @endif
                            </button>
                            <a href="{{ route('categories.index')}}" class="btn">
                                <i class='fa fa-2x fa-home' title="Categories list"></i>
                            </a>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
@endsection
