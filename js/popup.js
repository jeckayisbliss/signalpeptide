jQuery(document).ready(function(){
  jQuery('#filterEntry').dialog({
    autoOpen : false,
    modal    : true,
    dragable : false,
    position : 'center',
    width    : '400px',
    hide     : { effect : 'blind' , duration : 500},
    show     : { effect : 'blind' , duration : 500}
  });
});
