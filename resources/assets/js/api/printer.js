const parser = new DOMParser();

// TODO: This should be configurable
const printerUrl =
  'http://192.168.0.10/cgi-bin/epos/service.cgi?devid=local_printer&timeout=10000';

export async function printReceipt(contents) {
  // TODO: Maybe we should first check if the printer exists?

  const message =
    '<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">' +
    '<s:Body>' +
    '<epos-print xmlns="http://www.epson-pos.com/schemas/2011/03/epos-print">' +
    contents +
    '</epos-print>' +
    '</s:Body>' +
    '</s:Envelope>';

  // Timeout controller - cut the connection after 5 seconds
  const controller = new AbortController();
  const signal = controller.signal;
  setTimeout(() => {
    signal.abort();
  }, 5000);

  try {
    const result = await fetch(printerUrl, {
      method: 'POST',
      headers: {
        'content-type': 'text/xml; charset=utf-8'
      },
      body: message,
      signal
    });

    const text = await result.text();
    const xmlDoc = parser.parseFromString(text, 'text/xml');

    return xmlDoc.getElementsByTagName('response')[0].getAttribute('success');
  } catch (e) {
    console.error(
      "Failed to print receipt - this is normal if you're not at ISC Point",
      e
    );
  }
}
