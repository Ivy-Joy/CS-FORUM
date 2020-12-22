<?php

namespace App\Http\Controllers;

use App\Models\GroupConversation;
use Illuminate\Http\Request;

class GroupConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

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
    public function store(Request $request)
    {
        $request->validate([
            'groupid' => 'required',
            'userText' => 'required',
            'authorid' => 'required'
        ]);
        GroupConversation::create([
            'group_id' => $request->groupid,
            'userText' => $request->userText,
            'author_id' => $request->authorid,
        ]);
        return json_encode(['response'=>'success']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GroupConversation  $groupConversation
     * @return \Illuminate\Http\Response
     */
    public function show(GroupConversation $groupConversation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupConversation  $groupConversation
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupConversation $groupConversation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GroupConversation  $groupConversation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupConversation $groupConversation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupConversation  $groupConversation
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupConversation $groupConversation)
    {
        //
    }
}
