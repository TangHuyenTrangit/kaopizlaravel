 @extends('admin.layout.index')
 @section('content')
  <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
                            <small>{{$slide->Ten}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                         @if(count($errors)>0)
                        <div class="alert alert-danger">
                            @foreach($errors->all() as $err)
                            {{$err}}<br>
                            @endforeach
                        </div>
                    @endif
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                        <form action="admin/slide/sua/{{$slide->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value=" {{ csrf_token()  }}" />
                            <div>
                                <label>Tên</label>
                                  <input class="form-control" name="Ten" placeholder="Hãy nhập tên" value="{{$slide->Ten}}" />
                            </div>
                            
                            <div class="form-group">
                                <label>Nội dung</label>
                                <input class="form-control" name="NoiDung" placeholder="Hãy nhập nội dung" value="{{$slide->NoiDung}}" />
                            </div>
                             <div class="form-group">
                                <label> Hình ảnh</label>
                                <p>
                                <img width="400px" src="upload/slide/{{$slide->Hinh}}" /> 
                                 </p>
                                <input type="file" name="Hinh" class="form-control"  />
                            </div>
                             <div class="form-group">
                                <label>Link</label>
                                <input class="form-control" name="link" placeholder="Hãy nhập link" value="{{$slide->link}}" />
                            </div>
                            <button type="submit" class="btn btn-default">Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
              
           
                
             
                
            
            </div>
           
        </div>
</div>
@endsection

