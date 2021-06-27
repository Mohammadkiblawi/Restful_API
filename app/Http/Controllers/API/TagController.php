<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Resources\Tag as TagResource;

class TagController extends Controller
{
    /**
     * 
     * Instantiate a new controller instance.
     * 
     * @return void
     * */
    public function __construct()
    {

        // $this->middleware('log')->only('index');

        $this->middleware('auth:api')->except(['index', 'show']);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tag = TagResource::collection(Tag::all());
        return $tag->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $limit = $request->input('limit') <= 50 ? $request->input('limit') : 15;
        $this->authorize('create', Tag::class);
        $tag = new TagResource(Tag::create($request->paginate($limit)));
        return $tag->response()->setStatusCode(200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = new TagResource(Tag::findOrFail($id));
        return $tag->response()->setStatusCode(200, "Tag returned successfully")->header('Additional Header', 'True');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tag $id)
    {
        $idtag = Tag::findOrFail($id);
        $this->authorize('update', $idtag);
        $tag =  new TagResource(Tag::findOrFail($id));
        $tag->update($request->all());
        return $tag->response()->setStatusCode(200, "Tag updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $idtag = Tag::findOrFail($id);
        $this->authorize('delete', $idtag);
        Tag::findOrFail($id)->delete();
        return 204;
    }
}
