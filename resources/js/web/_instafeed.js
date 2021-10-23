import Instafeed from 'instafeed.js';

const instafeedContainer = document.getElementById('instafeed-container');

if (instafeedContainer != null) {
    const feed = new Instafeed({
        get: 'user',
        userId: '3020077602',
        clientId: '723086ddbfd244c5adb1094981fa7cb2',
        // https://elfsight.com/service/generate-instagram-access-token/
        // clientSecret: "01784b975df94ebe93c194c543217cae",
        accessToken: '3020077602.723086d.866bfcc502904a3387b00bf05070214b',
        limit: 14,
        after() {
            instafeedContainer.classList.remove('d-none');
            const link = document.querySelector('#instafeed a');
            link.setAttribute('target', '_blank');
            link.setAttribute('rel', 'noopener');
        },
        error() {
            instafeedContainer.remove();
        }
    });
    feed.run();
}
