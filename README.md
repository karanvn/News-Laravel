<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>


************* PROJECT E-LARAVEL CTRL MEDIA ****************
- CREATE table schema: chạy php artisan migrate để update table schema
- Update table slug
- add table feedback
- Update column type in table categoriese
- Update column type in table blog_category
- Update column description in table blog_category 

- export excel: using library then 
+ B1 run composer require maatwebsite/excel
+ B2 add 'providers' => [ Maatwebsite\Excel\ExcelServiceProvider::class, ]
+ B3 add 'aliases' => [ ... 'Excel' => Maatwebsite\Excel\Facades\Excel::class, ]