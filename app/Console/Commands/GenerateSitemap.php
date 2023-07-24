<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\SitemapGenerator;
use Carbon\Carbon;

class GenerateSitemap extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate the sitemap.';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try{

            SitemapGenerator::create(config('app.url'))
                ->writeToFile(public_path('sitemap.xml'));
            
        }
        catch(Exception $e){
            $this->error('Error : '.$e->message() );
            exit();
        }

    }
}