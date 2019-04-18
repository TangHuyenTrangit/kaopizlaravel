<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slide= Slide::all();
        return view('admin/slide/danhsach',['slide'=>$slide]);
    }

    public function create()
    {

        return view('admin.slide.them');
    }

    public function store(Request $request)
    {
        $this->validate($request,
            [
                'Ten'=> 'required',
                'NoiDung'=> 'required'
            ],
            [ 
                'Ten.required'=>'Bạn chưa nhập tên slide',
                 'NoiDung.required'=>'Bạn chưa nhập nội dung'
                
            ]);
        $slide= new Slide();
        $slide->Ten= $request->Ten;
        $slide->NoiDung= $request->NoiDung;
        $slide->link= $request->link;
      


        if($request->hasFile('Hinh'))
        {
            $file= $request->file('Hinh');
            $duoi=$file->getClientOriginalExtension();
            if( $duoi !='jpg'&& $duoi !='png'&& $duoi !='jpeg')
            {
                redirect('admin/slide/them')->with('thongbao','Bạn chỉ được thêm ảnh .jpg ,png,jpeg');
            }
            $name= $file->getClientOriginalName();//lấy tên ảnh
            $Hinh=str_random(4)."_".$name;// gán random tên ảnh
            // khÔng trùng tên ảnh
            while(file_exists("upload/slide/".$Hinh))
            {
                $Hinh=str_random(4)."_".$name;
            }
            $file->move("upload/slide",$Hinh);
            $slide->Hinh=$Hinh;
        }
        else
        {
            $slide->Hinh= "";
        }
        
        $slide->save();
        return redirect('admin/slide/them')->with('thongbao','Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slide= Slide::find($id);
        return view('admin.slide.sua',['slide'=>$slide]);
    }

    public function update(Request $request, $id)
    {
          $this->validate($request,
            [
                'Ten'=> 'required',
                'NoiDung'=> 'required'
            ],
            [ 
                'Ten.required'=>'Bạn chưa nhập tên slide',
                 'NoiDung.required'=>'Bạn chưa nhập nội dung'
                
            ]);
        $slide= new Slide();
        $slide->Ten= $request->Ten;
        $slide->NoiDung= $request->NoiDung;
        $slide->link= $request->link;
        $slide->Hinh=$request->Hinh;
      


        if($request->hasFile('Hinh'))
        {
            $file= $request->file('Hinh');
            $duoi=$file->getClientOriginalExtension();
            if( $duoi !='jpg'&& $duoi !='png'&& $duoi !='jpeg')
            {
                redirect('admin/slide/them')->with('thongbao','Bạn chỉ được thêm ảnh .jpg ,png,jpeg');
            }
            $name= $file->getClientOriginalName();//lấy tên ảnh
            $Hinh=str_random(4)."_".$name;// gán random tên ảnh
            // khÔng trùng tên ảnh
            while(file_exists("upload/slide/".$Hinh))
            {
                $Hinh=str_random(4)."_".$name;
            }
            $file->move("upload/slide",$Hinh);
            unlink("upload/slide/".$slide->Hinh);
            $slide->Hinh=$Hinh;
        }
       
        
        $slide->save();
        return redirect('admin/slide/sua')->with('thongbao','Sửa thành công');
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        $slide= Slide::find($id);
        $slide->delete();
        return redirect('admin/slide/danhsach')->with('thongbao','Bạn đã xóa thành công');
    }
}
