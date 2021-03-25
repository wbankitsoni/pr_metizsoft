@extends('layouts.app')
   
@section('content')
<div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit user</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('users.index') }}"> Back</a>
            </div>
        </div>
</div>
<form action="{{ route('users.update',$edit_userdetail->id) }}" method="POST" id="frmAdd" enctype="multipart/form-data">
        @csrf
        @method('PUT')
   
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>First Name:</strong>
                    <input type="text" name="FirstName" class="form-control" placeholder="FirstName" value="{{ $edit_userdetail->FirstName }}">
                </div>
            </div>
             <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Last Name:</strong>
                    <input type="text" name="LastName" class="form-control" placeholder="LastName"  value="{{ $edit_userdetail->LastName }}">
                </div>
            </div>
             
             <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Email:</strong>
                    <input type="email" name="Email" class="form-control" placeholder="Email" value="{{ $edit_userdetail->Email }}">
                </div>
            </div>
               <div class="col-xs-12 col-sm-12 col-md-12">
                            

                            <div class="form-group">
                               <strong>Password:</strong>
                                <input id="password" type="password" class="form-control">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                         <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group ">
                            <strong>Confirm Password:</strong>

                            
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

             <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Phone:</strong>
                    <input type="text" name="Phone" class="form-control" placeholder="Phone" value="{{ $edit_userdetail->Phone }}">
                </div>
            </div>
             <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Address:</strong>
                    <input type="text" name="Address" class="form-control" placeholder="Address" value="{{ $edit_userdetail->Address }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
               <div class="form-group">
                 <label for="title"> Country:</label>
                <select id="country" name="Country" class="form-control" >
                  <option value="" selected disabled>Select</option>
                  @foreach ($countries as $country)
                  <option value="{{ $country->id }}" {{ $country->id == $edit_userdetail->Country ? 'selected' : '' }}>{{ $country->c_name }}</option>
                  
                  @endforeach
                </select>


                  
                 
              </div>
            <div class="form-group">
                <label for="title"> State:</label>
                <select name="State" id="state" class="form-control" >
                 @foreach ($states as $state)
                <option value="{{ $state->id }}"{{ $state->id == $edit_userdetail->State ? 'selected' : ''}}>{{ $state->s_name }}</option>
                @endforeach
                </select>
            </div>
         
            <div class="form-group">
                <label for="title"> City:</label>
                <select name="City" id="city" class="form-control">
                    @foreach ($cities as $city)
                <option value="{{ $city->id }}" {{ $city->id == $edit_userdetail->City ? 'selected' : ''}}>{{ $city->ci_name }}</option>
                @endforeach
                </select>
            </div>
             <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>ZipCode:</strong>
                    <input type="text" name="ZipCode" class="form-control" placeholder="ZipCode" value="{{ $edit_userdetail->ZipCode }}">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
               <div class="form-group">
                  <strong>Gender:</strong>
                 <input type="radio" name="Gender"  value="male" {{ $edit_userdetail->Gender == 'male' ? 'checked' : ''}}>Male
                <input type="radio" name="Gender"  value="female" {{ $edit_userdetail->Gender == 'female' ? 'checked' : ''}}>female
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                  <strong>Hobbies:</strong>
                 <div class="form-group">
                    <label><input type="checkbox" value="Cricket"{{ in_array('Cricket', $user_hobby) ? 'checked' : '' }} name="Hobbies[]" >Cricket</label>

                    <label><input type="checkbox" value="Basketball"{{ in_array('Basketball', $user_hobby) ? 'checked' : '' }} name="Hobbies[]" >Basketball</label>
         
                    <label><input type="checkbox" value="Football"{{ in_array('Football', $user_hobby) ? 'checked' : '' }} name="Hobbies[]" >Football</label>
                 </div>
            </div>
      <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong> image:</strong>
                 <input type="file"  name= "Image" id="upload" class="form-control">
                 <img src="{{ URL::to('/') }}/upload/{{ $edit_userdetail->Image }}" class="img-thumbnail" width="100" />
               <input type="hidden" name="hidden_image" value="{{ $edit_userdetail->Image }}" />
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
          <button type="submit" class="btn btn-primary">Submit</button>
        
        </div>


    </form>
  <link rel="stylesheet" href="//www.codermen.com/css/bootstrap.min.css">  
  <script src=//www.codermen.com/js/jquery.js></script>
   <script type=text/javascript>
  $('#country').change(function(){
  var countryID = $(this).val();  
  if(countryID){
    $.ajax({
      type:"GET",
      url:"{{url('get-state-list')}}?country_id="+countryID,
      success:function(res){        
      if(res){
        $("#state").empty();
        $("#state").append('<option>Select</option>');
        $.each(res,function(key,value){
          $("#state").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#state").empty();
      }
      }
    });
  }else{
    $("#state").empty();
    $("#city").empty();
  }   
  });
  $('#state').on('change',function(){
  var stateID = $(this).val();  
  if(stateID){
    $.ajax({
      type:"GET",
      url:"{{url('get-city-list')}}?state_id="+stateID,
      success:function(res){        
      if(res){
        $("#city").empty();
        $.each(res,function(key,value){
          $("#city").append('<option value="'+key+'">'+value+'</option>');
        });
      
      }else{
        $("#city").empty();
      }
      }
    });
  }else{
    $("#city").empty();
  }
    
  });
</script>

 
   @endsection

   <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js"></script>

  
  
 <!-- jQuery Form Validation code -->
<script>
        $(document).ready(function() {
            $("#frmAdd").validate({
                rules: {
                    firstName: {
                        required: true,
                        maxlength: 20,
                    },
                    lastName:{
                        required: true,
                        maxlength: 20,
                    },
                    email: {
                        required: true,
                        email: true,
                        maxlength: 50
                    },
                    phone: {
                        required: true,
                        minlength: 10,
                        maxlength: 10,
                        number: true
                    },
                    password: {
                        required: true,
                        minlength: 5
                    },
                    confirmPassword: {
                        required: true,
                        equalTo: "#password"
                    },
                    gender: {
                        required: true,
                    },
                    address: {
                        required: true,
                        maxlength: 50
                    },
                    city: {
                        required: true,
                        maxlength: 40
                    },
                    state: {
                        required: true,
                        maxlength: 40
                    },
                    zipcode: {
                        required: true,
                        minlength: 6,
                        maxlength: 6
                    }
                },
                messages: {
                    firstName: {
                        required: "First name is required",
                        maxlength: "First name cannot be more than 20 characters"
                    },
                    lastName: {
                        required: "Last name is required",
                        maxlength: "Last name cannot be more than 20 characters"
                    },
                    email: {
                        required: "Email is required",
                        email: "Email must be a valid email address",
                        maxlength: "Email cannot be more than 50 characters",
                    },
                    phone: {
                        required: "Phone number is required",
                        minlength: "Phone number must be of 10 digits"
                    },
                    password: {
                        required: "Password is required",
                        minlength: "Password must be at least 5 characters"
                    },
                    confirmPassword: {
                        required:  "Confirm password is required",
                        equalTo: "Password and confirm password should same"
                    },
                    gender: {
                        required:  "Please select the gender",
                    },
                    
                    address: {
                        required: "Address is required",
                        maxlength: "Address cannot not be more than 50 characters"
                    },
                    city: {
                        required: "City is required",
                        maxlength: "City cannot be more than 40 characters"
                    },
                    state: {
                        required: "State is required",
                        maxlength: "City cannot be more than 40 characters"
                    },
                    zipcode: {
                        required: "Zipcode is required",
                        minlength: "Zipcode must be of 6 digits",
                        maxlength: "Zipcode cannot be more than 6 digits"
                    } 
                }
            });
        });
    </script>