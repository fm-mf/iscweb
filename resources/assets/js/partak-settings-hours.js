// TODO: Rewrite this to Vue component?
$(document).ready(function() {
  const dow = [
    'Monday',
    'Tuesday',
    'Wednesday',
    'Thursday',
    'Friday',
    'Saturday',
    'Sunday'
  ];

  $('#openingHoursMode').on('change', function() {
    $.get('/partak/openinghours?mode=' + $(this).val(), function(d) {
      const result = JSON.parse(d);
      $('#openingHoursText').val(result.text);

      for (let i = 0; i < 7; ++i) {
        $('#openingHoursData-' + dow[i]).val(result.hours[dow[i]]);
      }

      if (!result.show_hours) {
        $('#showOpeningHours').prop('checked', false);
      } else {
        $('#showOpeningHours').prop('checked', true);
      }
    });
  });
});
