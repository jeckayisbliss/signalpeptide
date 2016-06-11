
<script type="text/javascript">

	$(document).ready(function(){


		//listen to clicked modal links, then append recordid to modal div
		$("a[data-target='#recordInfo']").on('click',function(){
			$("div[id='recordInfo']").attr( "data-recordid", $(this).attr("data-recordid") );
		});


		$('#recordInfo').on('shown.bs.modal', function (e) {


			var recordid = $(this).attr("data-recordid");

			$.ajax({

				type: "POST",
				url: "ajax/peptideAjax.php",
				data: {recordid: recordid}, 
				beforeSend: function() {
					console.log("fetching details....");
				},
				error: function(data){
					console.log("error!");
					console.log(data.responseText);
				},
				success: function(data){
					// console.log(data);
					$("div[id='detailview']").html(data);
				}

			}); // end ajax


		});
	});

</script>


<div class="bs-examples" style="border:1px solid black; width:500px;">
	<div id="recordInfo" class="modal fade" >
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header bg-info">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
					<h1 class="modal-title text-primary fa fa-user "><?php echo " Entry"; ?> Details</h1>
				</div>
				<div>
					<div class="modal-body">

						<div id="detailview" style="width:100%;margin: auto">

						</div>
					</div>
				</div>

				</div>
			</div>
		</div>
	</div>
</div>