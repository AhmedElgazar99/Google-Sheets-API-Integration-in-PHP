<x-bootlayout>

    @if (session()->has('success'))
    <div class="alert alert-primary" role="alert">
        {{session()->get('success')}}

    </div>        
    @endif


<form action="{{ route('photo.upload')}}" method="POST" enctype="multipart/form-data">
   @csrf
    <div class="mb-3">
        <label for="formFile" class="form-label">upload your file  </label>
        <input class="form-control" type="file" name="img" id="formFile">
      </div>
      <input type="submit" value="upload" name="submit" class="btn btn-primary">
      
      

</form>
</x-bootlayout>
