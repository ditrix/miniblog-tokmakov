
(https://tokmakov.msk.ru/blog/item/539)



 [Создание таблиц БД, наполнение тестовыми данными](https://tokmakov.msk.ru/blog/item/539)

 [Создание контроллера, представления и маршрута](https://tokmakov.msk.ru/blog/item/542)

[Постраничная навигация, layout-шаблон и поиск по блогу](https://tokmakov.msk.ru/blog/item/543)

в обработке поисковой формы есть пример валидации
```php
class Cl {
	//...
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
   //...
   }
```
[Создание нового поста, загрузка и обрезка изображения](https://tokmakov.msk.ru/blog/item/545)

NB! в загрузке изображения обязательно указываем <form ... enctype="multipart/form-data"> иначе files в requeste не видать

[вариант загрузки файлов](https://uncaughtexception.ru/2020/01/07/zagruzka-izobrazheniy-v-laravel-6-po-shagam.html)

варианты:
```php
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

[gd2 extention!](https://overcoder.net/q/964812/%D1%80%D0%B0%D1%81%D1%88%D0%B8%D1%80%D0%B5%D0%BD%D0%B8%D0%B5-%D0%B1%D0%B8%D0%B1%D0%BB%D0%B8%D0%BE%D1%82%D0%B5%D0%BA%D0%B8-gd-laravel-intervention-image)

[Просмотр и редактирование отдельного поста блога](https://tokmakov.msk.ru/blog/item/547)