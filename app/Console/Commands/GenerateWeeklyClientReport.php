<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateWeeklyClientReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    
    protected $signature = 'generate:weekly_invoice_report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command generate weekly invoice report';

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
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
