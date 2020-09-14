// TODO: This is shit
console.log($('.date'));

$('.date').pickadate({
  editable: true,
  firstDay: 1,
  format: 'dd mmm yyyy'
});

$('.time').pickatime({
  editable: true
});
