<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Kinder;
use App\Code;

class ChangeKinderCode extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'changekindercode';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Changing Kinder Code Every Month';

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
        $kinders = Kinder::where('deleted_flag',0)->get();
        foreach($kinders as $kinder)
        {   
            $kinder->link_code = Kinder::generateRandomCode(8);
            $kinder->update();

            Code::send_code_changes_email($kinder->email,$kinder->link_code);
        }
    }
}
