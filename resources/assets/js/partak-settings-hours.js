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

  $('.date').pickadate({
    editable: true,
    firstDay: 1,
    format: 'dd mmm yyyy'
  });

  const allFields = $([])
    .add($('#openingHoursMode'))
    .add($('#openingHoursText'))
    .add($('#showOpeningHours'))
    .add($('#openingHoursData'));

  const dialog = $('#editOpeningHoursDialog')
    .dialog({
      autoOpen: false,
      minWidth: 375,
      modal: true,
      autoResize: true,
      buttons: {},
      close() {
        form[0].reset();
        allFields.removeClass('ui-state-error');
      }
    })
    .css('padding-bottom', '15px');

  const form = dialog.find('form');

  $('#editOpeningHoursButton')
    .button()
    .on('click', () => {
      dialog.dialog('open');
    });

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

  $('#dialogCancelButton').on('click', () => {
    dialog.dialog('close');
  });

  $('.ui-dialog-titlebar-close').hide();
});
