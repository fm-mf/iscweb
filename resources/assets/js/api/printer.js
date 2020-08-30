const parser = new DOMParser();

const printerUrl = window['receiptPrinterUrl'];

async function request(contents) {
  const message =
    '<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">' +
    '<s:Body>' +
    '<epos-print xmlns="http://www.epson-pos.com/schemas/2011/03/epos-print">' +
    contents.replace(/[\u1000-\u9999]/gim, function(i) {
      return '&#' + i.charCodeAt(0) + ';';
    }) +
    '</epos-print>' +
    '</s:Body>' +
    '</s:Envelope>';

  // Timeout controller - cut the connection after 5 seconds
  const controller = new AbortController();
  const signal = controller.signal;
  setTimeout(() => {
    signal.abort();
  }, 5000);

  const result = await fetch(printerUrl, {
    method: 'POST',
    headers: {
      'content-type': 'text/xml; charset=utf-8'
    },
    body: message,
    signal
  });

  const text = await result.text();
  return parser.parseFromString(text, 'text/xml');
}

export async function printReceipt(contents) {
  // TODO: Maybe we should first check if the printer exists?
  try {
    const xmlDoc = await request(contents);
    return xmlDoc.getElementsByTagName('response')[0].getAttribute('success');
  } catch (e) {
    console.error(
      "Failed to print receipt - this is normal if you're not at ISC Point",
      e
    );
  }
}

export async function checkPrinter() {
  try {
    await request('');
    return true;
  } catch (e) {
    return false;
  }
}
