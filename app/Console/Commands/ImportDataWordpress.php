<?php

namespace App\Console\Commands;

use App\Common\ImportData\Services\ImportDataWordpress as ImportDataWordpressService;
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
    protected $signature = 'import-data-wordrpess {--prefix=}';

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
     * @return mixed
     */
    public function handle()
    {
        $prefix = $this->option('prefix');
        $prefix = !$prefix ? '' : $prefix . '_';

        $importDataWordpressService = new ImportDataWordpressService($prefix);

        try {

            $this->output->writeln('Import data from Wordpress started');

            $importDataWordpressService->importPosts();
            $importDataWordpressService->importPages();

            $this->output->writeln('Import data from Wordpress ended');
        } catch (\Exception $exception) {

            $this->output->writeln('An error occurred while import data from Wordpress');
            $this->output->error($exception->getMessage());
        }
    }
}
