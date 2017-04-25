<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\News;

class GetNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $news=new News();
        $rss = "https://3dnews.ru/news/rss/";
        $news->getNewsFromRssLine($rss);

    }
}
