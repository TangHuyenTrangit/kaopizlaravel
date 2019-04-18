<?php

namespace App\Http\Controllers;

use App\TheLoai;
use Illuminate\Http\Request;

class TheLoaiController extends Controller 
{ 
	public function getDanhsach() 
	{
		$theloai= TheLoai::all(); 
		return view('admin.theloai.danhsach',['theloai'=>$theloai]);
		
    } 
    public function getThem() 
	{ 
		return view('admin.theloai.them'); 
	}
	public function postThem(Request $request)
	{
		
		$this->validate($request,
			[
				'Ten'=> 'required|min:3|max:100'
			],
			[
				'Ten.required'=>'Bạn chưa nhập tên thể loại',
				'Ten.min'=>'Tên thể loại phải có độ dài từ 3-100 ký tự',
				'Ten.max'=>'Tên thể loại phải có độ dài từ 3-100 ký tự',
			]);
		$theloai= new TheLoai;
		$theloai->Ten= $request->Ten;
		$theloai->save();
		return redirect('admin/theloai/them')->with('thongbao','Thêm thành công');
	} 
	
	public function getSua($id)
	{
		$theloai= TheLoai::find($id);
		return view('admin.theloai.sua',['theloai'=>$theloai]);
	}
	public function postSua(Request $request,$id)// Gửi dữ liệu lên từ form
	{
		$theloai= TheLoai::find($id);
		$this->validate($request,
			//điều kiện check lỗi
			[
				'Ten'=>'required|unique:TheLoai,Ten|min:3|max:100'
			],
			// hiển thị thông báo cho user
			[
				'Ten.required'=>'Bạn chưa nhập tên thể loại',
				'Ten.unique'=>'Tên đã tồn tại trong bảng. Mời bạn nhập lại',
				'Ten.min'=>'Tên thể loại phải có độ dài từ 3-100 ký tự',
				'Ten.max'=>'Tên thể loại phải có độ dài từ 3-100 ký tự',
			]);
		
		$theloai->Ten=$request->Ten;
		$theloai->save();

		return redirect('admin/theloai/sua/'.$id)->with('thongbao','Sửa thành công');
	}
	public function getXoa($id)
	{
		$theloai=TheLoai::find($id);
		$theloai->delete();

		return redirect('admin/theloai/danhsach')->with('thongbao','Bạn đã xóa thành công');


	}
   
}
