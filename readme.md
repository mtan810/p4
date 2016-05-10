# mchan

## Live URL
http://p4.dwa16-masontan.me/

## Description
A social media web application where users can discuss a variety of subjects pertaining to technology by creating threads and posting comments. In a sense, you can think of it as a tech forum or message board.

## Screencast Demo
http://screencast.com/t/9WotLtx3mLM

## Details for teaching team
1. When you visit the Live URL, you can register a new account or login with the test users. Note that you can view threads and comments without logging in, but you will not be able to create them. More explained at 4. Here I added server side validation such as:
    * Max character length of name
2. Once you are logged in, select any subject from the homepage. You can create a new thread or go to any of the fake existing threads. You can post a comment within a thread at the bottom of the page. Here I added server side validation such as:
    * Thread name and text required
    * Comment required
    * Max character length of the fields
    * Comment deletion. Users can only delete their own comments. Users that try to delete non-existant comments or someone else's comments will fail.
3. At the top of the page, select the "Account" link to visit the account profile page. You can change the password and theme of the account. Here I added server side validation such as:
    * Minimum character length of password
    * Theme required
4. Some routes are restricted to logged-in users only. Guests cannot create threads, post comments, or access the account profile page. They will be redirected to the login page instead. Once they have logged in, they will be redirected back to their previous page.
5. If you try to run the migrations, note that it will take a litte longer for the CommentsTableSeeder to finish. The reason is the CommentsTableSeeder is generating X comments per thread, ThreadsTableSeeder is generating Y threads per subject, and there are 7 subjects in total. Also note that the number of threads in CommentsTableSeeder will depend on the number of threads that were generated per subject in ThreadsTableSeeder.

## Outside Code
* Bootstrap: http://getbootstrap.com/
* badcow/lorem-ipsum: https://packagist.org/packages/badcow/lorem-ipsum
* fzaninotto/faker: https://packagist.org/packages/fzaninotto/faker
* barryvdh/laravel-debugbar: https://packagist.org/packages/barryvdh/laravel-debugbar
* rap2hpoutre/laravel-log-viewer: https://packagist.org/packages/rap2hpoutre/laravel-log-viewer