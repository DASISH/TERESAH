<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class Deploy extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = "deploy";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Deploys the TERESAH to remote server";

    /**
     * Filename of the configuration file template.
     *
     * @var string
     */
    protected $configurationFileTemplateFilename = ".env.environment.php.template";

    /**
     * The environment to deploy to. Defaults to staging.
     *
     * @var string
     */
    protected $environment = "staging";

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
    public function fire()
    {
        $this->environment = $this->option("to");
        $this->info("Starting deployment to {$this->environment} environment.");
        $this->info("Checking configuration parameters for the deployment...");

        if ($this->checkDeployConfiguration($this->environment)) {
            if ($this->checkConfigurationTemplate()) {
                $this->info("Connecting to ".$_ENV["DEPLOY_SERVERS.{$this->environment}.host"]."...");
                $this->info("Starting to execute deployment commands on ".$_ENV["DEPLOY_SERVERS.{$this->environment}.host"]."...");

                # Parameters: --setup
                if ($this->option("setup")) {
                    $this->setup();
                } else {
                    $this->deploy();
                }

                $this->info("Completed deployment to {$this->environment} environment.");
            } else {
                return $this->error("Error: Couldn't find the configuration file template. Please, check that the configuration file template {$this->configurationFileTemplateFilename} exists.");
            }
        } else {
            return $this->error("Error: Deploy settings for the {$this->environment} environment are not properly configured. Please, check the configuration of the file .env.{$this->environment}.php.");
        }
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return array(
            array("to", null, InputOption::VALUE_OPTIONAL, "Deploy to the specific environment (e.g. staging or production).", $this->environment),
            array("setup", null, InputOption::VALUE_NONE, "Setup (and deploy) the specific environment.", null),
        );
    }

    private function checkDeployConfiguration($environment = "staging", $requiredParameters = array("host", "username", "password", "root", "repository", "repository_branch"))
    {
        if (is_array($requiredParameters)) {
            foreach ($requiredParameters as $parameter) {
                $key = "DEPLOY_SERVERS.{$environment}.{$parameter}";

                if (!array_key_exists($key, $_ENV) || empty($_ENV[$key])) {
                    return false;
                }
            }

            return true;
        }

        return false;
    }

    private function checkConfigurationTemplate()
    {
        return file_exists(base_path()."/{$this->configurationFileTemplateFilename}");
    }

    private function deploy()
    {
        SSH::into($this->environment)->run(array(
            "cd ".$_ENV["DEPLOY_SERVERS.{$this->environment}.root"],
            "git pull origin ".$_ENV["DEPLOY_SERVERS.{$this->environment}.repository_branch"],
            "composer update",
            "php artisan migrate",
            "php artisan cache:clear"
        ));
    }

    private function setup()
    {
        SSH::into($this->environment)->run(array(
            "cd ".$_ENV["DEPLOY_SERVERS.{$this->environment}.root"],
            "git clone ".$_ENV["DEPLOY_SERVERS.{$this->environment}.repository"]." ."
        ));

        $this->info("Starting to write environment specific configuration file to the server. Please, provide the necessary configuration parameters for the {$this->environment}.");

        SSH::into($this->environment)->putString($_ENV["DEPLOY_SERVERS.{$this->environment}.root"]."/.env.{$this->environment}.php", $this->setupConfigurationFile());

        SSH::into($this->environment)->run(array(
            "cd ".$_ENV["DEPLOY_SERVERS.{$this->environment}.root"],
            "composer update",
            "php artisan migrate",
            "php artisan cache:clear",
            "chmod -R 775 ".$_ENV["DEPLOY_SERVERS.{$this->environment}.root"]."/app/storage",
            "chmod -R o+w ".$_ENV["DEPLOY_SERVERS.{$this->environment}.root"]."/app/storage"
        ));
    }

    private function setupConfigurationFile()
    {
        $configurationFileParameters = array();
        $configurationFileTemplate = base_path()."/{$this->configurationFileTemplateFilename}";
        $configurationFile = file_get_contents($configurationFileTemplate);

        $configurationFileParameters["{{environment}}"] = $this->environment;
        $configurationFileParameters["{{database_host}}"] = $this->ask("Database host (e.g. localhost)?");
        $configurationFileParameters["{{database_name}}"] = $this->ask("Database name?");
        $configurationFileParameters["{{database_username}}"] = $this->ask("Database username?");
        $configurationFileParameters["{{database_password}}"] = $this->secret("Database password?");
        $configurationFileParameters["{{encryption_key}}"] = str_random(32);

        foreach ($configurationFileParameters as $key => $value) {
            $configurationFile = str_replace($key, $value, $configurationFile);
        }

        # Remove unnecessary configuration parameters from the configuration template
        $matchFilterBlock = "/(\s+)".preg_quote("# --- Filter (begin)", "/").
            ".*?".preg_quote("# --- Filter (end)", "/")."/sm";
        $configurationFile = preg_replace($matchFilterBlock, "", $configurationFile);

        return $configurationFile;
    }
}
