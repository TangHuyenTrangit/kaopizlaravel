 @extends('admin.layout.index')
 @section('content')
  <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
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
                        <form action="admin/tintuc/them" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value=" {{ csrf_token()  }}" />
                            <div>
                                <label>Thể loại</label>
                                <select class="form-control" name="TheLoai" id="TheLoai">
                                    <option>
                                    @foreach($theloai as $tl)
                                    <option value= "{{$tl->id}}" > {{$tl->Ten}} </option>
                                    @endforeach
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại tin</label>
                                <select class="form-control" name="LoaiTin" id="LoaiTin">
                                    <option>
                                    @foreach($loaitin as $lt)
                                    <option value= "{{$lt->id}}" > {{$lt->Ten}} </option>
                                    @endforeach
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="TieuDe" placeholder="Hãy nhập tiêu đề" />
                            </div>
                            
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea class="form-control ckeditor" id="demo" name="TomTat" placeholder="Hãy nhập tóm tắt" rows="3"></textarea>
                            </div>
                             <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="form-control ckeditor" id="demo" name="NoiDung" placeholder="Hãy nhập nội dung" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label> Hình ảnh</label>
                                <input type="file" name="Hinh" class="form-control"  />
                            </div>
                            <div class="form-control">
                                <label> Tin nổi bật </label>
                                <label class="radio-inline"> 
                                  <input type="radio" name="NoiBat" value="0" checked="checked">Không
                                </label>   
                                 <label class="radio-inline"> 
                                  <input type="radio" name="NoiBat" value="1" >Có
                                </label>          
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
    @endsection
     @section('script')
    <script >
        $(document).ready(function()
        {
            $('#TheLoai').change(function()// sự kiện khi giá trị n thay đổi
                {
                    var idTheLoai=$(this).val();// lấy giá trị của n ra
                  
                    $.get("admin/ajax/loaitin/"+idTheLoai,function(data)
                    {
                        $("#LoaiTin").html(data);
                    })
                });
        });
        
    </script>
 @endsection