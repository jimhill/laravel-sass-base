<?php namespace JimHill\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Debug\Exception\FatalErrorException;
use \AWS;
use \Config;

class CdnDeployCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'cdn:deploy';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'This command is used for pushing compiled assets to an S3 CDN.';

	/**
	 * Configuration for assets
	 * 
	 * @var array
	 */
	protected $config;

	/**
	 * S3
	 * @var Aws\S3\S3Client
	 */
	protected $s3;

	/**
	 * Path to distribution files
	 * 
	 * @var string
	 */
	protected $dist_path;

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
		$this->config = Config::get('cdn');

		$this->s3 = AWS::get('s3');
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		$s3 = AWS::get('s3');
		
		if ($this->checkDistAssetsExist()) {
			$this->deploy();
		}
	}

	/**
	 * Check distribution assets exist
	 * 
	 * @return boolean
	 */
	public function checkDistAssetsExist()
	{
		$dir = $this->getDistPath();
		if ($this->isDirPopulated($dir)) {
			$this->error('Assets `dist` directory is empty');
			return false;
		}
		return true;
	}

	/**
	 * Is directory populated?
	 * 
	 * @param  string  $dir directory path
	 * @return boolean     Returns false if empty
	 */
	public function isDirPopulated($dir)
	{
		if (!is_readable($dir)) return false; 
  		return (count(scandir($dir)) == 2);
	}

	/**
	 * Deploy
	 * 
	 * @return void
	 */
	public function deploy()
	{
		$dir = $this->getDistPath();
		$bucket = $this->config['bucket'];
		$keyPrefix = $this->config['cdn_path_prefix'] . '/' . $this->config['assets_version'];
		$options = array(
		    'params'      => array(
		    	'ACL' => 'public-read', 
		    	'ContentEncoding' => 'gzip',
		    	'Expires' => gmdate("D, d M Y H:i:s T", strtotime("+1 years"))
		    ),
		    'force'		  => true,
		    'concurrency' => 20,
		    'debug'       => true
		);

		try {

			$this->s3->uploadDirectory($dir, $bucket, $keyPrefix, $options);
			$this->info('All assets were uploaded successfully!');

		} catch(FatalErrorException $e) {

			$this->error('There was a problem uploading your assets');
		
		}
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			
		);
	}

	/**
	 * Get distribution files path
	 * 
	 * @return string
	 */
	public function getDistPath()
	{
		if (!$this->dist_path) {
			$this->setDistPath($this->config['path'] . '/dist');
		}
		return $this->dist_path;
	}

	/**
	 * Set distribution files path
	 * 
	 * @param string $path
	 */
	public function setDistPath($path)
	{
		$this->dist_path = $path;
	}

}
