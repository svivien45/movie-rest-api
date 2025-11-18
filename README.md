<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p> <p align="center"> <a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a> <a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a> </p>
Laravel Rest Api
    URL	    | HTTP method	  | Auth	| JSON Response
---------------------------------------------------------
/users/login| POST            |		    | user's token
/users	    | GET	          | Y	    | all users

/movies     | GET		      |         | all movies
/movies	    | POST	          | Y	    | new movie added
/movies	    | PATCH	          | Y	    | edited movie
/movies	    | DELETE	      | Y	    | id

/directors	| GET		      |         | all directors
/directors	| POST	          | Y	    | new director added
/directors	| PATCH	          | Y	    | edited director
/directors	| DELETE	      | Y       | id

/studios	| GET		      |         | all studios
/studios	| POST	          | Y	    | new studio added
/studios	| PATCH	          | Y	    | edited studio
/studios	| DELETE	      | Y	    | id

/categories	| GET		      |         | all categories
/categories	| POST	          | Y	    | new category added
/categories	| PATCH	          | Y	    | edited category
/categories	| DELETE	      | Y	    | id

About Laravel
Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

Simple, fast routing engine.
Powerful dependency injection container.
Multiple back-ends for session and cache storage.
Expressive, intuitive database ORM.
Database agnostic schema migrations.
Robust background job processing.
Real-time event broadcasting.
Laravel is accessible, powerful, and provides tools required for large, robust applications.

Learning Laravel
Laravel has the most extensive and thorough documentation and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the Laravel Bootcamp, where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, Laracasts can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

Laravel Sponsors
We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel Partners program.

Premium Partners
Vehikl
Tighten Co.
Kirschbaum Development Group
64 Robots
Curotec
DevSquad
Redberry
Active Logic
Contributing
Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the Laravel documentation.

Code of Conduct
In order to ensure that the Laravel community is welcoming to all, please review and abide by the Code of Conduct.

Security Vulnerabilities
If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via taylor@laravel.com. All security vulnerabilities will be promptly addressed.

License
The Laravel framework is open-sourced software licensed under the MIT license.