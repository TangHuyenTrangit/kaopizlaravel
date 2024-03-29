 @extends('admin.layout.index')
 @section('content')
 <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Loại Tin
                            <small>{{$loaitin->Ten}}</small>
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
                        <form action="admin/loaitin/sua/{{$loaitin->id}}" method="POST">
                          <input type="hidden" name="_token" value=" {{ csrf_token()  }}" />
                            <div class="form-group">
                                <label>Tên loại tin</label>
                                <input class="form-control" name="Ten" placeholder="Điền tên loại tin"
                                    value="{{$loaitin->Ten}}" 
                                 />
                            </div>    
                             <div class="form-group">
                                 <label> Thể loại</label>
                                 <select class="form-control" name="TheLoai">
                                    @foreach( $theloai as $tl )
                                     <option
                                         @if($tl->id == $loaitin->idTheloai)
                                           echo {{"selected"}};
                                         @endif 

                                         value={{ $tl->id }}
                                     >
                                      {{ $tl->Ten }}
                                     </option>
                                     @endforeach

                                     
                                 </select>
                             </div>                    
                            <button type="submit" class="btn btn-default"> Edit</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->
 @endsection