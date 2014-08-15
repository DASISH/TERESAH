<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DeployTeresah extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'deploy:teresah';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deploys TERESAH to remote server';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire() {
        $connection = $this->option('connection');
        if ($connection == "") {
            $connection = "staging";
        }

        if (array_key_exists("CONNECTIONS." . $connection . ".host", $_ENV)) {
            $this->info('Connecting to ' . $_ENV["CONNECTIONS." . $connection . ".host"]);
            SSH::into($connection)->run(array(
                'cd ' . $_ENV["CONNECTIONS." . $connection . ".root"],
                'git pull origin master',
            ));
        } else {
            $this->error("Connection $connection not configured");
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions() {
        return array(
            array('connection', null, InputOption::VALUE_OPTIONAL, 'The connection to use. Default=staging', null),
        );
    }

}
