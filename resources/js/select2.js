(function($) {
    'use strict';
  console.log("dans select")
    if ($("#SelectRole").length) {
      $("#SelectRole").select2();
    }
    if ($(".select2").length) {
      $(".select2").select2();
    }
  })(jQuery);

  $(document).ready(function() {
    // Sélectionnez tous les éléments de type select et appliquez Select2
    $('.select2').select2();
});
