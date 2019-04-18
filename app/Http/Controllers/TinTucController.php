<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuc;
use App\LoaiTin;
use App\TheLoai;
use App\Comment;

class TinTucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // return trang List
        $tintuc= TinTuc::all();
        return view('admin.tintuc.danhsach',['tintuc'=>$tintuc]);

    }


    public function create()
    {
        //return add
        $theloai= TheLoai::all();
        $loaitin= LoaiTin::all();
        return view('admin.tintuc.them',['loaitin'=>$loaitin,'theloai'=>$theloai]);

    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'TieuDe'=> 'required|unique:TinTuc,TieuDe|min:10|max:100',
                 'TomTat'=>'required',
                 'NoiDung'=> 'required',

                 'LoaiTin'=>'required'
            ],
            [ 
                'TieuDe.required'=>'Bạn chưa nhập tên tiêu đề',
                'TieuDe.min'=>'Tên tiêu đề phải có độ dài từ 20-200 ký tự',
                'TieuDe.max'=>'Tên tiêu đề phải có độ dài từ 20-200 ký tự',
                'TieuDe.unique'=>' Tên tiêu đề đã tồn tại',
                'LoaiTin.required'=>' Bạn chưa chọn loại tin',
                'NoiDung.required'=>'Bạn chưa nhập nội dung',
                'TomTat.required'=>'Bạn chưa nhập tóm tắt',
            ]);
        $tintuc= new TinTuc();
        $tintuc->TieuDe= $request->TieuDe;
        $tintuc->NoiDung= $request->NoiDung;
        $tintuc->TomTat= $request->TomTat;
        $tintuc->idLoaiTin=$request->LoaiTin;
         $tintuc->SoLuotXem=$request->SoLuotXem;


        if($request->hasFile('Hinh'))
        {
            $file= $request->file('Hinh');
            $duoi=$file->getClientOriginalExtension();
            if( $duoi !='jpg'&& $duoi !='png'&& $duoi !='jpeg')
            {
                redirect('admin/tintuc/them')->with('thongbao','Bạn chỉ được thêm ảnh .jpg ,png,jpeg');
            }
            $name= $file->getClientOriginalName();//lấy tên ảnh
            $Hinh=str_random(4)."_".$name;// gán random tên ảnh
            // khÔng trùng tên ảnh
            while(file_exists("upload/tintuc/".$Hinh))
            {
                $Hinh=str_random(4)."_".$name;
            }
            $file->move("upload/tintuc",$Hinh);
            $tintuc->Hinh=$Hinh;
        }
        else
        {
            $tintuc->Hinh= "";
        }
        
        $tintuc->save();
        return redirect('admin/tintuc/them')->with('thongbao','Thêm thành công');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $theloai=TheLoai::all();
        $loaitin= LoaiTin::all();
        $tintuc=TinTuc::find($id);
        $comment=Comment::all();
        return view('admin.tintuc.sua',['loaitin'=>$loaitin,'tintuc'=>$tintuc,'theloai'=>$theloai,'comment'=>$comment]);
    }

    

    public function update(Request $request, $id)
    {
         $this->validate($request,
            [
                'TieuDe'=> 'required|unique:TinTuc,TieuDe|min:10|max:100',
                 'TomTat'=>'required',
                 'NoiDung'=> 'required',

                 'LoaiTin'=>'required'
            ],
            [ 
                'TieuDe.required'=>'Bạn chưa nhập tên tiêu đề',
                'TieuDe.min'=>'Tên tiêu đề phải có độ dài từ 10-100 ký tự',
                'TieuDe.max'=>'Tên tiêu đề phải có độ dài từ 10-100 ký tự',
                'TieuDe.unique'=>' Tên tiêu đề đã tồn tại',
                'LoaiTin.required'=>' Bạn chưa chọn loại tin',
                'NoiDung.required'=>'Bạn chưa nhập nội dung',
                'TomTat.required'=>'Bạn chưa nhập tóm tắt',
            ]);
        $tintuc= TinTuc::find($id);
        $tintuc->TieuDe= $request->TieuDe;
        $tintuc->NoiDung= $request->NoiDung;
        $tintuc->TomTat= $request->TomTat;
        $tintuc->idLoaiTin=$request->LoaiTin;
        $tintuc->Hinh=$request->Hinh;
        $tintuc->NoiBat= $request->NoiBat;

         if($request->hasFile('Hinh'))
        {
            $file= $request->file('Hinh');
            $duoi=$file->getClientOriginalExtension();
            if( $duoi !='jpg'&& $duoi !='png'&& $duoi !='jpeg')
            {
                redirect('admin/tintuc/them')->with('thongbao','Bạn chỉ được thêm ảnh .jpg ,png,jpeg');
            }
            $name= $file->getClientOriginalName();//lấy tên ảnh
            $Hinh=str_random(4)."_".$name;// gán random tên ảnh
            // khÔng trùng tên ảnh
            while(file_exists("upload/tintuc/".$Hinh))
            {
                $Hinh=str_random(4)."_".$name;
            }

            $file->move("upload/tintuc",$Hinh);
            // xoa file anh cu trc khi luu cai moi
            unlink("upload/tintuc/".$tintuc->Hinh);
            $tintuc->Hinh=$Hinh;
        }
        
         $tintuc->save();
         return redirect('admin/tintuc/sua/'.$id)->with('thongbao','Sửa thành công');

        
    }

    public function destroy($id)
    {
        $tintuc= TinTuc::find($id);
        $tintuc->delete();
        return redirect('admin/tintuc/danhsach')->with('thongbao','Bạn đã xóa thành công');
    }
}
