<?php
$path_to_scss = 'sass';
$less = $_GET['path'];
if (file_exists($less))
{
	header("Pragma: cache");
	header("Content-type: text/css");
	$scss_command = $path_to_scss . " --trace " . realpath($less) . ' 2>&1';

	// Run the command and catch the output and the error code
	exec($scss_command, $output_lines, $exit_status);
	$was_successful = ($exit_status == 0) ? TRUE : FALSE;

	if ($was_successful)
	{
		// Just output the CSS
		foreach ($output_lines as $output_line) echo $output_line . "\n";
	}
	else
	{
		// Output the errors while stripping out any command line color codes
		$output_lines = preg_replace('/\[[0-9][0-9]?m/', '', $output_lines);
		foreach ($output_lines as $output_line) echo $output_line . "\n";
	}
}
else
{
	header("HTTP/1.0 404 Not Found");
	echo "Not Found";
}
?>