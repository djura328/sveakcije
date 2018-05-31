<?php

namespace App\Http\Controllers;

//use Illuminate\Http\Request;
use Request;
use App\Article;
use Image;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Article::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(\Illuminate\Http\Request $request)
    {
        $article = Article::create($request->all());
        $article->data = json_decode($article->data, true);
        if($article) return 'ok';
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = Article::with('company')->where('id', $id)->first();
        $article->data = json_decode($article->data, true);
        return $article;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return 'edit';
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(\Illuminate\Http\Request $request, $id)
    {
        Article::where('id', $id)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Article::find($id)->delete();
    }

    public function uplaodImage(Request $request)
    {
       /* $name =  Request::file('image')->getClientOriginalName();
        Request::file('image')->move(public_path('storage'), $name);

        return collect(['name' => $name]);*/

        $image       = Request::file('image');
        $filename    = $image->getClientOriginalName();
        $image->move(public_path('storage'), $filename);

        $image_resize = Image::make('storage/'.$filename);
        $image_resize->resize(160, 160);
        $image_resize->save(public_path('storage/small/' .$filename));

        return collect(['name' => $filename]);
    }

}
