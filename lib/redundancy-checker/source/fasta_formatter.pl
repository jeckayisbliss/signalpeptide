#!C:\xampp\perl\bin\perl.exe

$input_file_path = $ARGV[0];
$output_file_path = $ARGV[1];

open STDERR, ">>", $output_file_path or die $!;
open(OUTPUT, "> $output_file_path") or die("Could not open $output_file_path for reading: $!");
open(INPUT, "$input_file_path") || die "Could not open $input_file_path for reading: $!";
while(<INPUT>) {
    s/\t/ /g;
    print OUTPUT "$_";
}
close OUTPUT;
close INPUT;

close INPUT;
close OUTPUT;;


