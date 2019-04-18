<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user= User::all();
        return view('admin.user.danhsach',['user'=>$user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user= User::all();
        return view('admin.user.them');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $this->validate($request,
            [
                'name'=> 'required|min:3',
                 'email'=>'required|email|unique:users,email',
                 'password'=> 'required|min:3|max:32',
                  'passwordAgain'=> 'required|same:password',

                 'quyen'=>'required'
            ],
            [ 
                'name.required'=>'Bạn chưa nhập tên tiêu đề',
                'name.min'=>'Tên người dùng ít nhất 3 ký tự',
                'email.email'=>' Bạn chưa nhập đúng định dạng email',
                'password.unique'=>' Bạn hãy nhập mật khẩu',
                'passwordAgain.required'=>'Nhập lại mật khẩu chưa khớp',
               
            ]);
        $user= new User();
        $user->name= $request->name;
        $user->email= $request->email;
        $user->password=bcrypt( $request->password);
        $user->quyen=$request->quyen;
        

        $user->save();
        return redirect('admin/user/them')->with('thongbao','Thêm thành công');

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

   
    public function edit($id)
    {
        $user= User::find($id);
        return view('admin.user.sua',['user'=>$user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,
            [
                'name'=> 'required|min:3',
                 'email'=>'required|email|unique:users,email',
                 'password'=> 'required|min:3|max:32',
                  'passwordAgain'=> 'required|same:password',

                 'quyen'=>'required'
            ],
            [ 
                'name.required'=>'Bạn chưa nhập tên tiêu đề',
                'name.min'=>'Tên người dùng ít nhất 3 ký tự',
                'email.email'=>' Bạn chưa nhập đúng định dạng email',
                'password.unique'=>' Bạn hãy nhập mật khẩu',
                'passwordAgain.required'=>'Nhập lại mật khẩu chưa khớp',
               
            ]);
        $user=User::find($id);
         $user->name= $request->name;
        $user->email= $request->email;
        $user->password=bcrypt( $request->password);
        $user->quyen=$request->quyen;
        
        $user->save();
        return redirect('admin/user/sua/'.$id)->with('thongbao','Sửa thành công');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user= User::find($id);
        $user->delete();
        return redirect('admin/user/danhsach')->with('thongbao','Bạn đã xóa thành công');
    }
    public function getDangnhapAdmin()
    {
        return view('admin.login');
    }
     public function postDangnhapAdmin(Request $request)
    {
        $this->validate($request,
            //điều kiện check lỗi
            [
                'email'=>'required',
                'password'=>'required|min:3|max:32'
            ],
            // hiển thị thông báo cho user
            [
                'email.required'=>'Bạn chưa nhập email',
                
                'password.min'=>'Tên thể loại phải có ít nhất 3 ký tự',
                'password.max'=>'Tên thể loại phải có độ dài max 32 ký tự',
                
            ]);
        if( Auth::attempt(['email'=>$request->email,'password'=>$request->password]))
        {
            return redirect('admin/theloai/danhsach');
        }
        else

        {
            return redirect('admin/dangnhap')->with('thongbao','Đăng nhập không thành công');
        }
        
    }
    public function getDangxuatAdmin()
    {
        Auth::logout();
        return redirect('admin/dangnhap');

    }
}
