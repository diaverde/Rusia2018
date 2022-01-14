$(document).ready(function(){
  // Add smooth scrolling to all links in navbar + footer link
  $(".navbar a, footer a[href='#myPage']").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();
  
      // Store hash
      var hash = this.hash;
  
      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (900) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 900, function(){

        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    } // End if
  });
    
  // For animation when scrolling to certain sections
  $(window).scroll(function() {
    $(".slideanim").each(function(){
      var pos = $(this).offset().top;
  
      var winTop = $(window).scrollTop();
        if (pos < winTop + 800) {
          $(this).addClass("slide");
        }
    });
  });

  // To show or hide a field depending on the "Country" selection
  var $country = $('#country'), $country2 = $('#country2'), $countrylab = $('#otherC'), $countryval = $('#Cvalid');
  $country.change(function() {
    if ($country.val() == 'Otro') {
        $country2.removeAttr('disabled');
        $country2.show();
        $country2.val('');
        $countrylab.show();
        $countryval.show();
    } else {
        $country2.attr('disabled', 'disabled').val('Colombia');
        $country2.hide();
        $countrylab.hide();
        $countryval.hide();
    }
  }).trigger('change'); // added trigger to calculate initial state

})