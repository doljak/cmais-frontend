
  var request_header = jQuery.ajax({
    dataType: 'html',
    success: function(data) {
      if (data)
        jQuery('body #header').before(data);
    },
    url: '/doctorwho/sextoano/ajax/insert_header.php'
  });
  
  var request_footer = jQuery.ajax({
    dataType: 'html',
    success: function(data) {
      if (data)
        jQuery('body').append(data);
    },
    url: '/doctorwho/sextoano/ajax/insert_footer.php'
  });