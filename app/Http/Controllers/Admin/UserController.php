<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserEditRequest;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $recordsPerPage = $request->input('records_per_page', 5);
        $isDel = $request->input('status', '1');
        $users = null;
        if ($isDel === '0') {
        $users = User::orderBy('id', 'desc')->onlyTrashed()->paginate($recordsPerPage);
        }else {
        $users = User::orderBy('id', 'desc')->paginate($recordsPerPage);
        }
        return response()->view("admin.user.index",['users' => $users, 'recordsPerPage' => $recordsPerPage]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.user.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        // Băm mật khẩu trước khi lưu
        $validated['password'] = Hash::make($validated['password']);
    
        // Tạo người dùng mới và lưu vào database
        $user = User::create($validated);
    
        session()->flash('success',"Tạo tài khoản thành công:$user->username");
        // Chuyển hướng lại với thông báo thành công
        return redirect()->route('admin.user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($user)
    {
        $userData = User::withTrashed()->where('id', $user)->first();
        return view('admin.user.edit',['user'=> $userData]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UserEditRequest $request)
    {
        // Lấy dữ liệu được xác thực từ request
        $validatedData = $request->validated();
        
        // Lấy ID người dùng từ route
        $userId = $request->route('user');
        
        // Tìm người dùng theo ID, bao gồm cả những bản ghi đã xóa mềm
        $user = User::withTrashed()->find($userId);
        
        if (!$user) {
            // Xử lý khi không tìm thấy người dùng
            return response()->json(['message' => 'Không tìm thấy người dùng'], 404);
        }
        
        // Cập nhật các trường thông tin của người dùng theo mảng dữ liệu
        $updateData = [
            'email' => $validatedData['email'],
            'username' => $validatedData['username'],
            'ho' => $validatedData['ho'],
            'ten' => $validatedData['ten'],
            'ngaysinh' => $validatedData['ngaysinh'],
            'gioitinh' => $validatedData['gioitinh'],
            'diachi' => $validatedData['diachi'],
            'dienthoai' => $validatedData['dienthoai'],
        ];
    
        // Kiểm tra nếu isChangePw có giá trị là "1" thì cập nhật mật khẩu
        if ($request->has('isChangePw') && $request->input('isChangePw') == "1") {
            $updateData['password'] = Hash::make($validatedData['password']); // Hash mật khẩu
        }
    
        // Cập nhật thông tin người dùng
        $user->update($updateData);
    
        // Xử lý trạng thái của người dùng (xóa mềm hoặc khôi phục)
        if ($request->input('status') === '0') {
            $user->delete();
        } else if ($user->trashed()) {
            $user->restore();
        }
    
        // Lưu thay đổi vào cơ sở dữ liệu
        $user->save();
        
        // Thêm thông báo thành công vào session
        session()->flash('success', "Cập nhật: $user->email thành công");
        
        // Chuyển hướng lại với thông báo thành công
        return redirect()->route('admin.user.index');
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($user)
    {
        $user = User::find($user);
        if($user){
            $user->delete();
        }else{
            return redirect()->route('admin.user.index')->with('error','không tìm thấy người dùng');
        }
        return redirect()->route('admin.user.index')->with('success','xóa thành công: '. $user->username);
    }

    public function restore($user)
    {
        // Tìm bản ghi đã soft deleted
        $user = User::onlyTrashed()->findOrFail($user);
    
        // Khôi phục bản ghi
        $user->restore();
    
        return redirect()->route('admin.user.index')
                         ->with('success', 'Đã khôi phục người dùng thành công.');
    }
}
