<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * This route is responsible for recover the links in the first page, and fill the database which 
 * the children URls. This route calls the method index in the UrlsController.
 */
Route::resource("/", "UrlsController");

/**
 * This route is call by the JS method which uses Fetch API. The gols here is give to the JS file all
 * informations about the links and their ids savedm without rely on the webpage and its tags.
 */

Route::get("/getUrls", "UrlsController@getUrls");

/**
 * This last route is the core of the application. It is called by the Ajax method in public/js/seminovosbh.js .
 * This Ajax is responsible for start the crawler in each Url, recovered from the database with the route above.
 * After crawler the pages, it put the data into the database and render them with Jquery in a table in the main page.
 */
Route::post("/crawl", "CrawlerController@crawlStore")->name('crawl');