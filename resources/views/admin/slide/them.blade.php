 @extends('admin.layout.index')
 @section('content')
  <div id="page-wrapper">
            <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
                            <small>thêm</small>
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
                        <form action="admin/slide/them" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value=" {{ csrf_token()  }}" />
                           
                            
                            <div class="form-group">
                                <label>Tên</label>
                                <input class="form-control" name="Ten" placeholder="Hãy nhập tên" />
                            </div>
                         
                             <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="form-control ckeditor" id="demo" name="NoiDung" placeholder="Hãy nhập nội dung" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label> Hình ảnh</label>
                                <input type="file" name="Hinh" class="form-control"  />
                            </div>
                            <div class="form-group">
                                <label>Link</label>
                                <input class="form-control" name="link" placeholder="Hãy nhập Link" />
                            </div>
                            
                            
                            <button type="submit" class="btn btn-default">Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        </div>
    @endsection