(function ($) {
  $("#allowance-range-submit").hide();

  $("#min_allowance,#max_allowance").on("change", function () {
    $("#allowance-range-submit").show();

    var min_allowance_range = parseInt($("#min_allowance").val());

    var max_allowance_range = parseInt($("#max_allowance").val());

    if (min_allowance_range > max_allowance_range) {
      $("#max_allowance").val(min_allowance_range);
    }

    $("#slider-range").slider({
      values: [min_allowance_range, max_allowance_range],
    });
  });

  $("#min_allowance,#max_allowance").on("paste keyup", function () {
    $("#allowance-range-submit").show();

    var min_allowance_range = parseInt($("#min_allowance").val());

    var max_allowance_range = parseInt($("#max_allowance").val());

    if (min_allowance_range == max_allowance_range) {
      max_allowance_range = min_allowance_range + 100;

      $("#min_allowance").val(min_allowance_range);
      $("#max_allowance").val(max_allowance_range);
    }

    $("#slider-range").slider({
      values: [min_allowance_range, max_allowance_range],
    });
  });

  /*$(function () {
    $("#slider-range").slider({
      range: true,
      orientation: "horizontal",
      min: 0,
      max: 10000,
      values: [0, 10000],
      step: 100,

      slide: function (event, ui) {
        if (ui.values[0] == ui.values[1]) {
          return false;
        }

        $("#min_allowance").val(ui.values[0]);
        $("#max_allowance").val(ui.values[1]);
      },
    });

    $("#min_allowance").val($("#slider-range").slider("values", 0));
    $("#max_allowance").val($("#slider-range").slider("values", 1));
  });*/

  /*$("#slider-range,#allowance-range-submit").click(function () {
    var min_allowance = $("#min_allowance").val();
    var max_allowance = $("#max_allowance").val();

    $("#searchResults").text(
      "Here List of products will be shown which are cost between " +
        min_allowance +
        " " +
        "and" +
        " " +
        max_allowance +
        "."
    );
  });*/
})(jQuery);
