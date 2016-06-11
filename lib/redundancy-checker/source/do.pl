#!C:\xampp\perl\bin\perl.exe


$source = 'C:\wamp\www\signal-peptide\lib\redundancy-checker\source';
$perl = "$source\\perl\\bin\\perl.exe";
#$perl = 'C:\xampp\perl\bin\perl.exe';
# $source = 'C:\xampp\htdocs\signal-peptide\lib\redundancy-checker\source';
$fasta_formatter = "$source\\fasta_formatter.pl";
$database_creator = "$source\\blastdb_creator.pl";
$database_formatter = "$source\\formatdb.exe";
$sequence_aligner = "$source\\psi_pdbaa_aligner.pl";
$blast_pgp = "$source\\blastpgp.exe";
$blast_proc = "$source\\psiblastproc.pl";
$culled_sequence_extractor = "$source\\sequence_extractor.pl";

$input_file_path = $ARGV[0];
$output_file_path = $ARGV[1];
$entry_temp_dir = $ARGV[2];
$input_file_basename = $ARGV[3];
$align_file_path = $ARGV[4];
$entry_dir = $ARGV[5];
$max_percentage = $ARGV[6];
$cull_file_path = $ARGV[7];
$cull_log_file_path = $ARGV[8];

system("$perl $fasta_formatter $input_file_path $output_file_path");
system("$perl $database_creator $database_formatter $entry_temp_dir $input_file_path $input_file_basename");
system("$perl $sequence_aligner $blast_pgp $blast_proc $entry_temp_dir $entry_dir $input_file_path $input_file_basename $align_file_path");
system("$perl $culled_sequence_extractor $output_file_path $max_percentage $align_file_path $cull_file_path $cull_log_file_path");
