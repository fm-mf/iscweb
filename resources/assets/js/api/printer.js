const parser = new DOMParser();

const printerUrl =
  'http://192.168.0.10/cgi-bin/epos/service.cgi?devid=local_printer&timeout=10000';

export async function printReceipt(contents) {
  const message =
    '<s:Envelope xmlns:s="http://schemas.xmlsoap.org/soap/envelope/">' +
    '<s:Body>' +
    contents +
    '</s:Body>' +
    '</s:Envelope>';

  const result = await fetch(printerUrl, {
    method: 'POST',
    headers: {
      'content-type': 'text/xml; charset=utf-8'
    },
    body: message
  });

  const text = await result.text();
  const xmlDoc = parser.parseFromString(text, 'text/xml');

  return xmlDoc.getElementsByTagName('response')[0].getAttribute('success');
}
