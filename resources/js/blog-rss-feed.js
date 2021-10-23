import Vue from 'vue';
import BlogRssFeed from './blog-rss-feed/BlogRssFeed';

new Vue({
    el: '#rss-feed',
    components: {
        BlogRssFeed
    },
    template: `<blog-rss-feed />`
});
