<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p>
# Untuk membuat documentasi Swagger adalah dengan mengconvert postmen Collection dari BE ini dengan cara :
    <ul>
        <li>File json collection dari posman di convert menjadi json yg compatible dengan swagger yaitu OpenAPI/Swagger v3.0 menggunakan https://www.apimatic.io/ </li>
        <li>buka https://editor.swagger.io/ </li>
        <li>paste file json yg sdh diconvert menjadi OpenAPI/Swagger v3.0 </li>
        <li>copy paste file yaml ke dalam swagger.yaml di apps BE tersebut </li>
     </ul>
</p>
<p>
# Untuk deploy cource code kedalam HEROKU Cloud :
    <ul>
        <li>masuk kedalam path lokasi directori project menggunakan cmd prompt </li>
        <li>buka https://editor.swagger.io/ </li>
        <li>paste file json yg sdh diconvert menjadi OpenAPI/Swagger v3.0 </li>
        <li>login kedalam heroku : heroku login </li>
        <li>git init </li>
        <li>heroku git:remote -a nama-app-di-heroku </li>
        <li>git add . </li>
        <li>git commit -am "make it better" </li>
        <li>git push heroku master </li>
        <li>akses di heroku : https://be-laravel.herokuapp.com/docs </li>
     </ul>
</p>

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
