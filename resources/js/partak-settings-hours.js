// TODO: Rewrite this to Vue component?
import axios from 'axios';

const DAYS_OF_WEEK = [
    'Monday',
    'Tuesday',
    'Wednesday',
    'Thursday',
    'Friday',
    'Saturday',
    'Sunday'
];

const BASE_URL = '/partak/opening-hours';

window.addEventListener('load', onPageLoad);

function onPageLoad() {
    const select = document.getElementById('id_opening_hours_mode');
    select.addEventListener('change', onSelectChange);
}

function onSelectChange(event) {
    axios
        .get(BASE_URL, {
            params: {
                mode: event.target.value
            }
        })
        .then(response => {
            updateForm(response.data);
        })
        .catch(error => {
            console.error(error);
        });
}

function updateForm(data) {
    const text = document.getElementById('hours_json[text]');
    const textCs = document.getElementById('hours_json[textCs]');
    const showOpeningHours = document.getElementById('show_hours');

    text.value = data.hours_json.text;
    textCs.value = data.hours_json.textCs ?? '';
    showOpeningHours.checked = data.show_hours;

    DAYS_OF_WEEK.forEach(item => {
        const openingHoursData = document.getElementById(
            `hours_json[hours][${item}]`
        );
        openingHoursData.value = data.hours_json.hours[item];
    });
}
