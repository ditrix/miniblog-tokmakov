<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

         $posts = Post::select('posts.*','users.name as author')
            ->join('users','posts.author_id','=','users.id')
            ->orderBy('posts.created_at','desc')
            ->paginate(4);


        return view('posts.index',compact('posts'));  


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
        //
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
        //
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

// поиск по блогу!!
    public function search(Request $request) {
        $search = $request->input('search','');
         // образаем слишком длинный запрос
        $search = iconv_substr($search, 0, 64);
        // удаляем все, кроме букв и цифр
        $search = preg_replace('#[^0-9a-zA-ZА-Яа-яёЁ]#u', ' ', $search);
        // сжимаем двойные пробелы
        $search = preg_replace('#\s+#u', ' ', $search);
        if(empty($search)){
            return view('posts.search');
        }

        $posts = Post::select('posts.*','users.name as author')
            ->join('users','posts.author_id','=','users.id')
            ->where('posts.title','like','%'.$search.'%')
            ->orWhere('posts.body','like','%'.$search.'%')
            ->orWhere('posts.name','like','%'.$search.'%')
            ->orderBy('posts.created_at','desc')
            ->paginate(4)
            ->appends(['search' => $request->input('search')]); // NB!  ;

        return view('posts.search',compact('posts'));     



    }

}
