#!C:\xampp\perl\bin\perl.exe

$database_formatter = $ARGV[0];
$entry_temp_dir = $ARGV[1];
$input_file_path = $ARGV[2];
$input_file_basename = $ARGV[3];

# create blastdatabases and move to $tmpdir

system("$database_formatter -i $input_file_path -p T -n $entry_temp_dir\\$input_file_basename");
if(! -e "$entry_temp_dir\\$input_file_basename.phr") {
     print "Failed to create database for blastpgp $input_file_basename\n";
     exit;
} 
