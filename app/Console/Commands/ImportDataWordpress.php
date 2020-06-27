<?php

namespace App\Console\Commands;

use App\Common\ImportData\Services\ImportDataWordpress as ImportDataWordpressService;
use App\Common\Setting\Services\Setting as SettingService;
use Illuminate\Console\Command;

/**
 * Class ImportDataWordpress
 * @package App\Console\Commands
 */
class ImportDataWordpress extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wordpress:import-data {--prefix=}';

    /**
     * The console command description.
     *
     * @var string
     */
    public const DESCRIPTION = 'Import data from Wordpress';

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
     * @param SettingService $settingService
     */
    public function handle(SettingService $settingService)
    {
        $prefix = $this->option('prefix');
        $prefix = !$prefix ? '' : $prefix . '_';

        $importDataWordpressService = new ImportDataWordpressService($prefix, $settingService);

        try {

            $this->output->writeln('Import data from Wordpress started');

            $this->output->writeln('Import categories');
            $importDataWordpressService->importCategories();

            $this->output->writeln('Import tags');
            $importDataWordpressService->importTags();

            $this->output->writeln('Import posts');
            $importDataWordpressService->importPosts();

            $this->output->writeln('Import pages');
            $importDataWordpressService->importPages();

            $this->output->writeln('Import categories posts relations');
            $importDataWordpressService->importCategoryPost();

            $this->output->writeln('Import posts tags relations');
            $importDataWordpressService->importPostTag();

            $this->output->writeln('Import comments');
            $importDataWordpressService->importComments();

            $this->output->writeln('Import data from Wordpress ended');
        } catch (\Exception $exception) {

            $this->output->writeln('An error occurred while import data from Wordpress');
            $this->output->error($exception->getMessage());
        }
    }
}
