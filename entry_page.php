<center>
<div style="width:810px;" >
<table border="0" cellpadding="0" cellspacing="0" style="padding:0px;margin:0px;" class="no_style">
 <td class=" left_shadow">  </td>
 <td class="">
	 <div style="width:778px;" class="content_wrapper">
		<div class="bg_gray">
			<ul class="no_style fl" >
				<li class="fl" style="width:25px;">&nbsp; </li>
				<li class="fl">&nbsp;</li>
				<li class="fl"><a href="index.php">HOME</a></li>
			</ul>
			<ul class="no_style fr"  >
				<li class="fl"> </li>
				<li class="fl">&nbsp;</li>
				<li class="fl"><a href="entries.php">ENTRIES</a></li>
				<li class="fl padding_left">&nbsp;</li>
				<li class="fl">&nbsp;</li>
				<li class="fl"><a href="update.php">UPDATES</a></li>
				<li class="fl padding_left">&nbsp;</li>
				<li class="fl"><a href="#">DOCUMENTATION</a></li>
				<li class="fl padding_left">&nbsp;</li>
				<li class="fl"><a href="#">CONTACT</a></li>
			</ul>
		</div>
		<div class="bg_banner" ><img src="images/logo.png" class="logo fl"></div>
		<div class="bg_gray" >
			<form action="entry_page.php" method="post" >
			<ul class="no_style fr"  >

				<li class="fl">Search Signal Peptide :</li>
				<li class="fl"><input class="searchHey" type="text" name="entryId"></li>
				<li class="fl"><input type="submit" value="GO"></li>
			</ul>
			</form>
			<div class="cls"></div>
		</div>
		<div class="body_content" >
			<div class="content_center fl " >
				 <?php if(!$row) { ?>
					<h3> No result found. Please enter a correct entry ID. </h3>
				 <?php }else { ?>

				<div class="fl title" style="padding:0px; margin:0px;"><?php echo $row['entry_ID'] ?> (<?php echo $row['entry_name'] ?>) </div>
				<div class="fr" style="padding:0px; margin:0px;">
					<ul class="no_style" style="padding:0px; margin:0px;">
						<li class="fl" style="padding-right:20px;"> <a href="#"> Download </a> </li>
						<li class="fl"> <a href="#"> History </a> </li>
					</ul>
				</div>
				<div class="cls"> </div>
				<div class="fl x-label" style="padding:0px; margin:0px;"> Last modified [<?php echo $row['date_last_modified'] ?>] </div>
				<div class="dotted_separtor" ></div>
				<br/>
				<div class="" style="min-height:100px;padding:10px;">
					<div class="title_bg"> Names And Origin </div>
					<div class="">
						<table class="_table" border="0">
							<tr>
								  <td  colspan="2" valign="top" >
									<div class="x-label"> Protein Name</div>
								  </td>
							</tr>
							<tr>
								 <td  style="padding :5px 0px 0px 90px;" valign="top" >
									 <div class="x-label" > Recommended Name </div>
								 </td>
								 <td > <div class="x-value" valign="top" > <?php echo $row['recommended_name'] ?> </div> </td>
							</tr>
							<tr>
								 <td class="border_bottom " valign="top" style="padding :5px 0px 0px 90px;" >
									 <div class="x-label"> Alternative Name</div>
								 </td>
								 <td class="border_bottom " valign="top"><div class="x-value"> <?php echo $row['alternative_name'] ?> </div> </td>
							</tr>
							<tr>
								 <td class="border_bottom " valign="top">
									<div class="x-label"> Organism</div>
								 </td>
								 <td class="border_bottom " valign="top"> <div class="x-value"> <?php echo $row['organism'] ?> </div> </td>
							</tr>
							<tr>
								 <td class="border_bottom " valign="top">
									 <div class="x-label"> Taxonomic Lineage</div>
								 </td>
								 <td class="border_bottom " valign="top"> <div class="x-value">  <?php echo $row['taxonomic_lineage'] ?> </div> </td>
							</tr>
					  </table>

					</div>
					 <br/>
					<div class=" title_bg"> Protein Attributes </div>
					<div class="">
						<table class="_table" border="0">

							<tr>
								 <td class="border_bottom " valign="top">
									<div class="x-label"> Sequence Length</div>
								 </td>
								 <td class="border_bottom " valign="top"> <div class="x-value"> <?php echo $row['sequence_length'] ?> </div> </td>
							</tr>
							<tr>
								 <td class="border_bottom " valign="top">
									 <div class="x-label"> Protein Existence </div>
								 </td>
								 <td class="border_bottom " valign="top"> <div class="x-value">  <?php echo $row['protein_existence'] ?> </div> </td>
							</tr>
					  </table>

					</div>

					<br/>
					<div class=" title_bg"> General Anotation </div>
					<div class="">
						<table class="_table" border="0">

							<tr>
								 <td class="border_bottom " valign="top">
									<div class="x-label"> Function </div>
								 </td>
								 <td class="border_bottom " valign="top"> <div class="x-value"> <?php echo $row['function'] ?> </div> </td>
							</tr>
							<tr>
								 <td class="border_bottom " valign="top">
									 <div class="x-label" > SubUnit </div>
								 </td>
								 <td class="border_bottom " valign="top"> <div class="x-value"> <?php echo $row['subunit_structure'] ?> </div> </td>
							</tr>
							<tr>
								 <td class="border_bottom " valign="top">
									 <div class="x-label"> Subcellular Location </div>
								 </td>
								 <td class="border_bottom " valign="top"> <div class="x-value"> <?php echo $row['subcellular_location'] ?></div> </td>
							</tr>
							<tr>
								 <td class="border_bottom ">
									 <div class="x-label"> Post-translational modification </div>
								 </td>
								 <td class="border_bottom " valign="top"> <div class="x-value">  <?php echo $row['post_translational'] ?> </div> </td>
							</tr>
							<tr>
								 <td class="border_bottom " valign="top">
									 <div class="x-label"> Polymorphism </div>
								 </td>
								 <td class="border_bottom " valign="top"> <div class="x-value"> <?php echo $row['polymorphism'] ?> </div> </td>
							</tr>
							<tr>
								 <td class="border_bottom " valign="top">
									 <div class="x-label"> Sequence similarities </div>
								 </td>
								 <td class="border_bottom " valign="top"> <div class="x-value"> <?php echo $row['sequence_similarities'] ?> </div> </td>
							</tr>
					  </table>

					</div>

					<br/>
					<div class="title_bg"> References </div>
					<div class="box" style="padding-left:18px;">
						 <table class="_table" border="0">
							<?php

								while ($rows = mysql_fetch_assoc($reQueryResult)) {
							?>
							<tr>
								 <td class="border_bottom " >

									  <div class="fl" style="width:3%;margin-right:10px;font-size:10pt; "> [<?php echo $rows['reference_number'] ?>] </div>
									  <div class="fl" style="width:90%;font-size:09pt; ">
										<?php echo $rows['title']; ?>
										<div id="hide_me_<?php echo $rows['reference_number'] ?>" class="hide_ref">
											<?php echo $rows['author']; ?>  <br />
											Cited For : <?php echo $rows['cited_for']; ?>
										</div>

									  </div>
									 <div class="fr" > <a id="btn_expand_<?php echo $rows['reference_number'] ?>" href="javascript:expandRef('hide_me_<?php echo $rows['reference_number'] ?>', 'btn_expand_<?php echo $rows['reference_number'] ?>')">Show</a> </div>
								</td>
							</tr>

							<?php } ?>

					  </table>

							<div class="cls"> </div>
					</div>

				</div>
				<br/>
					<div class="title_bg"> Sequences </div>
					<div class="box" style="padding-left:18px;">

						 <?php

							$sequence =  explode(" ",$row['sequence']);

							foreach($sequence as $val) :

								if(trim($val) != "" ) {
						 ?>
						 <div class="x-value x-width fl " > <?php echo $val; ?> </div>
						 <?php
								}

							endforeach;
						 ?>

						 <div class="cls"> </div>
					</div>

				</div>
				<br/>
				<div class="dotted_separtor" ></div>


				 <?php } ?>
			</div>
			 <div class="cls"></div>
		</div>
		<div class="bg_dgray" >
			<ul class="no_style fr">
				<li >©2012 PROTEIN SEQUENCE PROFILER. ALL RIGHTS RESERVED.</li>
				<li class="separator"></li>
			</ul>
			<div class="cls"></div>
		</div>

  </td>
  <td class=" right_shadow">&nbsp;  </td>
</table>
<div class="cls"> </div>
<div>
