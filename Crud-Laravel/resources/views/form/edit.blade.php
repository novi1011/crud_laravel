@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            
                <div class="card-header" center>EDIT FORMS</div><br>
                

                <div class="card-body">
                <form action="{{ route('update_FormFactory', $forms->id) }}" method="post">
                {{csrf_field()}}

                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                            <div class="col-md-6">
                                <input type="text" name="title" value="{{ $forms->title }}">

                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="desc" class="col-md-4 col-form-label text-md-right">Desc</label>

                            <div class="col-md-6">
                                <textarea name="desc" cols="50" rows="5">{{$forms->desc}}</textarea>

                                @if ($errors->has('desc'))
                                        <strong>{{ $errors->first('desc') }}</strong>
                                @endif
                            </div>
                        </div>

                         <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-6">
                            
                                <button type="submit" class="btn btn-warning">
                                    {{ __('Edit') }}
                                </button>
                               
                                {{csrf_field()}}
                                <input type="hidden" name="_method" value="PUT">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection