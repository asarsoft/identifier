<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class CrudController extends Controller
{

    protected $relationships = [];
    protected $child_relations = [];

    protected $trashed_child = [];
    protected $trashed_children = [];

    protected $rules = null;

    public $primary = null;

    public $module_foreign = null;

    public $show_view = null;
    public $index_view = null;

    public $model = null;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $records = $this->model::with($this->relationships)->get();
        return view($this->index_view, ['records' => $records]);
    }

    public function show($id)
    {
        $record = $this->model::with($this->relationships)->where('id', $id)->first();
        return view($this->show_view, ['record' => $record]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($this->parameters())
        {
            foreach ($this->parameters() as $object)
            {
                $validator = Validator::make($request->all(), $object['rules']);
                if ($validator->fails())
                {
                    return redirect()->back()->withErrors($validator->errors())->withInput(Input::all());
                }
            }

            foreach ($this->parameters() as $object)
            {
                $record = $request->only(array_keys($object['rules']));
                if (@$object['image'] && $request->hasFile($object['image']))
                {
                    $path = $request->file($object['image'])->store('', ['disk' => 'feature']);
                    $record = array_merge($record, [$object['image'] => $path]);
                }

                if (@$object['sub_model'])
                {
                    $record = array_merge($record, [$this->module_foreign => $this->primary]);
                    $object['model']::create($record);
                }
                else
                {
                    $stored = $object['model']::create($record);
                    $this->primary = $stored->id;
                }
            }

            $toast_messages = $this->toast_message('create');
            Session::flash('toast_messages', $toast_messages);
        }

        return $this->show($this->primary);
    }


    /**
     * indexing deleted items to be restored
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function recycle()
    {
        $records = $this->model::onlyTrashed()->with($this->trashed_children)->get();
        return view($this->recycle_view, ['records' => $records]);
    }

    /**
     * The function Soft deletes features
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $record = $this->model::where('id', $id)->delete();

        $toast_messages = $this->toast_message('delete');

        Session::flash('toast_messages', $toast_messages);
        return redirect()->back();
    }

    public function image_rule()
    {
        return [
            'image' => 'nullable|image|max:2048',
        ];
    }

    //    /**
//     * Show the form for creating a new resource.
//     *
//     * @return \Illuminate\Http\Response
//     */
//    public function create()
//    {
//        //
//    }
//
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function show($id)
//    {
//        //
//    }
//
//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function edit($id)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, $id)
//    {
//        //
//    }
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function destroy($id)
//    {
//        //
//    }
}
