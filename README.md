
(https://tokmakov.msk.ru/blog/item/539)



 [Создание таблиц БД, наполнение тестовыми данными](https://tokmakov.msk.ru/blog/item/539)

 [Создание контроллера, представления и маршрута](https://tokmakov.msk.ru/blog/item/542)

[Постраничная навигация, layout-шаблон и поиск по блогу](https://tokmakov.msk.ru/blog/item/543)

в обработке поисковой формы есть пример валидации

[Создание нового поста, загрузка и обрезка изображения](https://tokmakov.msk.ru/blog/item/545)

NB! в загрузке изображения обязательно указываем <form ... enctype="multipart/form-data"> иначе files в requeste не видать

[вариант загрузки файлов](https://uncaughtexception.ru/2020/01/07/zagruzka-izobrazheniy-v-laravel-6-po-shagam.html)

варианты
```
       $image = $request->file('image');
        if ($image) {
            $path = Storage::putFile('public', $image);
            $post->image = Storage::url($path);
        }


        // иной вариант

        $imageName = time().'.'.$request->image->extension();  
        $imageName = $request->image->getFilename().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $imageName);


```