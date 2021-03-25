@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">	
                <h2>user</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('users.create') }} "> Create New user</a>
                 
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
    
  
    <table class="table table-bordered">
        
        <tr> 
            
            <th>no</th>
            <th>FirstName</th>
			<th>LastName</th>
            
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Country</th>
            <th>State</th>
            <th>City</th>
            <th>Zip-Code</th>
            <th>Gender</th>
            <th>Hobbies</th>
            <th>Image</th>
            <th width="280px">Action</th>
        </tr>
		@if (!$userdetail->isEmpty() ) 
        @foreach ($userdetail as $userdata)
	             <td>{{ ++$i }}</td>
                <td>{{ $userdata->FirstName }}</td>
                <td>{{ $userdata->LastName }}</td>
                
                 <td>{{ $userdata->Email }}</td>
                <td>{{ $userdata->Phone }}</td>
				<td>{{ $userdata->Address }}</td>
                <td>{{ $userdata->Country }}</td>
                
                <td>{{ $userdata->State }}</td>
                <td>{{ $userdata->City }}</td>
                <td>{{ $userdata->ZipCode }}</td>
                <td>{{ $userdata->Gender }}</td>
                <td>{{ $userdata->Hobbies }}</td>
                <td><img src="{{ URL::to('/') }}/upload/{{ $userdata->Image }}" class="img-thumbnail" width="75" /></td></td>
                <td>
				
                    <form action="{{ route('users.destroy',$userdata->id) }}" method="POST">

                        <a class="btn btn-info" href="{{ route('users.show',$userdata->id) }}">Show</a>

                        <a class="btn btn-primary" href="{{ route('users.edit',$userdata->id) }}">Edit</a>
                     @csrf

                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');" >Delete</button>

                    </form>
                        
                </td>
            </tr>
        @endforeach
        @else
            <tr style="text-align: center"><td colspan="20">Data Not Found</td></tr>
        @endif
    </table>
    
    
@endsection
                
           
        
           