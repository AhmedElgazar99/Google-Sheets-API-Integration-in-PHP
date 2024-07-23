<x-bootlayout>

    @if (session()->has('success'))
    <div class="alert alert-primary" role="alert">
        {{session()->get('success')}}

    </div>        
    @endif


<form action="{{ route('contact.send')}}" method="POST" enctype="multipart/form-data">
   @csrf
    <div class="mb-3">
        <label for="formFile" class="form-label">name  </label>
        <input class="form-control" type="text" name="name" id="formFile" required>
      </div>
      <div class="mb-3">
        <label  class="form-label">subject  </label>
        <input class="form-control" type="text" name="subject"required>
      </div>
      <div class="mb-3">
        <label  class="form-label">email  </label>
        <input class="form-control" type="email" name="email" required>
      </div>
      
      <div class="from-group">
      <label  class="form-label">message  </label>
        <textarea class="form-control" rows="5" name="msg" required></textarea>
      </div>

      <div><input type="submit" value="send"  class="btn btn-primary"></div>
     

      
      

</form>
</x-bootlayout>
