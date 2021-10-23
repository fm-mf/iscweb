import { printReceipt } from './api/printer';

async function processPrintRequests() {
    const printRequests = document.getElementsByTagName('print-me-pls');

    for (const request of printRequests) {
        const contents = request.getAttribute('content');
        let copies = request.getAttribute('copies');

        if (copies === null) {
            copies = '0';
        }

        await printReceipt(contents.repeat(+copies));
    }
}

processPrintRequests();
