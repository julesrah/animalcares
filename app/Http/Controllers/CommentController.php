<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Services;
use View;
use Redirect;
use Validator;
use DB;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Services::orderBy('id','ASC')->paginate(100);
        return View::make('comment.index', compact('services'));}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function create()
    {
       //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeComment(Request $request, $id)
    {
        $this->validate($request, [
            'comments' => 'required|profane'
        ]);
        
        $comment = new Comment;
        if($request->filled('guests')) {
            $comment->guests = $request->guests;
        } else {
            $comment->guests = 'Guest';
        }
        $comment->comments = $request->comments;
        $comment->services_id = $id;
        $comment->save();
        return redirect()->back()->with('success', 'Thank you for commenting!');
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
        $services = Services::find($id);
        $comments = DB::table('comments')
            ->join('services','services.id','=','comments.services_id')
            ->select('guests','comments')
            ->where('comments.services_id','=', $id)
            ->get();
        return View::make('comment.edit',compact('comments','services'));
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
}