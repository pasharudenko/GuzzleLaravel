<?php

namespace App\Http\Controllers;

use App\Post;
use Goutte\Client;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class WebScrapingController extends Controller
{
    public function index()
    {
        return view('scraping')->with('contents', $this->StartScraping());
    }

    public function StartScraping()
    {
        // composer require fabpot/goutte  -  библиотека для работы с парсингом
        $client = new Client();
        $crawler = $client->request('GET', 'https://www.pravda.com.ua/rus/news/'); // Сайт который будем парсить
        


        return $crawler->filter('.news.news_all div.article')->each(function ($node, $i) {  // получаем интересующую нас информацию с помощью селектора .news.news_all div.article'
            // С каждого div.article получаем интересующие нас поля: time, title, url, content
            return  [
                'i'=>$i, // Счётчик
                'time' => $node->filter('.article__time')->text(), //фильтруем информацию с .article__time и получаем её с помощью метода text()
                'title' => $node->filter('.article__title')->text(),
                'url' => $node->filter('.article__title a')->attr('href'),
                'content' => $node->filter('.article__subtitle')->text()
            ];

        });
    }


    public function save(Request $request)
    {
        Post::create($request->all());
        echo "success";
    }

    public function ExportCsvFile()
    {
        return view('CSVFileTemplate')->with('contents', $this->StartScraping());
    }

    public function Export()
    {
        //composer require "maatwebsite/excel:~2.1.0" библотека для работы с excel файлами
        Excel::create('file', function ($excel) { // file - название для Excel файла
            $excel->sheet('file', function ($sheet) {
                $sheet->loadView('CSVFileTemplate')->with('contents', $this->StartScraping()); // загружаем требующий нам view с параметром contents
            });
        })->export('xlsx');
    }
}
