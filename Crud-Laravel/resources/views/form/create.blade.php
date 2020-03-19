@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            
                <div class="card-header" center>ADD NEW FORMS</div><br>

                <div class="card-body">
                    <form method="POST" action="{{ route('form.store') }}">


                        <div class="form-group row">
                            <label for="title" class="col-md-4 col-form-label text-md-right">Title</label>

                            <div class="col-md-6">
                                <input id="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>

                                @if ($errors->has('title'))
                                        <strong>{{ $errors->first('title') }}</strong>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="desc" class="col-md-4 col-form-label text-md-right">Desc</label>

                            <div class="col-md-6">
                                <textarea name="desc" cols="50" rows="5"  value="{{ old('desc') }}"></textarea>

                                @if ($errors->has('desc'))
                                        <strong>{{ $errors->first('desc') }}</strong>
                                @endif
                            </div>
                        </div>

                         <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-6">
                            
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                                <a href="{{ route('form.index') }}" class="btn btn-danger">Back</a>
                                {{csrf_field()}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection