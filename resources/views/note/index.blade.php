<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>notes</title>
</head>
<body>
    
    <div class="row">
    @foreach ($notes as $item)
    <div class="col-4">
        <div class="card mb-2">
            <h1>{{$ms}}</h1>
            <h3 class="card-title">{{$item->title}}</h3>
            <div class="card-body">
                <p>{{Str::limit($item->note, 50, '...') }}</p>
            </div>
            <div class="card-items">
                <div class="card-item">
                    <a class="btn btn-primary" href="{{$item->id}}">  View</a>
                    <button  class="btn btn-success"> Edit</button>
                    <a class="btn btn-danger" > Delete</a>
                </div>
            </div>


        </div>
    </div>
    @endforeach
</div>
</body>
</html>