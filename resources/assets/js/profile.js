const arrivalCheckbox = document.getElementById('arrival_skipped');
const optOutCheckbox = document.getElementById('opt_out');

function checkArrival() {
    const arrivalInputs = Array.from(document.getElementsByClassName('arrival'));

    arrivalInputs.forEach((input) => {
        const inputRequired = !arrivalCheckbox.checked && !optOutCheckbox.checked;

        input.disabled = arrivalCheckbox.checked;
        input.required = inputRequired;
        inputRequired
            ? input.labels[0]?.classList.add('required')
            : input.labels[0]?.classList.remove('required');
    });
}

arrivalCheckbox.addEventListener('change', checkArrival)
optOutCheckbox.addEventListener('change', checkArrival)

checkArrival();
