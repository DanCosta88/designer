<?php namespace Danphyxius\Designer\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class DesignerGenerateCommand extends Command {

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'pattern:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate a new design pattern class.';

    /**
     * @var CommandInputParser
     */
    protected $parser;

    /**
     * @var CommandGenerator
     */
    protected $generator;

    /**
     * Create a new command instance.
     *
     * @param CommandInputParser $parser
     * @param CommandGenerator $generator
     */
    public function __construct(CommandInputParser $parser, CommandGenerator $generator)
    {
        $this->parser = $parser;
        $this->generator = $generator;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $path = $this->argument('path');
        $pattern = strtolower($this->argument('pattern'));
        $properties = $this->option('properties');
        $base = $this->option('base');
        $stub = __DIR__.'/../patterns/'.$pattern.'/'.$pattern.'.json';

        // Parse the command input.
        $commandInput = $this->parser->parse($pattern, $path, $base, $properties);

        // Actually create the files with the correct boilerplate.
        $this->generator->make(
            $commandInput,
            $stub
        );

        $this->info('Now i will generate a ' . $pattern . ' Pattern for path ' . $path . ', with base ' . $base);
        $this->info('All done! Your pattern have now been generated!');
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['path', InputArgument::REQUIRED, 'The class path for the pattern to generate.'],
            ['pattern', InputArgument::REQUIRED, 'The pattern to create.']
        ];
    }

    /**
     * Get the console command options.
     *
     * @return array
     */
    protected function getOptions()
    {
        return [
            ['properties', null, InputOption::VALUE_OPTIONAL, 'A comma-separated list of properties for the command.', null],
            ['base', null, InputOption::VALUE_OPTIONAL, 'The path to where your domain root is located.', 'app']
        ];
    }

}
