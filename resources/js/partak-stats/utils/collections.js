export const toStatsCollection = items => ({
  items: items.map(item => {
    const built = { ...item };
    if (built.children) {
      built.children = toStatsCollection(built.children);
    }
    return built;
  }),
  min: Math.min(...items.map(i => i.count)),
  max: Math.max(...items.map(i => i.count)),
  total: items.reduce((acc, i) => acc + i.count, 0)
});
