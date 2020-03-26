<?php

namespace App\Console\Commands;

use App\Common\Sitemap\SitemapBuilder;
use App\Common\Sitemap\Providers\StaticSitemapProvider;
use Illuminate\Console\Command;

/**
 * Class BuildSitemap
 * @package App\Console\Commands
 */
class BuildSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'build-sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    public const DESCRIPTION = 'Generate and save sitemap.xml';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->description = self::DESCRIPTION;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {

            $this->output->writeln('Generate sitemap started');
            $builder = new SitemapBuilder();
            $builder->addProvider(new StaticSitemapProvider());
            $builder->save();
            $this->output->writeln('Generate sitemap ended');
        } catch (\Exception $exception) {

            $this->output->writeln('An error occurred while generating the sitemap');
            $this->output->error($exception->getMessage());
        }
    }
}
