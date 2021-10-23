import axios from 'axios';

/**
 * Remove html entities - this function was written
 * specifically for ISC Blog output and is not universal.
 * @param {string} text
 */
const normalizeText = text =>
    text.replace(/&#8230;/g, '\u2026').replace(/<a [^>]*>.*<\/a>/gm, '');

export const getBlogFeed = async () => {
    const res = await axios.get('/blog/?feed=rss2');
    const rss = new DOMParser().parseFromString(res.data, 'text/xml');

    return Array.from(rss.querySelectorAll('item')).map(item => {
        return {
            title: item.querySelector('title').textContent,
            link: item.querySelector('link').textContent,
            description: normalizeText(
                item.querySelector('description').textContent
            ),
            pubDate: new Date(item.querySelector('pubDate').textContent)
        };
    });
};
