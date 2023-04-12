@extends('layouts.app')

@section('content')
<div class="container">
<form action="{{ route('create_event') }}" method="POST" enctype="multipart/form-data">
	@csrf
	<div class="row">

	 <div class="mb-3">
	    <label for="name" class="form-label">Enter Name</label>
	    <input type="text" class="form-control" name="name" value="{{ old('description') }}"  id="name" placeholder="Name">
	    @error('name')
	        <div class="alert alert-danger">{{ $message }}</div>
	    @enderror
	  </div>
	</div>
	<div class="row">
	<div class="mb-3">
	    <label for="Description" class="form-label">Description</label>
	    <textarea class="form-control" name="description">{{ old('description') }}</textarea>
		@error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
	  </div>
	</div>
	<div class="row">
	<div class="mb-3">
		
		   <label for="Type" class="form-label">Type</label>
		<select class="form-control" name="type">
			<option value="">Choose Type</option>
			@foreach($types as $type)
				<option value="{{ $type->id }}"  @if(old('type') == $type->id) {{ 'selected' }} @endif >{{ $type->name }}</option>
			@endforeach
		</select>
		@error('type')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
	</div>
</div>
<div class="row">
	<div class="mb-3">
		
		 <label for="Image" class="form-label">Image</label>
		<input type="file" class="form-control" name="event_image" accept="image/png, image/gif, image/jpeg, image/jpg" id="product-image">
		@error('event_image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
	</div>
</div>
<div class="row">
	<div class="mb-3">

		<input  type="submit" class="btn btn-primary"> 
	</div>
</div>
</form>
<a href="{{ route('home') }}"><button class="btn btn-danger">Cancel</button></a>
</div>
@endsection