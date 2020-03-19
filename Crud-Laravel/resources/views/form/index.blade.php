@extends('layouts.app')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-confirmation/1.0.5/bootstrap-confirmation.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

            
                <div class="panel-heading">Forms &nbsp &nbsp
                    <a href="{{ route ('form.create')}}" class="btn btn-success btn-sm">Add New</a>
                    <button  class="btn btn-danger delete_all btn-sm" data-url="{{ url('myproductsDeleteAll') }}">Delete All Selected</button>
                        
    
                    <!-- <a href="#" class="btn btn-primary btn-sm">Order</a> -->

                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                        <br>

                        <nav class="navbar navbar-light bg-light">
                            <form class="form-inline">
                                <input class="form-control mr-sm-2" name="cari" type="search" placeholder="Search" aria-label="Search">
                                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                            </form>
                            </nav>
                
                        </div>  
                    </div>
                </div>
                   

                </div>

                <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th width="50px"><input type="checkbox" id="master"></th>
                        <th>Title</th>
                        <th>Desc</th>
                        <th>Created At</th>
                        <th>Updated At</th>
                        <th>Actions</th>
                    </tr>
                    @if($forms->count())
                    @foreach($forms as $item)
                    <tr id="tr_{{$item->id}}"> 
                        <td><input type="checkbox" class="sub_chk" data-id="{{$item->id}}"></td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->desc}}</td>
                        <td>{{$item->created_at}}</td>
                        <td>{{$item->updated_at}}</td>
                        <td>
                        <form method="post" action="{{ route('form.destroy', $item->id)}}">
                            {{method_field('Delete')}}
                            {{csrf_field()}}
                        <a href="{{route('form.show', $item->id)}}" class="btn btn-warning btn-sm">View</a>
                        <a href="{{ route('form.edit', $item->id)}}" class="btn btn-primary btn-sm">Edit</a>
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('apakah mau dihapus?')">Delete</button>
                        </form>
                        </td>
                    </tr>
                    @endforeach
                    @endif
                </table>
                   
                </div>
            </div>
            {{$forms->links()}}
            </forms>
        </div>
    </div>
</div>
@endsection

<script type="text/javascript">
    $(document).ready(function () {
        $('#master').on('click', function(e) {
         if($(this).is(':checked',true))  
         {
            $(".sub_chk").prop('checked', true); 
         } else {  
            $(".sub_chk").prop('checked',false); 
         }  
        });

        $('.delete_all').on('click', function(e) {
            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  

            if(allVals.length <=0)  
            {  
                alert("Please select row."); 
            }  else {  
                var check = confirm("Are you sure you want to delete this row?"); 
                if(check == true){  
                    var join_selected_values = allVals.join(","); 

                    $.ajax({
                        url: $(this).data('url'),
                        type: 'DELETE',
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        data: 'ids='+join_selected_values,
                        success: function (data) {
                            if (data['success']) {
                                $(".sub_chk:checked").each(function() {  
                                    $(this).parents("tr").remove();
                                });
                                alert(data['success']);
                            } else if (data['error']) {
                                alert(data['error']);
                            } else {
                                alert('Whoops Something went wrong!!');
                            }
                        },
                        error: function (data) {
                            alert(data.responseText);
                        }
                    });

                  $.each(allVals, function( index, value ) {
                      $('table tr').filter("[data-row-id='" + value + "']").remove();
                  });
                } 
            }  
        });

        $('[data-toggle=confirmation]').confirmation({
            rootSelector: '[data-toggle=confirmation]',
            onConfirm: function (event, element) {
                element.trigger('confirm');
            }
        });

        $(document).on('confirm', function (e) {
            var ele = e.target;
            e.preventDefault();

            $.ajax({
                url: ele.href,
                type: 'DELETE',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function (data) {
                    if (data['success']) {
                        $("#" + data['tr']).slideUp("slow");
                        alert(data['success']);
                    } else if (data['error']) {
                        alert(data['error']);
                    } else {
                        alert('Whoops Something went wrong!!');
                    }
                },
                error: function (data) {
                    alert(data.responseText);
                }
            });
            return false;
        });
    });
</script>
