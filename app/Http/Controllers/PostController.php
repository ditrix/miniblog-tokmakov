<?php

namespace App\Http\Controllers;

use App\Post;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

//use Intervention\Image\ImageServiceProvider;



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
        return view('posts.create',[]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $post = new Post();
        $post->author_id = rand(1,4);
        $post->title = $request->input('title');
        $post->excerpt = $request->input('excerpt');
        $post->body = $request->input('body');

/*        $image = $request->file('image');
        if($image){
            $path = Storage::putFile('public',$image);
            $post->image = Storage::url($path);
        }
*/

        $source = $request->file('image');        
        if($source){
            $ext = str_replace('jpeg', 'jpg', $source->extension());
            $name = md5(uniqid());  
            // сохраняем исходній файл
            Storage::putFileAs('public/image/source',$source,$name.'.'.$ext);

            $image = Image::make($source)
                ->resizeCanvas(1200,400,'center',false,'dddddd')
                ->encode('jpg',100);

            // сохраняем это изображение под именем $name.jpg в директории public/image/image
            Storage::put('public/image/image/' . $name . '.jpg', $image);
            $image->destroy();    
            $post->image = Storage::url('public/image/image/' . $name . '.jpg');
            

            // создаем jpg изображение для списка постов блога размером 600x200, качество 100%
            $thumb = Image::make($source)
                ->resizeCanvas(600, 200, 'center', false, 'dddddd')
                ->encode('jpg', 100);
            // сохраняем это изображение под именем $name.jpg в директории public/image/thumb
            Storage::put('public/image/thumb/' . $name . '.jpg', $thumb);
            $thumb->destroy();
            $post->thumb = Storage::url('public/image/thumb/' . $name . '.jpg');

        }




        $post->save();

        return redirect()->route('post.index')->with('success', 'Новый пост успешно создан ');


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
            ->orWhere('posts.excerpt','like','%'.$search.'%')

            
            ->orWhere('users.name','like','%'.$search.'%')
            ->orderBy('posts.created_at','desc')
            ->paginate(4)
            ->appends(['search' => $request->input('search')]); // NB!  ;

        return view('posts.search',compact('posts'));     



    }

}
