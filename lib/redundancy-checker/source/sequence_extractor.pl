#!C:\xampp\perl\bin\perl.exe

$pdbaa = $ARGV[0];
$maxpc = $ARGV[1];
$pdbaa_align = $ARGV[2];
$cullfilename = $ARGV[3];
$logfilename =  $ARGV[4];
$Ecutoff = 1;

&createdresult();

sub createdresult
{

   # files
   open(FILE, "$pdbaa") || die "can not open $pdbaa: $!";

   # $cullfilename = "$entryDir\\cullseq\_pc$maxpc\_chains";
   # $logfilename  = "$entryDir\\log\_pc$maxpc.log";

   open(LOG, "> $logfilename") || die "Could not open $logfilename for writing!\n";

   # get sequences from pdbaa file

   %sequence = ();
   %title = ();
   
   while(<FILE>) {
     if (/^>/) {
       chomp;
       s/\>//g;
       s/^lcl\|//;
       @array=split;
       $pdb=$array[0];
       # $len{$pdb}=$array[1];  # In some cases, sequence does not show full length 
       $title{$pdb}="\> $_\n";
       $sequence{$pdb}="";
     }
     else {
       chomp;
       s/\s+//g;
       s/[0-9]//g;
       $sequence{$pdb} = $sequence{$pdb} . $_;
     }
   }
   close FILE;

   # Decide which sequences to keep in %pdblen,

   %pdblen = ();

   foreach $pdb (keys %sequence) { 
     # $len=$len{$pdb};
     $len = length($sequence{$pdb});
     $pdblen{$pdb}=$len;
   }

   # Read in alignment file of sequences in %pdblen
   open(ALIGN,"$pdbaa_align") || die "can not open $pdbaa_align: $!";

   %pc = ();

   ALIGN:
   while(<ALIGN>) {
     chop;
     @array=split;
  
     $query=$array[0];
     $hit=$array[5];

     if (!defined($pdblen{$query})) {next ALIGN;}
     if (!defined($pdblen{$hit})) {next ALIGN;}
     if ($array[10]<=$maxpc) {next ALIGN;}
     if ($array[11]>$Ecutoff) {next ALIGN;}
     if ($array[3]<20) {next ALIGN;}
     if ($array[8]<20) {next ALIGN;}

     $pc{$query}{$hit}{pc}=$array[10];
     $pc{$hit}{$query}{pc}=$pc{$query}{$hit}{pc};
   }

   close(ALIGN);

   # sort %pdblen by length; this can be done by resolution or R-factors
   @order=sort { 
       $pdblen{$b} <=> $pdblen{$a}  
     or 
       $a cmp $b
      
     } keys %pdblen;

   # Process in order of %pdblen; keep first sequence in %keep and 
   # delete its neighbors by putting them in %reject; proceed to next sequence 
   # not in %reject, and put its neighbors (not in %keep, not in %reject) into 
   # %reject; repeat until end of %pdblen Percentages are in %pc{$pdb1}{$pdb2}

   %reject = ();
   %keep = ();

   PDB1:
   for ($i=0;$i<=$#order;$i++) {
     $pdb1=$order[$i];
     if (defined($reject{$pdb1})) {next PDB1;}  # already rejected
     $keep{$pdb1}=1;                            # put in keep hash
     if (!defined(%{$pc{$pdb1}})) {next PDB1;}  # no neighbors
     @pdb2=sort keys %{$pc{$pdb1}};
    PDB2:
     foreach $pdb2 (@pdb2) {
       if ($keep{$pdb2}) {next PDB2;}    # pdb2 already in keep list
       if ($reject{$pdb2}) {next PDB2;}  # pdb2 already in reject list
       if ($pc{$pdb1}{$pdb2}) {          # if pdb1 and pdb2 are related by pc >
                                         #  maxpc, add to reject and print log
         $reject{$pdb2}=1;
         print LOG "reject $pdb1 $pdb2 $pc{$pdb1}{$pdb2}{pc}\n";
       }
     }
   }

   close(LOG);

   # print results to cull file and fasta file
   # $nchains=scalar keys %keep;
   # $cullfilename="$cullfilename$nchains";
   $cullfilename="$cullfilename";
   open(CULL, "> $cullfilename") || die "Could not open $cullfilename for writing: $!";
   open(FASTA, "> $cullfilename.fasta") || die "Could not open $cullfilename.fasta for writing: $!";

   print CULL "IDs                                              length\n";
   foreach $pdb (keys %keep) {
     printf(CULL "%-50s%5d\n", $pdb,$pdblen{$pdb});

     print FASTA $title{$pdb};
     for ($i=0;$i<=int($pdblen{$pdb}/50);$i++) {
       $seqprint=substr($sequence{$pdb},$i*50,50);
       print FASTA "$seqprint\n";
     }
   }

   close(CULL);
   close(FASTA);
}
