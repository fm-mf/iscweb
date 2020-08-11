<template>
  <div class="rss-feed">
    <template v-if="loaded">
      <article-item
        v-for="item in items"
        :key="item.link"
        :title="item.title"
        :link="item.link"
        :description="item.description"
      />
    </template>
    <loader v-else />

    <div class="text-center">
      <a href="/blog" target="_blank" class="btn btn-primary">
        <i class="fas fa-external-link-alt"></i> Více na ISC Blogu
      </a>
    </div>
  </div>
</template>

<script>
import { getBlogFeed } from '../api/blog';
import ArticleItem from './components/ArticleItem';
import Loader from '../partak-stats/components/Loader';

export default {
  components: {
    ArticleItem,
    Loader
  },

  data() {
    return {
      items: [],
      loaded: false
    };
  },

  created() {
    getBlogFeed().then(d => {
      this.items = d.slice(0, 2);
      this.loaded = true;
    });
  }
};
</script>

<style lang="scss">
.rss-feed {
  margin-top: 1rem;
  margin-bottom: 2rem;
}
</style>
