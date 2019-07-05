<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ware;
use App\User;
use App\Http\Requests\WareCreateRequest;
use Illuminate\Support\Facades\Auth;

class WareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $model;



    public function __construct(Ware $ware)
    {
        $this->model = $ware;
    }

    public function index()
    {
        $wares = Auth::user()->wares;
        $data['wares'] = $wares;
        return view('admin.ware.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $data['users'] = $user->getUsers();
        unset($data['users'][0]);
        return view('admin.ware.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WareCreateRequest $request)
    {
        $name = $request->name;
        $user_id = $request->user_id;
        $ware = $this->model->insertWare($name, $user_id);
        return redirect()->route('admin.root.index')->with('message', "Tạo kho hàng $ware->name thành công");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['ware'] = $this->model->getWarebyID($id);
        return view('admin.ware.note', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, $user_id)
    {
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function showProduct($id)
    {
        $data['ware'] = $this->model->getWarebyID($id);
        return view('admin.ware.showproduct', $data);
    }

    public function changeUser(Request $request)
    {
        $field = $request->field;
        $id = $request->id;
        $value = $request->value;
        $user = User::find($id);

        if ($field == 'name') {
            $user->name = $value;
            $user->save();
        }
        if ($field == 'email') {
            $user->email = $value;
            $user->save();
        }
    }
    public function changeWare(Request $request)
    {
        $id = $request->id;
        $value = $request->value;
        $ware = $this->model->getWarebyID($id);
        $ware->name = $value;
        $ware->save();
    }
}
