#!C:\xampp\perl\bin\perl.exe

$perl = 'C:\wamp\www\signal-peptide\lib\redundancy-checker\source\perl\bin\perl.exe';

$blastpgp = $ARGV[0];
$blastproc = $ARGV[1];
$tmpdir = $ARGV[2];
$entrydir = $ARGV[3];
$filePath = $ARGV[4];
$file = $ARGV[5];
$output = $ARGV[6];

$z = 100000000;

# process blast output to create list of aligned segments

open(ALIGN, "> $output") || die "Could not open $file.align for writing:$!";
open(LIST, "$filePath") || die "Could not open $filePath for reading:$!";

$index = 0;

while(<LIST>) {
   if(/^>/) {

       $head = $_;

       if($index && -e "$entrydir\\$index.fasta") {
           close FASTA;
           &DoSearching("$entrydir\\$index.fasta");
       }

       $index ++;

       open(FASTA, "> $entrydir\\$index.fasta") || die "Could not open $index.fasta for writing: $!";
       print FASTA "$head";
       $flag = 1;
   } elsif($flag == 1) {
       print FASTA "$_";
   }

}

if($index && -e "$entrydir\\$index.fasta") {
   close FASTA;
   &DoSearching("$entrydir\\$index.fasta");
}

# system("rm $tmpdir/$file.p*");

close LIST;
close(ALIGN);

################################################################################
# Carry out PSI-BLAST searching against nr database and use resulted checkpoint
# files to align PDBAA to generate pdbaa.align file
################################################################################

sub DoSearching
{
   my $fastafile = shift;

   system("$blastpgp -i $fastafile -e 1 -h 0.0001 -j 3 -N 18 -v 10000 -b 10000 -z $z -d $tmpdir\\$file -F F | $perl $blastproc 0.0001 > $fastafile.blast");

   unlink "$fastafile";

   if(! -e "$fastafile.blast" || -z "$fastafile.blast") {
        print "No $fastafile.blast!\n";
        return;
   }

   open(BLAST,"$fastafile.blast");

   while(<BLAST>) {
       chop;
       @array=split;

       if (/^Query=/) {
           $query=$array[1];
           $query =~ s/^lcl\|//;
           $qlen=$array[2];
       }

       elsif (/^Hit=/) {
           $hit=$array[1];
           $hit =~ s/^lcl\|//;
           $hlen=$array[2];
       }

       elsif (/^Stat=/) {
           $E=$array[1];
	   $E =~ s/,//g;
           if($E =~ /^e/) { $E = "1" . $E }
           $align=$array[2];
           $pc=$array[3];
           $pc =~ s/\%//g;
       }

       elsif (/^Qseq=/) {
           $qseql=$array[1];
           $qseqr=$array[2];
       }

       elsif (/^Hseq=/) {
           $hseql=$array[1];
           $hseqr=$array[2];

           if ($qlen <= $hlen) {
              printf(ALIGN "%-10s%6d%6d%6d%6d  %-10s%6d%6d%6d%6d%6d%10.1e%6d\n",
                     $query,$qlen,$qseql-1,$qseqr-$qseql+1,$qlen-$qseqr,
                     $hit,  $hlen,$hseql-1,$hseqr-$hseql+1,$hlen-$hseqr,
                     $pc,$E,$align);
           }
       }
    }

    close BLAST;

    unlink "$fastafile.blast";
}

