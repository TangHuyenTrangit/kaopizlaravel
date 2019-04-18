 @extends('admin.layout.index')
 @section('content')
  <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
                            <small>{{$tintuc->TieuDe}}</small>
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
                        <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value=" {{ csrf_token()  }}" />
                            <div>
                                <label>Thể loại</label>
                                <select class="form-control" name="TheLoai" id="TheLoai">
                                    <option>
                                    @foreach($theloai as $tl)
                                    <option 
                                     @if($tintuc->loaitin->theloai->id==$tl->id)
                                    {{"selected"}}
                                    @endif
                                    value= "{{$tl->id}}" > {{$tl->Ten}} </option>
                                    @endforeach
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Loại tin</label>
                                <select class="form-control" name="LoaiTin" id="LoaiTin">
                                    <option>
                                    @foreach($loaitin as $lt)
                                    <option
                                    @if($tintuc->loaitin->id==$lt->id)
                                    {{"selected"}}
                                    @endif


                                     value= "{{$lt->id}}" > {{$lt->Ten}} </option>
                                    @endforeach
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tiêu đề</label>
                                <input class="form-control" name="TieuDe" placeholder="Hãy nhập tiêu đề" value="{{$tintuc->TieuDe}}" />
                            </div>
                            
                            <div class="form-group">
                                <label>Tóm tắt</label>
                                <textarea class="form-control ckeditor" id="demo" name="TomTat" rows="3">{{$tintuc->TomTat}}</textarea>
                            </div>
                             <div class="form-group">
                                <label>Nội dung</label>
                                <textarea class="form-control ckeditor" id="demo" name="NoiDung"  rows="3">{{$tintuc->NoiDung}}</textarea>
                            </div>
                            <div class="form-group">
                                <label> Hình ảnh</label>
                                <p>
                                <img width="400px" src="upload/tintuc/{{$tintuc->Hinh}}" /> 
                                 </p>
                                <input type="file" name="Hinh" class="form-control"  />
                            </div>
                            <div class="form-control">
                                <label> Tin nổi bật </label>
                                <label class="radio-inline"> 
                                  <input type="radio" name="NoiBat" value="0" 
                                  @if($tintuc->NoiBat==0)
                                  {{"checked"}}

                                  @endif 
                                  type="radio">Không
                                </label>   
                                 <label class="radio-inline"> 
                                  <input type="radio" name="NoiBat" value="1"
                                  @if($tintuc->NoiBat==1)
                                  {{"checked"}}

                                  @endif 
                                  type="radio" >Có
                                </label>          
                            </div>
                            
                            
                            <button type="submit" class="btn btn-default">Add</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
                
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin tức
                            <small>danhsach</small>
                        </h1>
                    </div>
                    @if(session('thongbao'))
                        <div class="alert alert-success">
                            {{session('thongbao')}}
                        </div>
                    @endif
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Người dùng</th>
                                <th> Nội dung</th>
                                <th>Ngày đăng</th>
                                <th>Delete</th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($comment as $cm)
                                <tr class="odd gradeX" align="center">
                                    <td>{{$cm->id}}</td>
                                    <td> {{$cm->user->name}}</td>
                                    <td> {{$cm->NoiDung}}</td>
                                    <td>{{$cm->created_at}}</td>
                                    <td class="center">
                                        <i class="fa fa-trash-o  fa-fw"></i>
                                        <a href="admin/comment/xoa/{{$cm->id}}/{{$tintuc->id}}"> Delete</a></td>
                                </tr>
                           @endforeach
                        </tbody>
                    </table>
                </div>
                
            
            </div>
           
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