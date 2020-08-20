import { printReceipt } from './api/printer';

async function processPrintRequests() {
  const printRequests = document.getElementsByTagName('print-me-pls');

  console.log('Found print requests', printRequests);

  for (const request of printRequests) {
    const contents = request.getAttribute('content');
    let copies = request.getAttribute('copies');

    if (copies === null) {
      copies = '0';
    }

    for (let i = 0; i < +copies; i++) {
      await printReceipt(contents);
    }
  }
}

processPrintRequests();
