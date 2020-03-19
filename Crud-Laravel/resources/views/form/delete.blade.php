@foreach($forms as $form)
		<li> 
		<a href="./form/{{$forms->id}}"> {{$forms->title}}</a> 
		<form action="{{route('delete_FormFactory', $forms->id)}}" method="post"><br>
		
		<input type="submit" name="submit" value="delete">
		
		{{csrf_field()}}
		<input type="hidden" name="_method" value="DELETE">
		
		
	</form>
		</li>
	@endforeach
	{{ $forms->links() }}
@endsection

