var editor; // use a global for the submit and return data rendering in the examples
 
jQuery(document).ready(function() {
		jQuery('#filterEntry').dialog({
	    autoOpen : false,
	    modal    : true,
	    dragable : false,
	    position : 'center',
	    width    : '400px',
	    hide     : { effect : 'blind' , duration : 500},
	    show     : { effect : 'blind' , duration : 500}
	  });

    editor = new $.fn.dataTable.Editor( {
        ajax: "../php/staff.php",
        table: "#example",
        fields: [ {
                label: "First name:",
                name: "first_name"
            }, {
                label: "Last name:",
                name: "last_name"
            }, {
                label: "Position:",
                name: "position"
            }, {
                label: "Office:",
                name: "office"
            }, {
                label: "Extension:",
                name: "extn"
            }, {
                label: "Start date:",
                name: "start_date"
            }, {
                label: "Salary:",
                name: "salary"
            }
        ]
    } );
 
    var table = $('#example').DataTable( {
        lengthChange: false,
        ajax: "../php/staff.php",
        columns: [
            { data: null, render: function ( data, type, row ) {
                // Combine the first and last names into a single table field
                return data.first_name+' '+data.last_name;
            } },
            { data: "position" },
            { data: "office" },
            { data: "extn" },
            { data: "start_date" },
            { data: "salary", render: $.fn.dataTable.render.number( ',', '.', 0, '$' ) }
        ]
    } );
 
    var tableTools = new $.fn.dataTable.TableTools( table, {
        sRowSelect: "os",
        aButtons: [
            { sExtends: "editor_create", editor: editor },
            { sExtends: "editor_edit",   editor: editor },
            { sExtends: "editor_remove", editor: editor }
        ]
    } );
    $( tableTools.fnContainer() ).appendTo( '#example_wrapper .col-xs-6:eq(0)' );
} );


// $.ajax({
//   // your ajax code
//   beforeSend: function(){
//        $('.loader').show()
//    },
//   complete: function(){
//        $('.loader').hide();
//   }
// });
