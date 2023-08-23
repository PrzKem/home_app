<!DOCTYPE html>
<html>
<head>
 @include('head')
 <script type="text/javascript" src="{{asset('js/tags.js')}}"></script>

</head>
<body>
  <div class="container mt-3">
    <div class="row">
      <!-- side bar nav -->
      @include('homeDevices/hd_nav_bar')
      <div class="col-sm-8">
        <!-- actual page in middle -->
          @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
          @endif
        <div class="row">
          <h2 class="col-sm-10">IoT Tags</h2>
          <button type="button" class="btn btn-success col-sm-2" onclick="showForm()">Add new</button>
        </div>
        <div class="row" style="visibility:hidden; display: none" id="formRow">
          <form class="form mt-3" action="{{url('hd/addTag')}}" method="POST">
            @CSRF
            <div class="row">
              <div class="col-sm-4"><input type="text" placeholder="Alias" class="form-control" id="alias" name="alias"></input></div>
              <div class="col-sm-4"><input type="number" placeholder="Value" class="form-control" id="value" name="value" min="0" max="1000" step="0.01"></input></div>
              <div class="col-sm-4"><button type="submit" class="btn btn-success">Add</button></div>
            </div>
          </form>
        </div>
        <table class="table">
            <thead>
                <th scope="col">ID</th>
                <th scope="col">Alias</th>
                <th scope="col">Value</th>
                <th scope="col">Actions</th>
            </thead>
            <tbody>
              @foreach ($tags as $tag)
                <tr>
                  <th scope="row">{{$tag->id}}</td>
                  <td>{{$tag->alias}}</td>
                  <td id="{{$tag->id}}">{{$tag->value}}</td>
                  <td>
                    <button type="button" class="btn" onclick="updateTag({{$tag->id}})"><i class="fa-solid fa-pen-to-square"></i></button>
                  </td>
                </tr>
              @endforeach
            </tbody>
        </table>
      </div>
    </div>
  </div>

</body>
</html>
