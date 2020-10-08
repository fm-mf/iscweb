function checkArrival() {
  if ($('#arrival').is(':checked')) {
    $('.arrival').prop('disabled', true);
  } else {
    $('.arrival').prop('disabled', false);
  }
}

$('#arrival').on('change', () => {
  checkArrival();
});

checkArrival();
